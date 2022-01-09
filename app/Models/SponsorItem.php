<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sponsor;
class SponsorItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'category_id',
        'price',
        'reward_point',
        'description',
        'shipping_address',
        'image',
    ];
    public function sponsor()
    {
        return $this->belognsTo(Sponsor::class);
    }
}
