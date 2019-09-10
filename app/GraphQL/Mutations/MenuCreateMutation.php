<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Menu;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class MenuCreateMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Create menu',
    ];

    public function type(): Type
    {
        return GraphQL::type('menu');
    }

    public function args(): array
    {
        return [
            // 'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string(), "rules" => ['required']],
            'index' => ['name' => 'index', 'type' => Type::int(), "rules" => ['numeric']],
            'parent_id' => ['name' => 'parent_id', 'type' => Type::int(), "rules" => ['numeric']],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $menu = Menu::create($args);
        return $menu;
    }
}
