<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Customer;
use App\Service;
use Closure;
use DB;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class OrderCreateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'orderCreate',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('order');
    }

    public function args(): array
    {
        return [
            "customer_id" => ["name" => "customer_id", 'type' => Type::int(), "rules" => ["required"]],
            "staff_id" => ["name" => "staff_id", 'type' => Type::int()],
            "store_id" => ["name" => "store_id", 'type' => Type::int(), "rules" => ["required"]],
            "services" => ["name" => "services", 'type' => Type::listOf(GraphQL::type('serviceInput'))],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        DB::beginTransaction();
        try {
            $services = $this->validateExtra($args["services"]);
            if (!$services) {
                return response()->json('Dữ liệu service không hợp lệ', 422);
            }
            $customer = Customer::find($args['customer_id']);
            $order = $customer->orders()->create([
                'no' => rand(1000, 9999),
                'amount' => 0,
                'status' => 'new',
                'node' => null,
                'store_id' => $args['store_id'],
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
            $order->save();
            DB::commit();
            return $order;
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
        $amount = $amount + $serviceItem['price'] * $serviceItem['quantity'];
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
        if ($count == 0) {
            return 0;
        }
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
                'extras' => [],
            ];
            $service = Service::select('id', 'price', 'extras')->find($serviceItem['id']);
            if ($service) {
                $serviceExtra = collect($service->extras);
                if (isset($serviceItem['extras'])) {
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
                }
                $item['quantity'] = $serviceItem['quantity'];
                $item['id'] = $serviceItem['id'];
                $item['price'] = $service->price;
            } else {
                return null;
            }
            array_push($dataService, $item);
        }
        return $dataService;
    }
}
