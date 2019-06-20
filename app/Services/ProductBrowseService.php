<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;

class ProductBrowseService
{
    const COOKIE_NAME = 'bp';
    const EXPIRE_MINUTES = 86400 * 7;
    const DELIMITER = ',';

    public function setBrowseProductCookie($productId)
    {
        $browseProductIdArray = $this->getBrowseProductsIdArray();

        if (in_array($productId, $browseProductIdArray)) {
            return null;
        } elseif (count($browseProductIdArray) >= 8) {
            //remove the first element from an array.
            array_shift($browseProductIdArray);
        }
        //Push one or more elements onto the end of array.
        array_push($browseProductIdArray, $productId);

        $browseProductIdString = implode(self::DELIMITER, $browseProductIdArray);
        $cookie = cookie(self::COOKIE_NAME, $browseProductIdString, self::EXPIRE_MINUTES);
        return Cookie::queue($cookie);
    }

    public function getBrowseProductsIdArray()
    {
        $browseProductsIdString = Cookie::get(self::COOKIE_NAME);
        if (empty($browseProductsIdString)) {
            $browseProductsIdArray = [];
        } else {
            $browseProductsIdArray = explode(self::DELIMITER, $browseProductsIdString);
        }
        return $browseProductsIdArray;
    }
}
