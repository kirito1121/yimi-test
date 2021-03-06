<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Order;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class BillCreateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'bill',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('bill');
    }

    public function args(): array
    {
        return [
            "order_id" => ["name" => "order_id", 'type' => Type::int(), "rules" => ["required"]],
            "order_items" => ["name" => "order_items", 'type' => Type::listOf(Type::int()), "rules" => ["required"]],
            "customer_id" => ["name" => "customer_id", 'type' => Type::int(), "rules" => ["required"]],
            "staff_id" => ["name" => "staff_id", 'type' => Type::int(), "rules" => ["required"]],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $order = Order::find($args['order_id']);

        $bill = $order->bills()->create([
            'no' => rand(1000, 9999),
            'amount' => 0,
            'staff_id' => $args['staff_id'],
            'customer_id' => $args['customer_id'],
            'store_id' => $order->store_id,
        ]);
        $orderItems = $order->orderitems()->whereIn('id', $args['order_items'])->get();

        foreach ($orderItems as $item) {
            $service = $item->service;
            $billItem = $bill->billItems()->create([
                "name" => $service->name,
                "description" => $service->description,
                "quantity" => $item->quantity,
                "amount" => $item->amount,
                "extras" => $item->extras,
                "order_item_id" => $item->id,
            ]);
            $bill->amount += $billItem->amount;
            $item->status = 'payment';
            $item->save();
        }
        $bill->save();
        return $bill;
    }
}
