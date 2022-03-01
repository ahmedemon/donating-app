<?php

namespace App\Helpers;

use App\Models\CurrentBalance;
use App\Models\User;
use App\Models\PurchasedProduct;
/**
 * @trait HasWalletBalance
 */
class BalanceHelper
{

    public static function getBalance($balanceModel, $user_id)
    {
        $balance = $balanceModel::select('credit_point', 'debit_point')->where('user_id', $user_id)->get();
        $totalCredit = $balance->sum('credit_point'); // total amount of deposit
        $totalDebit = $balance->sum('debit_point'); // total amount of withdraw

        if (CurrentBalance::class == $balanceModel) {
            $purchased_product = PurchasedProduct::where('user_id', $user_id)
                ->whereIn('status', [0, 1])
                ->whereIn('owner_approval', [0, 1])
                ->sum('product_point');
            $totalCredit -= $purchased_product;
        }

        return $totalCredit - $totalDebit;
    }

    public static function getCurrentPointBalance($user_id)
    {
        return (float) self::getBalance(CurrentBalance::class, $user_id);
    }

    public static function getTotalPurchasedBalance($user_id)
    {
        return PurchasedProduct::where('user_id', $user_id)->whereIn('status', [0,1])->whereIn('owner_approval', [0,1])->sum('product_point');
    }
}
