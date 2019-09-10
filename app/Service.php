<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = '03_services';

    protected $fillable = [
        'name', 'price', 'minutes', 'unit', 'description', 'image', 'extras',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function menus()
    {
        return $this->belongsToMany('App\Menu', '03_menu_services', 'service_id', 'menu_id')->withPivot('price', 'hot', 'index');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    // protected $casts = [
    //     "extras" => "array",
    // ];
}
