<?php

namespace App\Helpers\Traits;

use App\Helpers\BalanceHelper as Balance;
use Illuminate\Support\Facades\Auth;

trait WalletTrait
{
    public function allWallets($user_id)
    {
        $wallet['current_balance'] = Balance::getCurrentPointBalance($user_id);

        $wallet['total_purchased_balance'] = Balance::getTotalPurchasedBalance($user_id);
        $wallet['total_purchased'] = Balance::getTotalPurchased($user_id);

        $wallet['total_sale_balance'] = Balance::getTotalSaleBalance($user_id);
        $wallet['total_sale'] = Balance::getTotalSale($user_id);
        // $wallet['total_purchased_balance'] = number_format(round(Balance::getTotalPurchasedBalance($user_id), 2), 2);
        return $wallet;
    }

    public function getWalletNames()
    {
        $wallet_names['current_balance'] = 'Available Point';

        $wallet_names['total_purchased_balance'] = 'Debited Points';
        $wallet_names['total_purchased'] = 'Total Got';

        $wallet_names['total_sale_balance'] = 'Credited Points';
        $wallet_names['total_sale'] = 'Total Give';
        return $wallet_names;
    }
}
