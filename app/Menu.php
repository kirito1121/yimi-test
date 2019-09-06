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
}
