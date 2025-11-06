<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;

class UserAuctionController extends Controller
{
    /**
     * Menampilkan semua tawaran user login
     */
    public function bids()
    {
        $bids = Bid::with('auction')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.bids.index', compact('bids'));
    }

    /**
     * Menampilkan semua lelang yang dimenangkan user login
     */
    public function won()
    {
        $wonBids = Bid::with('auction')
            ->where('user_id', auth()->id())
            ->where('is_winner', true)
            ->latest()
            ->paginate(10);

        return view('user.auctions.won', compact('wonBids'));
    }

    public function showWon($id)
    {
        $auction = \App\Models\Auction::with(['bids.user'])->find($id);

        if (!$auction) {
            abort(404, 'Lelang tidak ditemukan.');
        }

        $winnerBid = $auction->bids()
            ->where('user_id', auth()->id())
            ->where('is_winner', true)
            ->first();

        if (!$winnerBid) {
            abort(403, 'Anda tidak berhak melihat detail lelang ini.');
        }

        return view('user.auctions.show-won', compact('auction', 'winnerBid'));
    }

    public function bidded()
    {
        $myAuctions = Auction::where('user_id', auth()->id())
            ->whereHas('bids') // hanya yang sudah ada tawaran
            ->with('bids.user')
            ->latest()
            ->paginate(10);

        return view('user.auctions.my-bidded', compact('myAuctions'));
    }
}
