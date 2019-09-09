<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Service;
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
            $services = $this->validateExtra($request->services);
            if (!$services) {
                return response()->json('Dữ liệu service không hợp lệ', 422);
            }
            $data = $request->only(['customer', 'store_id']);
            $customer = Customer::find($data['customer']);
            $order = $customer->orders()->create([
                'no' => 421,
                'amount' => 0,
                'status' => 'comfirm',
                'node' => null,
                'store_id' => $data['store_id'],
            ]);
            foreach ($services as $serviceItem) {
                $amount = $this->amount($serviceItem);
                $order->amount += $amount;
                $order->orderItems()->create([
                    'quantity' => $serviceItem['quantity'],
                    'service_id' => $serviceItem['id'],
                    'amount' => $amount,
                    'status' => 'wait',
                    'extras' => $serviceItem['extras'],
                ]);
            }
            \Log::info(["amount" => $order->amount]);
            $order->save();
            DB::commit();
            return response()->json(["success" => true, "order" => $order]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    /**
     *
     * Tổng tiền của 1 service kèm extra
     */

    public function amount($serviceItem)
    {
        $amount = 0;
        $service = Service::select('id', 'price', 'extras')->find($serviceItem['id']);
        $amount = $amount + $service->price * $serviceItem['quantity'];
        if (isset($serviceItem['extras'])) {
            foreach ($serviceItem['extras'] as $extra) {
                $amount = $amount + $this->totalPrice($extra['options'], count($extra['options']));
            }
        }
        return $amount;
    }

    /**
     *
     * Đệ quy tính tổng tiền của options của extra
     */
    public function totalPrice($options, $count)
    {
        if ($count == 1) {
            return $options[$count - 1]['price'];
        }
        return $options[$count - 1]['price'] + $this->totalPrice($options, $count - 1);
    }

    /**
     *
     * Kiểm tra dữ liệu service extra
     */

    public function validateExtra($services)
    {
        $dataService = [];
        foreach ($services as $serviceItem) {
            $item = [
                "extras" => [],
            ];
            $service = Service::select('id', 'price', 'extras')->find($serviceItem['id']);
            if ($service) {
                $serviceExtra = collect($service->extras);
                foreach ($serviceItem['extras'] as $extraItem) {
                    $extra = $serviceExtra->firstWhere('slug', $extraItem['slug']);
                    if ($extra) {
                        $options = collect($extra['options']);
                        $dataOption = [];
                        foreach ($extraItem['options'] as $optionItem) {
                            $option = $options->where('slug', $optionItem)->first();
                            if ($option) {
                                array_push($dataOption, $option);
                            } else {
                                return null;
                            }
                        }
                        $extra['options'] = $dataOption;
                        array_push($item['extras'], $extra);
                    } else {
                        return null;
                    }
                }
                $item['quantity'] = $serviceItem['quantity'];
                $item['id'] = $serviceItem['id'];
            } else {
                return null;
            }
            array_push($dataService, $item);
        }
        return $dataService;
    }

}
