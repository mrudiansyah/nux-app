<?php

namespace App\Imports;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class QuotationImport implements 
    ToCollection,
    WithHeadingRow,
    WithChunkReading
{
    protected $headerID;

    public function __construct($headerID)
    {
        $this->headerID = $headerID;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['partfinishgood']) || empty($row['partmaterial'])) {
                continue;
            }
            $effectiveDate = null;
            $expireDate = null;
            if (!empty($row['effectivedate'])) {

                if (is_numeric($row['effectivedate'])) {
                    $effectiveDate = Date::excelToDateTimeObject($row['effectivedate'])
                                        ->format('Y-m-d');
                } else {
                    $effectiveDate = Carbon::parse($row['effectivedate'])
                                        ->format('Y-m-d');
                }
            }
            if (!empty($row['expiredate'])) {

                if (is_numeric($row['expiredate'])) {
                    $expireDate = Date::excelToDateTimeObject($row['expiredate'])
                                        ->format('Y-m-d');
                } else {
                    $expireDate = Carbon::parse($row['expiredate'])
                                        ->format('Y-m-d');
                }
            }
            $base_db = DB::table('PriceListMtl')
            ->where('HeaderID', $this->headerID)
            ->where('PartFG', $row['partfinishgood'])
            ->where('PartMtl', $row['partmaterial'])
            ->select('MtlWQty','ScrapEstimate','ScrapQty','ScrapPrice','MtlID')
            ->first();
            $price = round((float) str_replace(',', '', $row['price'] ?? 0));
            $topEndCoil = round((float) str_replace(',', '.', $row['topendcoil'] ?? 0), 3);
            $mtlQty = round((float)$base_db->MtlWQty, 3);
            $rawMtl = ( $mtlQty + $topEndCoil) * $price;
            $scrap = round($base_db->ScrapEstimate);
            $MtlWEstimate = round($rawMtl);
            $MtlCEstimate = round($rawMtl - $scrap);
            DB::table('PriceListMtl')
                ->where('HeaderID', $this->headerID)
                ->where('PartFG', $row['partfinishgood'])
                ->where('PartMtl', $row['partmaterial'])
                ->update([
                    'MtlWPrice' => $price ?? 0,
                    'MtlWEstimate'=>$MtlWEstimate,
                    'MtlCEstimate'=>$MtlCEstimate,
                    'EffectiveDate'=>$effectiveDate,
                    'ExpiredDate'=>$expireDate
                ]);
            $other_cost = DB::table('PriceListOtherCost')
            ->where('HeaderID',$this->headerID)
            ->where('MtlID',$base_db->MtlID)
            ->where('AdditionType','x_material_cost')
            ->select('Percentage','OtherCostID')
            ->get();
            foreach ($other_cost as $item) {
                $percentage = (float) str_replace(',', '.', $item->Percentage);
                $estimate = round($MtlCEstimate * ($percentage / 100));
                DB::table('PriceListOtherCost')
                ->where('OtherCostID',$item->OtherCostID)
                ->update([
                    'Estimate'=>$estimate
                ]);
            }
        }
    }

    public function chunkSize(): int
    {
        return 50;
    }
}