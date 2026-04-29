<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationAllPreviewExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'PartFG',
            'PartFGDesc',
            'PartMtl',
            'PartMtlDesc',
            'MtlWPrice',
            'MtlWQty',
            'PartWQty',
            'ScrapQty',
            'ScrapPrice',
            'MtlCEstimate',
            'MtlWEstimate',
            'ScrapEstimate',
            'DepreciationQty',
            'DepreciationPrice',
            'UOM',
            'VolQty',
            'Note',
            'TopEndCoil',
            'EffectiveDate',
            'ExpiredDate'
        ];
    }
}
