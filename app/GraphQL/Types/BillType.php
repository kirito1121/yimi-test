<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BillType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Bill',
        'description' => 'A type',
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
            'amount' => [
                'type' => Type::float(),
            ],
            'created_at' => [
                'type' => Type::string(),
            ],
            'order_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'store_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'staff_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'customer_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'billItems' => [
                'type' => Type::listOf(GraphQL::type('billItem')),
            ],
            'order' => [
                'type' => GraphQL::type('order'),
            ],
        ];
    }
}
