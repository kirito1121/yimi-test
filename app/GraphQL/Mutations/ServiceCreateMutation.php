<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Service;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class ServiceCreateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createService',
        'description' => 'A mutation',
    ];

    public function type(): Type
    {
        return GraphQL::type('service');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'unit' => ['name' => 'unit', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'extras' => ['name' => 'extras', 'type' => Type::string()],
            'price' => ['name' => 'price', 'type' => Type::int()],
            'minutes' => ['name' => 'minutes', 'type' => Type::int()],
            'menu_id' => ['name' => 'menu_id', 'type' => Type::int()],
            // 'image' => ['name' => 'image', 'type' => GraphQL::type('Upload')],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $service = Service::create($args);
        return $service;
    }
}
