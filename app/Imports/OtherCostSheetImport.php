<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OtherCostSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
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
            $rowNumber = $index + 2;
            $allowed = [
                'x_manufactur_cost',
                'x_material_cost',
                'blank_cost',
                'discount'
            ];

            if (!in_array($row['additiontype'], $allowed)) {
                throw new \Exception("AdditionType tidak valid");
            }

            if ($row['additiontype'] == 'x_manufactur_cost') {
                $totalProcessEstimate = DB::table('PriceListProcess')
                ->where('HeaderID', $material->HeaderID)
                ->sum('Estimate');
                $estimate = $row['percentage'] * $totalProcessEstimate;
            }
            elseif ($row['additiontype'] == 'x_material_cost') {
                // $material = MaterialSheetImport::$materials[$row['nameitem']] ?? null;
                $estimate = $row['percentage'] * $material->MtlCEstimate;
            }

            elseif ($row['additiontype'] == 'blank_cost') {
                if (empty($row['estimate'])) {
                    throw new \Exception("Estimate wajib diisi untuk blank_cost");
                }
                $estimate = $row['estimate'];
            }
            elseif ($row['additiontype'] == 'discount') {
                if (empty($row['estimate'])) {
                    throw new \Exception("Estimate wajib diisi untuk discount");
                }
                $estimate = -abs($row['estimate']);
            }
            DB::table('PriceListOtherCost')->updateOrInsert([
                'HeaderID' =>$material->HeaderID,
                'MtlID'=>$material->MtlID,
                'NameItem'=>$row['nameitem'],
                'Percentage'=>$row['percentage'],
                'AdditionType'=>$row['additiontype'],
                'Estimate' => $estimate
            ]);
        }
    }
}


