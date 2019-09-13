<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BillItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BillItem',
        'description' => 'A type',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'amount' => [
                'type' => Type::float(),
            ],
            'quantity' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'extras' => [
                'type' => Type::string(),
            ],
            'order_item_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'bill_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'bill' => [
                'type' => GraphQL::type('bill'),
            ],
        ];
    }
    protected function resolveExtrasField($root, $args)
    {
        return json_encode($root->extras);
    }
}
