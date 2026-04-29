<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaterialSheetImport implements ToCollection, WithHeadingRow
{
    public static $materials = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $header = DB::table('PriceListHeader')
            ->where('SupplierNum',$row['suppliernum'])
            ->where('Customer',$row['customer'])
            ->first();
            if(!$header){
                throw new \Exception("Header Tidak ditemukan");
            }
            if ($row['uom'] != 'KG' && (empty($row['mtlsheetprice']) || $row['mtlsheetprice'] <=0 )) {
                throw new \Exception("Mtl Sheet Price wajib jika UOM bukan KG");
            }
            $mtlWEstimate = $row['mtlweightqty'] * $row['mtlweightprice'];
            $scrapQty = $row['mtlweightqty'] - $row['partweightqty'];
            $scrapEstimate = $scrapQty * $row['scrapprice'];
            $mtlCEstimate = $mtlWEstimate - $scrapEstimate;
            if ($header->SupplierNum == 24 && str_ends_with($row['partmtldesc'], 'XC')) {                                       
                $MQ= $row['mtlweightqty'];
                $TEC=0.01 * $MQ;
                $scrapQty = $MQ + $TEC - $row['partweightqty'];
                $mtl_total = $row['mtlweightqty'] - $TEC;
                $scrap_total = $scrapQty * $row['scrapprice'];
                $mtlCEstimate = $mtl_total - $scrap_total;
            }
            DB::table('PriceListMtl')->updateOrInsert([
                'HeaderID' => $header->HeaderID,
                'PartFG' => $row['partfg'],
                'PartFGDesc'=>$row['partfgdesc'],
                'PartMtl' => $row['partmtl'],
                'PartMtlDesc'=>$row['partmtldesc'],
                'MtlWQty' => $row['mtlweightqty'],
                'MtlWPrice' => $row['mtlweightprice'],
                'PartWQty'=>$row['partweightqty'],
                'ScrapQty'=>$scrapQty,
                'ScrapPrice'=>$row['scrapprice'],
                'MtlWEstimate' => $mtlWEstimate,
                'ScrapEstimate' => $scrapEstimate,
                'MtlCEstimate' => $mtlCEstimate,
                'DepreciationQty'=>$row['depreciationqty'],
                'DepreciationPrice'=>$row['depreciationprice'],
                'UOM' => $row['uom'],
                'MtlSPrice'=>$row['mtlsheetprice'],
                'VolQty'=>$row['volqty'],
                'EffectiveDate'=>$row['effectivedate'],
                'ExpiredDate'=>$row['expireddate']
            ]);
        }
    }
}

