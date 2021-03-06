<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Customer;
use App\Helpers\OrderHelper;
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
        $orderHelper = new OrderHelper;

        DB::beginTransaction();
        try {
            $services = $orderHelper->validateExtra($args["services"]);
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
                $amount = $orderHelper->amount($serviceItem);
                $order->amount += $amount;
                $order->orderItems()->create([
                    'quantity' => $serviceItem['quantity'],
                    'service_id' => $serviceItem['service_id'],
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
}
