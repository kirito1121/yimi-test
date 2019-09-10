<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = '03_menus';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    public function services()
    {
        return $this->belongsToMany('App\Service', '03_menu_services', 'menu_id', 'service_id')->withPivot('price', 'hot', 'index');
    }

    // public function parent()
    // {
    //     return $this->belongsTo(Menu::class, 'parent_id');
    // }

    // public function parents()
    // {
    //     return $this->parent()->with('parents');
    // }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->menus()->with('children');
    }
}
