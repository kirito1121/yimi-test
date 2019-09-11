<?php

declare (strict_types = 1);

namespace App\GraphQL\Queries;

use App\Order;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class OrderQuery extends Query
{
    protected $attributes = [
        'name' => 'order',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return GraphQL::type('order');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $orders = Order::select($select)->with($with)->find($args['id']);
        return $orders;

    }
}
