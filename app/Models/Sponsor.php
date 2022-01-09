<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SponsorItem;
class Sponsor extends Model
{
    use HasFactory;
    protected $fillable=[
        'company_name',
        'description',
        'address',
    ];
    public function sponsor_items()
    {
        return $this->hasMany(SponsorItem::class);
    }
}
