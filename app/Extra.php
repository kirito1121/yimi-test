<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends Model
{
    use SoftDeletes;
    protected $table = '03_extras';

    protected $fillable = [
        'name', 'index', 'multiple',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function options()
    {
        return $this->hasMany('App\Option');
    }
}
