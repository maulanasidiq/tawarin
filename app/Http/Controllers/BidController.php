<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;

class BidController extends Controller
{
    public function store(Request $request, Auction $auction)
    {
        // 🔒 1️⃣ Cegah user menawar barang milik sendiri
        if ($auction->user_id === auth()->id()) {
            return back()->with('error', '❌ Kamu tidak bisa menawar barang milikmu sendiri.');
        }

        // 🕒 2️⃣ Cegah menawar kalau lelang sudah berakhir
        if ($auction->end_time->isPast()) {
            return back()->with('error', '⚠️ Lelang ini sudah berakhir.');
        }

        // 💰 3️⃣ Validasi nominal tawaran
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:' . ($auction->current_price + 1000), // minimal 1.000 lebih tinggi
            ],
        ]);

        // 🧾 4️⃣ Simpan bid baru
        $auction->bids()->create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
        ]);

        // 🔁 5️⃣ Update harga saat ini
        $auction->update([
            'current_price' => $request->amount,
        ]);

        // ✅ 6️⃣ Balikan notifikasi sukses
        return back()->with('success', '✅ Penawaran berhasil dikirim!');
    }
}
