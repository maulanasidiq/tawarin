<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class AdminBidController extends Controller
{
    public function index()
    {
        // ambil tawaran terbaru dengan relasi user & auction
        $bids = Bid::with(['user', 'auction'])->latest()->paginate(10);
        return view('admin.bids.index', compact('bids'));
    }

    public function destroy(Bid $bid)
    {
        try {
            $bid->delete();
            return redirect()->route('admin.bids.index')
                ->with('success', 'Tawaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.bids.index')
                ->with('error', 'Gagal menghapus tawaran: ' . $e->getMessage());
        }
    }
}
