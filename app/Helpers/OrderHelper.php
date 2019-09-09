<?php

namespace App\Helpers;

class OrderHelper
{
    public function totalPrice($options, $count)
    {

        if ($count == 1) {
            return $options[$count - 1]['price'];
        }
        return $options[$count - 1]['price'] + $this->totalPrice($options, $count - 1);
    }
}
