<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UpdateNotificationUrls extends Command
{
    protected $signature = 'notifications:update-url';
    protected $description = 'Menambahkan field URL ke notifikasi lama yang belum memiliki data URL';

    public function handle()
    {
        $notifications = DB::table('notifications')
            ->whereNull('data->url')
            ->get();

        $updatedCount = 0;

        foreach ($notifications as $notif) {
            $data = json_decode($notif->data, true);

            // Pastikan ada auction_id
            if (!isset($data['auction_id'])) {
                continue;
            }

            // Buat URL berdasarkan auction_id
            $data['url'] = route('user.auctions.showWon', $data['auction_id']);

            // Simpan kembali ke database
            DB::table('notifications')
                ->where('id', $notif->id)
                ->update(['data' => json_encode($data)]);

            $updatedCount++;
        }

        $this->info("✅ Berhasil memperbarui {$updatedCount} notifikasi lama.");
    }
}
