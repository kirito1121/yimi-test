<?php

declare (strict_types = 1);

namespace App\GraphQL\Mutations;

use App\Menu;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class MenuDeleteRestoreMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Delete-restore menu',
    ];

    public function type(): Type
    {
        return GraphQL::type('menu');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $menu = Menu::withTrashed()->find($args['id']);
        if ($menu->deleted_at) {
            $menu->restore();
        } else {
            $menu->delete();
        }
        return $menu;
    }
}
