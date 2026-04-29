<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class APInvoiceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $ref_doc;
    public function __construct($ref_doc)
    {
        $this->ref_doc = $ref_doc;
    }
    public function collection()
    {
        return DB::table('APInvoiceDtl')
        ->where('APInvoiceID', $this->ref_doc)
        ->select(
            DB::raw('MAX(PartNum) AS PartNum'),
            DB::raw('MAX(PartDesc) AS PartDesc'),
            DB::raw('SUM(Qty) AS Qty'),
            DB::raw('MAX(PriceGR) AS PriceGR'),
            DB::raw('MAX(PricePO) AS PricePO'),
            DB::raw('SUM(AmountGR) AS AmountGR'),
            DB::raw('SUM(AmountPO) AS AmountPO'),
            DB::raw('MAX(UOM) AS UOM')
        )
        ->groupBy('PartNum')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Part',
            'Description',
            'Total Qty',
            'GR Price',
            'PO Price',
            'GR Amount',
            'PO Amount',
            'UOM'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
