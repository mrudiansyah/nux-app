<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PriceList extends Model
{
    use HasFactory;
    public function ListCurrency($search, $page)
    {
        return DB::connection('sqlsrv4')
            ->table('Erp.Currency')
            ->select('CurrencyCode', 'CurrDesc')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('CurrencyCode', 'LIKE', "%{$search}%")
                        ->orWhere('CurrDesc', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('CurrDesc', 'asc')
            ->paginate(50, ['*'], 'page', $page);
    }
    public function PriceList()
    {
        return DB::table('PriceHeader');
    }
    public function AllPriceDetailPart()
    {
        return DB::table('PriceDetailPart');
    }
    public function create($data)
    {
        return DB::table('PriceHeader')->insertGetId($data);
    }
    public function Part()
    {
        return DB::connection('sqlsrv4')
            ->table('Erp.Part');
    }
    public function PriceHwM(){
        return DB::table('PriceHeader as a')
        ->leftJoin('PriceDetailPart as b', 'a.ID', '=', 'b.HeaderID');
    }
}
