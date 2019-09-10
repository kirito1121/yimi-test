<?php

declare (strict_types = 1);

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ExtraType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Extra',
        'description' => 'A type',
        'model' => \App\Extra::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the extra',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the extra',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of the extra',
            ],
            'index' => [
                'type' => Type::int(),
                'description' => 'The index of the extra',
            ],
            'multiple' => [
                'type' => Type::boolean(),
                'description' => 'The multiple of the extra',
            ],
            'options' => [
                'type' => Type::listOf(GraphQL::type('option')),
                'description' => 'The options of the extra',
            ],
        ];
    }
}
