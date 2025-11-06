<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAuctions = Auction::count();
        $totalBids = Bid::count();

        $activeAuctions = Auction::where('status', 'active')->count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();

        // Aktivitas terbaru (ambil 5 tawaran terbaru)
        $recentActivities = Bid::with(['user', 'auction'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($bid) {
                return (object)[
                    'description' => "{$bid->user->name} menawar Rp " . number_format($bid->amount, 0, ',', '.') . " pada {$bid->auction->title}",
                    'created_at' => $bid->created_at,
                ];
            });

        // Lelang berakhir hari ini
        $endingToday = Auction::whereDate('end_time', Carbon::today())->count();

        // User teraktif (top 3 berdasarkan jumlah tawaran)
        $topUsers = Bid::select('user_id', DB::raw('COUNT(*) as total_bids'))
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('total_bids')
            ->take(3)
            ->get();

        // Tawaran tertinggi saat ini (ambil top 3)
        $highestBids = Bid::with(['auction', 'user'])
            ->orderByDesc('amount')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAuctions',
            'totalBids',
            'activeAuctions',
            'newUsersThisMonth',
            'recentActivities',
            'endingToday',
            'topUsers',
            'highestBids'
        ));
    }
}
