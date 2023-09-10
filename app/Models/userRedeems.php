<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRedeems extends Model
{
    use HasFactory;
    // use HasFactory;
    protected $table = 'user_redeems';
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
