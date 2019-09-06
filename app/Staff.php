<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = '02_staff';

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
