<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OptionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Option',
        'description' => 'A type',
        'model' => \App\Option::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the option',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the option',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of the option',
            ],
            'index' => [
                'type' => Type::int(),
                'description' => 'The index of the option',
            ],
            'default' => [
                'type' => Type::boolean(),
                'description' => 'The default of the option',
            ],
            'price' => [
                'type' => Type::Double(),
                'description' => 'The index of the option',
            ],
            'extra' => [
                'type' => GraphQL::type('extra'),
                'description' => 'The index of the option',
            ],
        ];
    }
}
