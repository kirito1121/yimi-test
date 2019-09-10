<?php

declare (strict_types = 1);

namespace App\GraphQL\Queries;

use App\Service;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ServiceQuery extends Query
{
    protected $attributes = [
        'name' => 'service',
        'description' => 'A query',
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
            'price' => ['name' => 'price', 'type' => Type::int()],
            // 'image' => ['name' => 'image', 'type' => GraphQL::type('Upload')],
            'minutes' => ['name' => 'minutes', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $service = Service::find($args['id']);
        return $service;
    }
}
