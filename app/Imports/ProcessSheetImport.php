<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProcessSheetImport implements ToCollection, WithHeadingRow
{
    public static $totalProcessEstimate = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index=> $row) {
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
            $estimate = $row['stroke'] * $row['rate'];
            DB::table('PriceListProcess')->updateOrInsert([
                'HeaderID' => $material->HeaderID,
                'MtlID'=>$material->MtlID,
                'NameProcess'=>$row['nameprocess'],
                'Machine'=>$row['machine'],
                'Stroke'=>$row['stroke'],
                'Rate'=>$row['rate'],
                'Estimate' => $estimate
            ]);
        }
    }
}

