<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HeaderSheetImport implements ToCollection, WithHeadingRow
{
    public static $headerID;

    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {

            $row = $rows->first();

            $supplier = DB::connection('sqlsrv4')
            ->table('Erp.Vendor')
                ->where('VendorNum', $row['suppliernum'])
                ->where('Name', $row['suppliername'])
                ->first();

            if (!$supplier) {
                throw new \Exception("Supplier tidak ditemukan");
            }

            $customer = DB::connection('sqlsrv4')
            ->table('Erp.Part')
            ->whereNotNull('ProdCode')
            ->first();

            if (!$customer) {
                throw new \Exception("Customer tidak ditemukan");
            }

            DB::table('PriceListHeader')->updateOrInsert(
                [
                    'SupplierNum' => $row['suppliernum'],
                    'Customer'    => $row['customer'],
                ],
                [
                'SupplierNum' => $row['suppliernum'],
                'SupplierName' => $row['suppliername'],
                'Customer' => $row['customer'],
                'CreatedAt'=>now('Asia/Jakarta'),
                'CreatedBy'=>Auth::user()->id
            ]);
        });
    }
}
