<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Helpers\OrderHelper;
use App\Order;
use Closure;
use DB;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class OrderItemUpdateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'orderItemUpdate',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('order');
    }

    public function args(): array
    {
        return [
            "order_id" => ["name" => "order_id", 'type' => Type::int(), "rules" => ["required"]],
            "services" => ["name" => "services", 'type' => Type::listOf(GraphQL::type('serviceInput'))],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        DB::beginTransaction();
        try {
            $orderHelper = new OrderHelper;
            $services = $orderHelper->validateExtra($args['services']);
            if (!$services) {
                return response()->json('Dữ liệu service không hợp lệ', 422);
            }
            $order = Order::with('orderItems')->find($args['order_id']);
            $amount = null;
            foreach ($services as $serviceItem) {
                $total = $orderHelper->amount($serviceItem);
                $amount += $total;
                if (isset($serviceItem['id'])) {
                    $order->orderItems()->where('id', $serviceItem['id'])->update([
                        'quantity' => $serviceItem['quantity'],
                        'service_id' => $serviceItem['service_id'],
                        'amount' => $total,
                        'status' => 'wait',
                        'extras' => json_encode($serviceItem['extras']),
                    ]);
                } else {
                    $order->orderItems()->create([
                        'quantity' => $serviceItem['quantity'],
                        'service_id' => $serviceItem['service_id'],
                        'amount' => $total,
                        'status' => 'wait',
                        'extras' => $serviceItem['extras'],
                    ]);
                }
            }
            $order->amount = $amount;
            $order->save();
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e);
        }
    }
}
