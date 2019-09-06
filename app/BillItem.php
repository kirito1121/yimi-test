<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $table = '04_bill_items';

    public function bill()
    {
        return $this->belongsTo('App/Bill', 'bill_id');
    }

    public function orderItem()
    {
        return $this->belongsTo('App/OrderItem', 'order_item_id');
    }
}
