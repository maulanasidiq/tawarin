<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starting_price',
        'current_price',
        'status',
        'start_time',
        'end_time',
        'user_id',
        'winner_id'
    ];

    protected $casts = [
        'end_time' => 'datetime',
    ];

    // 🔗 Relasi ke Bid
    public function bids()
    {
        return $this->hasMany(Bid::class, 'auction_id');
    }

    // 🔗 Relasi ke User (pemilik lelang)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(AuctionImage::class);
    }

    // 🔗 Relasi ke User (pemenang)
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    // 🔍 Scope untuk menampilkan lelang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('end_time', '>=', now());
    }

    // 🏆 Helper untuk mendapatkan bid tertinggi
    public function highestBid()
    {
        return $this->bids()->orderByDesc('amount')->first();
    }

    // 🧩 Helper untuk menentukan apakah lelang sudah berakhir
    public function isEnded()
    {
        return $this->end_time->isPast();
    }
}
