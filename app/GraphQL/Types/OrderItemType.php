<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OrderItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'OrderItem',
        'description' => 'A type',
        'model' => \App\OrderItem::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'status' => [
                'type' => Type::string(),
            ],
            'amount' => [
                'type' => Type::float(),
            ],
            'quantity' => [
                'type' => Type::int(),
            ],
            'extras' => [
                'type' => Type::string(),
            ],
            'order_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'service_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'order' => [
                'type' => GraphQL::type('order'),
            ],
            'billItem' => [
                'type' => GraphQL::type('billItem'),
            ],
        ];
    }
    protected function resolveExtrasField($root, $args)
    {
        return json_encode($root->extras);
    }
}
