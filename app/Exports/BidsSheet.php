<?php

namespace App\Exports;

use App\Models\Bid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BidsSheet implements FromCollection, WithHeadings, WithTitle
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
        $query = Bid::with('user', 'auction')
            ->select('id', 'user_id', 'auction_id', 'amount', 'created_at');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        return $query->get()->map(function ($bid) {
            return [
                'ID'         => $bid->id,
                'User'       => $bid->user ? $bid->user->name : '-',
                'Lelang'     => $bid->auction ? $bid->auction->title : '-',
                'Nominal'    => $bid->amount,
                'Dibuat Pada' => $bid->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'User', 'Lelang', 'Nominal Tawaran', 'Tanggal'];
    }

    public function title(): string
    {
        return 'Data Tawaran';
    }
}
