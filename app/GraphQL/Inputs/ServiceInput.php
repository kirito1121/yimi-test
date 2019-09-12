<?php

declare (strict_types = 1);

namespace App\GraphQL\Inputs;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class ServiceInput extends InputType
{
    protected $attributes = [
        'name' => 'ServiceInput',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'extras' => [
                'type' => Type::listOf(GraphQL::type('extraInput')),
            ],
            "quantity" => [
                'type' => Type::int(),
            ],
        ];
    }
    public function rules()
    {
        return [
            'id' => ['required'],
            'quantity' => ['required'],
            'extras' => ['required'],
        ];
    }
}
