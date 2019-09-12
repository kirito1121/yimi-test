<?php

declare (strict_types = 1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class ExtraInput extends InputType
{
    protected $attributes = [
        'name' => 'ExtraInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'options' => [
                'type' => Type::listOf(Type::string()),
            ],
            'slug' => [
                'type' => Type::string(),
            ],
        ];
    }
    public function rules()
    {
        return [
            'slug' => ['required'],
            'options' => ['required'],
        ];
    }
}
