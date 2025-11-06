<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bid; // 🔹 tambahkan ini

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // 🔹 Semua tawaran user
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // 🔹 Tawaran yang dimenangkan user
    public function wonBids()
    {
        return $this->hasMany(Bid::class)->where('is_winner', true);
    }
}
