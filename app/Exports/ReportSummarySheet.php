<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReportSummarySheet implements FromArray, WithTitle
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function array(): array
    {
        $userQuery    = User::query();
        $auctionQuery = Auction::query();
        $bidQuery     = Bid::query();

        if ($this->startDate && $this->endDate) {
            $userQuery->whereBetween('created_at', [$this->startDate, $this->endDate]);
            $auctionQuery->whereBetween('created_at', [$this->startDate, $this->endDate]);
            $bidQuery->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        return [
            ['Laporan Sistem Lelang'],
            ['Tanggal', now()->format('d-m-Y')],
            [],
            ['Total Users', $userQuery->count()],
            ['Total Lelang', $auctionQuery->count()],
            ['Total Tawaran', $bidQuery->count()],
            ['Total Nominal Tawaran', 'Rp ' . number_format($bidQuery->sum('amount'), 0, ',', '.')],
        ];
    }

    public function title(): string
    {
        return 'Ringkasan';
    }
}
