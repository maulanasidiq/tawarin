<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class AdminAuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::latest()->paginate(10);
        return view('admin.auctions.index', compact('auctions'));
    }

    public function create()
    {
        return view('admin.auctions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'starting_price' => 'required|numeric',
        ]);

        Auction::create($request->all());

        return redirect()->route('admin.auctions.index')->with('success', 'Lelang berhasil ditambahkan.');
    }

    public function show(Auction $auction)
    {
        return view('admin.auctions.show', compact('auction'));
    }

    public function edit(Auction $auction)
    {
        return view('admin.auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'starting_price' => 'required|numeric',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive,closed',
        ]);

        // update field biasa
        $auction->title = $request->title;
        $auction->starting_price = $request->starting_price;
        $auction->description = $request->description;
        $auction->start_time = $request->start_time;
        $auction->end_time = $request->end_time;
        $auction->status = $request->status; // 🟢 tambahkan ini

        // handle upload gambar
        if ($request->hasFile('image')) {
            // hapus gambar lama kalau ada
            if ($auction->image && Storage::exists('public/' . $auction->image)) {
                Storage::delete('public/' . $auction->image);
            }

            // simpan gambar baru
            $auction->image = $request->file('image')->store('auctions', 'public');
        }

        $auction->save();

        return redirect()
            ->route('admin.auctions.index')
            ->with('success', 'Lelang berhasil diperbarui.');
    }

    public function close($id)
    {
        $auction = Auction::findOrFail($id);

        // Cari penawaran tertinggi
        $highestBid = $auction->bids()->orderBy('amount', 'desc')->first();

        if ($highestBid) {
            // Update kolom winner_id di tabel auctions
            $auction->winner_id = $highestBid->user_id;
            $auction->status = 'closed';
            $auction->save();

            // Tandai bid pemenang
            $highestBid->is_winner = true;
            $highestBid->save();
        } else {
            // Kalau tidak ada bid sama sekali, tetap ditutup tanpa pemenang
            $auction->status = 'closed';
            $auction->save();
        }

        return redirect()->route('admin.auctions.index')
            ->with('success', 'Lelang berhasil ditutup dan pemenang telah ditentukan.');
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('admin.auctions.index')->with('success', 'Lelang berhasil dihapus.');
    }
}
