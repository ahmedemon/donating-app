<?php

namespace App\Helpers\Traits;

use App\Models\PurchasedProduct;

trait TopBuyerTrait
{
    public function topBuyer()
    {
        return PurchasedProduct::select('user_id')->groupBy('user_id')->orderByRaw('COUNT(*) DESC')->take(10)->get();
    }
}
