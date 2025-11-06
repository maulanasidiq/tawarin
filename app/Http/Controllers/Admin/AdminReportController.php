<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $userQuery    = User::query();
        $auctionQuery = Auction::query();
        $bidQuery     = Bid::query();

        if ($startDate && $endDate) {
            $userQuery->whereBetween('created_at', [$startDate, $endDate]);
            $auctionQuery->whereBetween('created_at', [$startDate, $endDate]);
            $bidQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalUsers     = $userQuery->count();
        $totalAuctions  = $auctionQuery->count();
        $totalBids      = $bidQuery->count();
        $totalBidAmount = $bidQuery->sum('amount');

        return view('admin.reports.index', compact(
            'totalUsers',
            'totalAuctions',
            'totalBids',
            'totalBidAmount',
            'startDate',
            'endDate'
        ));
    }

    // Export ke Excel
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        return Excel::download(
            new ReportExport($startDate, $endDate),
            'laporan.xlsx'
        );
    }

    // Export ke PDF
    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $userQuery    = User::query();
        $auctionQuery = Auction::query();
        $bidQuery     = Bid::query();

        if ($startDate && $endDate) {
            $userQuery->whereBetween('created_at', [$startDate, $endDate]);
            $auctionQuery->whereBetween('created_at', [$startDate, $endDate]);
            $bidQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $data = [
            'startDate'      => $startDate,
            'endDate'        => $endDate,
            'totalUsers'     => $userQuery->count(),
            'totalAuctions'  => $auctionQuery->count(),
            'totalBids'      => $bidQuery->count(),
            'totalBidAmount' => $bidQuery->sum('amount'),
        ];

        $pdf = Pdf::loadView('admin.reports.pdf', $data);
        return $pdf->download('laporan.pdf');
    }
}
