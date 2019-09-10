<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MenuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Menu',
        'description' => 'A type',
        'model' => \App\Menu::class,
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
            'index' => [
                'type' => Type::int(),
                'description' => 'The index of the menu',
            ],
            'parent_id' => [
                'type' => Type::int(),
                'description' => 'The parent of the menu',
            ],
            'deleted_at' => [
                'type' => Type::string(),
                'description' => 'The deleted_at of the menu',
            ],
            'children' => [
                'type' => Type::listOf(GraphQL::type('menu')),
                'description' => 'The children of the menu',
            ],
            'services' => [
                'type' => Type::listOf(GraphQL::type('service')),
                'description' => 'The services of the menu',
            ],
        ];
    }
}
