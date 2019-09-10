<?php

declare (strict_types = 1);

namespace App\GraphQL\Queries;

use App\Menu;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class MenusQuery extends Query
{
    protected $attributes = [
        'name' => 'menu',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('menu'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'index' => ['name' => 'index', 'type' => Type::int()],
            'parent_id' => ['name' => 'parent_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        \Log::info('vaoa day roi');
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $menus = Menu::select($select)->with($with)->whereNull('parent_id')->get();
        return $menus;
    }
}
