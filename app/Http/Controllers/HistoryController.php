<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Riwayat semua tawaran user
        $bids = $user->bids()->with('auction')->latest()->paginate(10);

        // Lelang yang dimenangkan user
        $wonBids = $user->wonBids()->with('auction')->latest()->paginate(10);

        return view('history.index', compact('bids', 'wonBids'));
    }
}
