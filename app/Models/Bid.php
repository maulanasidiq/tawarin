<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'user_id',
        'amount',
        'is_winner', // kalau pakai opsi flag winner
    ];

    // Relasi ke user (penawar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke auction
    public function auction()
    {
        return $this->belongsTo(\App\Models\Auction::class);
    }
}
