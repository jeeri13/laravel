<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    // use HasFactory;
    protected $table = 'promocodes';
    protected $fillable = [
        'code',
        'type',
        'value',
        'user_id',
        'is_redeemed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
