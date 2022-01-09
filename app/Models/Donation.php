<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Donation extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'title',
        'price',
        'point',
        'category',
        'description',
        'shipping_address',
        'images',
        'used_duration',
    ];

    public function category()
    {
        return $this->belognsTo(Category::class);
    }
}
