<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationExport implements FromCollection, WithHeadings
{
    protected $search, $filter, $effective, $expired;

    public function __construct($search, $filter, $effective, $expired)
    {
        $this->search    = $search;
        $this->filter    = $filter;
        $this->effective = $effective;
        $this->expired   = $expired;
    }

    public function collection()
    {
        $query = DB::connection('vendor-app-epicor')
            ->table('QuotationHeader as a')
            ->leftJoin('QuotationPurchase as b' ,'a.HeaderID','=','b.HeaderID')
            ->select(
                'a.SupplierName',
                'a.Customer',
                'a.EffectiveDate',
                'a.ExpiredDate',
                // DB::raw("
                //     CASE 
                //         WHEN a.Status >= 3 THEN 'Approved'
                //         ELSE 'Waiting'
                //     END AS Approved
                // "),
                // DB::raw("
                //     CASE 
                //         WHEN a.Status = 4 THEN 'Legalize'
                //         ELSE '-'
                //     END AS Legalize
                // "),

                'a.PartFG',
                'a.PartFGDesc',
                'a.PartMtl',
                'a.PartMtlDesc',
                'a.MtlWPrice',
                'b.PurchasePart',
                'b.SpecPurchasePart',
                'b.Estimate',
                DB::raw('COALESCE(a.PassTotalSalesPrice, 0) AS PassTotalSalesPrice'),
                'a.CurrentTotalSalesPrice',
                DB::raw('
                COALESCE(a.CurrentTotalSalesPrice - a.PassTotalSalesPrice, 0) AS GAP
            '),
        
            DB::raw('
                CASE 
                    WHEN a.PassTotalSalesPrice IS NULL 
                         OR a.PassTotalSalesPrice = 0
                         OR a.CurrentTotalSalesPrice IS NULL
                    THEN 0
                    ELSE 
                        ((a.CurrentTotalSalesPrice - a.PassTotalSalesPrice) / a.PassTotalSalesPrice) * 100
                END AS Percentage
            ')
            )
            ->where('Status', '>=', 2);

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Supplier',
            'Customer',
            'Effective Date',
            'Expired Date',
            'Part Number',
            'Part Name',
            'Raw Material',
            'Material Spec',
            'Raw Material Price',
            'Standard',
            'Standard Part Name',
            'Standard Part Estimate',
            'Previous Price',
            'New Update Price',
            'GAP',
            'Percentage'
        ];
    }
}
