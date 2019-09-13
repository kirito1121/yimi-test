<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $table = '04_bill_items';

    protected $fillable = [
        'name', 'description', 'quantity', 'extras', 'amount', 'bill_id', 'order_item_id',
    ];

    public function bill()
    {
        return $this->belongsTo('App\Bill', 'bill_id');
    }

    public function orderItem()
    {
        return $this->belongsTo('App\OrderItem', 'order_item_id');
    }

    protected $casts = [
        'extras' => 'array',
    ];
}
