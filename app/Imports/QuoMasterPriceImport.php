<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class QuoMasterPriceImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new HeaderSheetImport(),
            1 => new MaterialSheetImport(),
            2 => new PurchaseSheetImport(),
            3 => new ProcessSheetImport(),
            4 => new OtherCostSheetImport(),
        ];
    }
}
