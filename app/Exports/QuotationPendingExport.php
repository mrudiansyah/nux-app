<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationPendingExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'PartFG' => $item->PartFG,
                'PartFGDesc' => $item->PartFGDesc,
                'PartMtl' => $item->PartMtl,
                'PartMtlDesc' => $item->PartMtlDesc,
                'MtlWPrice' => number_format($item->MtlWPrice,2,'.',','),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Part Number',
            'Part Name',
            'Raw Material',
            'Material Spec',
            'Material Price'
        ];
    }
}
