<?php

namespace App\Helpers\Traits;

use App\Helpers\BalanceHelper as Balance;
use Illuminate\Support\Facades\Auth;

trait WalletTrait
{
    public function allWallets($user_id)
    {
        $wallet['current_balance'] = number_format(round(Balance::getCurrentPointBalance($user_id), 2), 2);
        $wallet['total_purchased_balance'] = number_format(round(Balance::getTotalPurchasedBalance($user_id), 2), 2);
        return $wallet;
    }

    public function getWalletNames()
    {
        $wallet_names['current_balance'] = 'Available Point';
        $wallet_names['total_purchased_balance'] = 'Purchased Point';
        return $wallet_names;
    }
}
