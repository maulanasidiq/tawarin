<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportExport implements WithMultipleSheets
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function sheets(): array
    {
        return [
            new ReportSummarySheet($this->startDate, $this->endDate),
            new UsersSheet($this->startDate, $this->endDate),
            new AuctionsSheet($this->startDate, $this->endDate),
            new BidsSheet($this->startDate, $this->endDate),
        ];
    }
}
