<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
    protected $fillable = ['duration', 'type'];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'used_duration');
    }
}
