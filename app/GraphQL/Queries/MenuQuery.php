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

class MenuQuery extends Query
{
    protected $attributes = [
        'name' => 'menu',
        'description' => 'A query',
    ];

    public function type(): Type
    {
        return GraphQL::type('menu');
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
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        if (isset($args['id'])) {
            return Menu::select($select)->with($with)->find($args['id']);
        }

    }
}
