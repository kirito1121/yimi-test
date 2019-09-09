<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = '04_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no', 'amount', 'note', 'status', 'customer_id', 'store_id', 'staff_id',
    ];

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff', 'staff_id');
    }
    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
