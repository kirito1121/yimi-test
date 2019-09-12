<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\OrderHelper;
use App\Order;
use DB;
use Exception;
use Illuminate\Http\Request;

// use Illuminate\Support\Arr;

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
            $orderHelper = new OrderHelper;
            $services = $orderHelper->validateExtra($request->services);
            if (!$services) {
                return response()->json('Dữ liệu service không hợp lệ', 422);
            }
            $data = $request->only(['customer_id', 'store_id']);
            $customer = Customer::find($data['customer_id']);
            $order = $customer->orders()->create([
                'no' => rand(1000, 9999),
                'amount' => 0,
                'status' => 'new',
                'node' => null,
                'store_id' => $data['store_id'],
            ]);
            foreach ($services as $serviceItem) {
                $amount = $orderHelper->amount($serviceItem);
                \Log::info(["amount" => $amount]);
                $order->amount += $amount;
                $order->orderItems()->create([
                    'quantity' => $serviceItem['quantity'],
                    'service_id' => $serviceItem['service_id'],
                    'amount' => $amount,
                    'status' => 'wait',
                    'extras' => $serviceItem['extras'],
                ]);
            }
            // \Log::info(["amount" => $order->amount]);
            $order->save();
            DB::commit();
            return response()->json(["success" => true, "order" => $order]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    public function update($params, Request $request)
    {
        return $request->order_items;
        DB::beginTransaction();
        try {
            $orderHelper = new OrderHelper;
            $services = $orderHelper->validateExtra($request->order_items);
            if (!$services) {
                return response()->json('Dữ liệu service không hợp lệ', 422);
            }
            $order = Order::with('orderItems')->find($params);
            foreach ($services as $serviceItem) {
                $amount = $orderHelper->amount($serviceItem);
                $order->amount += $amount;
                if (isset($serviceItem['id'])) {
                    $order->orderItems()->where('id', $serviceItem['id'])->update([
                        'quantity' => $serviceItem['quantity'],
                        'service_id' => $serviceItem['service_id'],
                        'amount' => $amount,
                        'status' => 'wait',
                        'extras' => $serviceItem['extras'],
                    ]);
                } else {
                    $order->orderItems()->create([
                        'quantity' => $serviceItem['quantity'],
                        'service_id' => $serviceItem['service_id'],
                        'amount' => $amount,
                        'status' => 'wait',
                        'extras' => $serviceItem['extras'],
                    ]);
                }
            }
            $order->save();
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }
}
