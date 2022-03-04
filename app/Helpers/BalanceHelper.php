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

        if (CurrentBalance::class == $balanceModel) { // buyer request debited amount
            $purchased_product = PurchasedProduct::where('user_id', $user_id)->whereIn('status', [0, 1])->whereIn('owner_approval', [0, 1])->whereIn('admin_approval', [0, 1])->sum('product_point');
            $totalCredit -= $purchased_product;
        }
        if (CurrentBalance::class == $balanceModel) { // product owner getting amount
            $purchased_product = PurchasedProduct::where('user_id', $user_id)->where('status', 1)->where('owner_approval', 1)->where('admin_approval', 1)->sum('product_point');
            $totalCredit += $purchased_product;
        }

        return $totalCredit - $totalDebit;
    }

    public static function getCurrentPointBalance($user_id)
    {
        return (float) self::getBalance(CurrentBalance::class, $user_id);
    }

    public static function getTotalPurchasedBalance($user_id)
    {
        return PurchasedProduct::where('user_id', $user_id)->whereIn('status', [0, 1])->whereIn('owner_approval', [0, 1])->sum('product_point');
    }
    public static function getTotalSaleBalance($user_id)
    {
        return PurchasedProduct::where('owner_id', $user_id)->where('status', 1)->where('owner_approval', 1)->sum('product_point');
    }
    public static function getTotalPurchased($user_id) // count ordered product
    {
        return PurchasedProduct::where('user_id', $user_id)->where('status', 1)->where('owner_approval', 1)->count('id');
    }
    public static function getTotalSale($user_id) // count saled product
    {
        return PurchasedProduct::where('owner_id', $user_id)->where('status', 1)->where('owner_approval', 1)->count('id');
    }
}
