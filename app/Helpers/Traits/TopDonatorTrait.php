<?php

namespace App\Helpers\Traits;

use App\Models\Donation;

trait TopDonatorTrait
{
    public function topDonator()
    {
        return Donation::select('user_id')->groupBy('user_id')->orderByRaw('COUNT(*) DESC')->take(10)->get();
    }
}
