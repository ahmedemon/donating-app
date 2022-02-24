<?php

namespace App\Helpers\Traits;

trait BalanceModel
{
    public function getDebitPointAttribute($value)
    {
        return (float) round($value, 2);
    }

    public function getCreditPointAttribute($value)
    {
        return (float) round($value, 2);
    }

    public function getTotalCreditPointAttribute()
    {
        return $this->where('user_id', $this->user_id)->sum('credit_point');
    }

    public function getTotalDebitPointAttribute($value)
    {
        return $this->where('user_id', $this->user_id)->sum('debit_point');
    }

    public function getTotalPointBalanceAttribute()
    {
        return $this->total_credit_point - $this->total_debit_point;
    }
}