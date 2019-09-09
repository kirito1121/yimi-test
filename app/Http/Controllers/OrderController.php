<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Service;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::with(['orderItems', 'bills', 'customer', 'staff'])->orderby('id', 'desc')->get();
        return $orders;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $services = $request->services;
            $customer = Customer::find($request->customer);
            $order = $customer->orders()->create([
                'no' => 421,
                'amount' => 0,
                'status' => 'comfirm',
                'node' => null,
                'store_id' => $request->store_id,
            ]);
            foreach ($services as $serviceItem) {
                $amount = $this->amount($serviceItem);
                $order->amount += $amount;
                $order->orderItems()->create([
                    'quantity' => $serviceItem['quantity'],
                    'service_id' => $serviceItem['id'],
                    'amount' => $amount,
                    'status' => 'wait',
                    'extras' => json_encode($serviceItem['extras']),
                ]);
            }
            $order->save();
            DB::commit();
            return response()->json(["success" => true, "order" => $order]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th);
        }

    }

    /**
     *
     * Tổng tiền của 1 service kèm extra
     */

    public function amount($serviceItem)
    {
        $amount = 0;
        $service = Service::select('id', 'price')->find($serviceItem['id']);
        $amount = $amount + $service->price * $serviceItem['quantity'];
        foreach ($serviceItem['extras'] as $extra) {
            $amount = $amount + $this->totalPrice($extra['options'], count($extra['options']));
        }
        return $amount;
    }

    /**
     *
     * Đệ quy tính tổng tiền của options của extra
     */
    public function totalPrice($options, $count)
    {
        \Log::info($options[$count - 1]['name'] . " name - price " . $options[$count - 1]['price']);
        if ($count == 1) {
            return $options[$count - 1]['price'];
        }
        return $options[$count - 1]['price'] + $this->totalPrice($options, $count - 1);
    }

}
