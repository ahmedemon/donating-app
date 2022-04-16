<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'point',
        'category_id',
        'description',
        'shipping_address',
        'used_duration',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->hasOne(PurchasedProduct::class, 'product_id');
    }

    public function duration()
    {
        return $this->hasOne(Duration::class, 'id', 'used_duration');
    }
}
