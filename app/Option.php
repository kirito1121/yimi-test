<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;
    protected $table = '03_options';

    protected $fillable = [
        'name', 'price', 'default', 'extra_id', 'index',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    public function extra()
    {
        return $this->belongsTo('App\Extra', 'extra_id');
    }
}
