<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'owner_id', 'product_point', 'date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'product_id');
    }
}
