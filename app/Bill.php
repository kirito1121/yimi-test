<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = '04_bills';

    public function billItems()
    {
        return $this->hasMany('App/BillItem');
    }

    public function order()
    {
        return $this->belongsTo('App/Order', 'order_id');
    }

}
