<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    public function index(Request $request)
    {
        $query = Auction::active(); // ⏳ hanya tampilkan lelang aktif

        // 🔎 Filter & sort
        if ($request->sort === 'lowest_price') {
            $query->orderBy('current_price', 'asc');
        } elseif ($request->sort === 'highest_price') {
            $query->orderBy('current_price', 'desc');
        } elseif ($request->sort === 'ending_soon') {
            $query->orderBy('end_time', 'asc');
        } else {
            $query->latest();
        }

        $auctions = $query->paginate(9);

        return view('auctions.index', compact('auctions'));
    }



    public function dashboard()
    {
        $userId = Auth::id();

        $activeAuctions = Auction::active()->count();

        $myBids = \App\Models\Bid::where('user_id', $userId)->count();

        // ✅ hitung dari tabel bids, bukan auctions
        $wonAuctions = \App\Models\Bid::where('user_id', $userId)
            ->where('is_winner', true)
            ->count();

        return view('dashboard', compact('activeAuctions', 'myBids', 'wonAuctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'starting_price' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi multi
        ]);

        $auction = new Auction();
        $auction->user_id = Auth::id();
        $auction->title = $request->title;
        $auction->description = $request->description;
        $auction->starting_price = $request->starting_price;
        $auction->current_price = $request->starting_price;
        $auction->start_time = $request->start_time;
        $auction->end_time = $request->end_time;
        $auction->status = 'active';
        $auction->save();

        // Simpan semua gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('auction_images', 'public');
                $auction->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('auctions.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(Auction $auction)
    {
        // ikutkan relasi user, bids, dan images
        $auction->load(['bids.user', 'images']);

        return view('auctions.show', compact('auction'));
    }

    public function close($id)
    {
        $auction = Auction::findOrFail($id);

        // ✅ Cegah eksekusi ulang kalau sudah punya pemenang
        if ($auction->winner_id) {
            return redirect()->back()->with('info', 'Pemenang sudah ditentukan sebelumnya.');
        }

        // ✅ Ambil bid tertinggi
        $highestBid = Bid::where('auction_id', $auction->id)
            ->orderByDesc('amount')
            ->first();

        if (!$highestBid) {
            return redirect()->back()->with('error', 'Tidak ada penawaran untuk lelang ini.');
        }

        // ✅ Reset semua bid jadi bukan pemenang dulu
        Bid::where('auction_id', $auction->id)->update(['is_winner' => false]);

        // ✅ Tandai bid tertinggi sebagai pemenang
        $highestBid->is_winner = true;
        $highestBid->save();

        // ✅ Update kolom winner_id dan ubah status ke finished
        $auction->winner_id = $highestBid->user_id;
        $auction->status = 'finished';
        $auction->save();

        return redirect()->back()->with('success', 'Lelang berhasil ditutup dan pemenang telah ditentukan.');
    }
}
