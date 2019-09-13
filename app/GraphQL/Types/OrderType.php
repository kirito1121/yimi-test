<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OrderType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Order',
        'description' => 'A type',
        'model' => \App\Order::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'no' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::string(),
            ],
            'amount' => [
                'type' => Type::float(),
            ],
            'note' => [
                'type' => Type::string(),
            ],
            'store_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'staff_id' => [
                'type' => Type::int(),
            ],
            'customer_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'orderItems' => [
                'type' => Type::listOf(GraphQL::type('orderItem')),
            ],
            'bills' => [
                'type' => Type::listOf(GraphQL::type('bill')),
            ],
        ];
    }
}
