<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\OrderItem;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class OrderItemStatusMutation extends Mutation
{
    protected $attributes = [
        'name' => 'orderItemStatus',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('orderItem');
    }

    public function args(): array
    {
        return [
            "id" => ["name" => "id", 'type' => Type::int(), "rules" => ["required"]],
            "status" => ["name" => "status", 'type' => Type::string(), "rules" => ["required"]],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $orderItem = OrderItem::find($args['id']);
        $orderItem->status = $args['status'];
        $orderItem->save();
        return $orderItem;
    }
}
