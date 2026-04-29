<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;
            $material = DB::table('PriceListMtl')
            ->where('PartFG',$row['partfg'])
            ->where('PartMtl',$row['partmtl'])
            ->first();
            $partFG = strtoupper(trim($row['partfg']));
            $partMtl = strtoupper(trim($row['partmtl']));
            if (!$material) {
                throw new \Exception(
                    "Sheet Purchase - Baris {$rowNumber} - Material tidak ditemukan: {$partFG} / {$partMtl}"
                );
            }
            $estimate = $row['qty'] * $row['price'];

            DB::table('PriceListPurchase')->updateOrInsert([
                'HeaderID' => $material->HeaderID,
                'MtlID' => $material->MtlID,
                'PurchasePart'=>$row['purchasepart'],
                'SpecPurchasePart'=>$row['specpurchasepart'],
                'Qty'=>$row['qty'],
                'Price'=>$row['price'],
                'Estimate' => $estimate
            ]);
        }
    }
}

