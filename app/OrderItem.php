<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = '04_order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', 'amount', 'status', 'extras', 'order_id', 'service_id',
    ];

    public function order()
    {
        return $this->hasMany('App\Order', 'order_id');
    }
    public function billItem()
    {
        return $this->hasOne('App\BillItem');
    }
    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    protected $casts = [
        'extras' => 'array',
    ];

}
