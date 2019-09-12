<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Order;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class OrderUpdateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'orderUpdate',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('order');

    }

    public function args(): array
    {
        return [
            "id" => ["name" => "id", 'type' => Type::int(), "rules" => ["required"]],
            "customer_id" => ["name" => "customer_id", 'type' => Type::int(), "rules" => ["required"]],
            "staff_id" => ["name" => "staff_id", 'type' => Type::int(), "rules" => ["required"]],
            "store_id" => ["name" => "store_id", 'type' => Type::int(), "rules" => ["required"]],
            "status" => ["name" => "status", 'type' => Type::string(), "rules" => ["required"]],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $order = Order::find($args['id']);
        $order->status = $args['status'];
        if (!$order->staff_id) {
            $order->staff_id = $args['staff_id'];
        }
        $order->save();
        return $order;
    }
}
