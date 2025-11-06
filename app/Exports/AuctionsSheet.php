<?php

namespace App\Exports;

use App\Models\Auction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AuctionsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function collection()
    {
        $query = Auction::select('id', 'title', 'start_date', 'end_date', 'created_at');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['ID', 'Judul Lelang', 'Tanggal Mulai', 'Tanggal Selesai', 'Dibuat Pada'];
    }

    public function title(): string
    {
        return 'Data Lelang';
    }
}
