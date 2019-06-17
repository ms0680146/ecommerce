<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    const SALE_TYPE_PRICE = 1;
    const SALE_TYPE_DISCOUNT = 2;

    public function discount($total)
    {
        switch($this->sale_type) {
            case self::SALE_TYPE_PRICE:
                $salePrice = (int) $this->sale_string;
                break;
            case self::SALE_TYPE_DISCOUNT:
                $salePrice = (1 - $this->sale_string) * $total;
                break;
            default:
                $salePrice = 0;    
        }
        return $salePrice;
    }
}
