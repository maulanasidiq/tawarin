<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\Auction;

class AuctionWonNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $auction;

    public function __construct(Auction $auction)
    {
        $this->auction = $auction;
    }

    public function via($notifiable)
    {
        // hanya simpan di database
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Selamat! Kamu memenangkan lelang 🎉',
            'message' => 'Kamu menang pada lelang ' . $this->auction->title,
            'auction_id' => $this->auction->id,
        ];
    }
}
