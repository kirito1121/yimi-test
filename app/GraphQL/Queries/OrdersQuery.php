<?php

declare (strict_types = 1);

namespace App\GraphQL\Queries;

use App\Order;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class OrdersQuery extends Query
{
    protected $attributes = [
        'name' => 'orders',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('order'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $orders = Order::select($select)->with($with)->orderby('id', 'desc')->get();
        return $orders;
    }
}
