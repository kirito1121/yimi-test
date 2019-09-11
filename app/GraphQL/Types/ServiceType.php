<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ServiceType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Service',
        'description' => 'A type',
        'model' => \App\Service::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the menu',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the menu',
            ],
            'unit' => [
                'type' => Type::string(),
                'description' => 'The unit of the menu',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the menu',
            ],
            'image' => [
                'type' => Type::string(),
                'description' => 'The description of the menu',
            ],
            'extras' => [
                'type' => Type::string(),
                'description' => 'The extra of the menu',
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'The price of the menu',
            ],
            'minutes' => [
                'type' => Type::int(),
                'description' => 'The minutes of the menu',
            ],
            'menus' => [
                'type' => Type::listOf(GraphQL::type('menu')),
                'description' => 'The children of the menu',
            ],
        ];
    }
    protected function resolveExtrasField($root, $args)
    {
        return json_encode($root->extras);
    }

}
