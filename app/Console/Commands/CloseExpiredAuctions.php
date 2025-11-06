<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Notifications\AuctionWonNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class CloseExpiredAuctions extends Command
{
    protected $signature = 'auctions:close-expired';
    protected $description = 'Tutup otomatis lelang yang sudah berakhir dan kirim notifikasi ke pemenang';

    public function handle()
    {
        $auctions = Auction::where('status', 'active')
            ->where('end_time', '<', now())
            ->get();

        $closedCount = 0;

        foreach ($auctions as $auction) {
            // Tandai lelang sudah berakhir
            $auction->update(['status' => 'closed']);
            $closedCount++;

            // Ambil bid tertinggi
            $highestBid = $auction->bids()->orderByDesc('amount')->first();

            if ($highestBid) {
                // Tandai bid pemenang
                $highestBid->update(['is_winner' => true]);

                // Jika tabel punya kolom winner_id → simpan id pemenang
                if (Schema::hasColumn('auctions', 'winner_id')) {
                    $auction->update(['winner_id' => $highestBid->user_id]);
                }

                // Kirim notifikasi ke pemenang
                $winner = $highestBid->user;

                if ($winner) {
                    $winner->notify(new AuctionWonNotification($auction));

                    Log::info("✅ Notifikasi dikirim ke user {$winner->id} untuk lelang {$auction->title}");
                } else {
                    Log::warning("⚠️ Tidak ditemukan user untuk bid ID {$highestBid->id}");
                }
            } else {
                Log::info("ℹ️ Lelang {$auction->id} tidak memiliki penawar.");
            }
        }

        $this->info("{$closedCount} lelang berhasil ditutup otomatis.");
    }
}
