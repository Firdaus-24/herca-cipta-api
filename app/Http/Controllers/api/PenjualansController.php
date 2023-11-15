<?php

namespace App\Http\Controllers\api;

use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenjualansController extends Controller
{
    public function index()
    {
        $penjualan = DB::table('marketings')
            ->join('penjualans', 'marketings.id', '=', 'penjualans.marketing_id')
            ->select(
                DB::raw('sum(penjualans.total_balance) as jual'),
                DB::raw("marketings.nama"),
                DB::raw("MONTH(penjualans.date) as bulan"),
                DB::raw("CASE WHEN SUM(penjualans.total_balance) > 0 AND SUM(penjualans.total_balance) <= 100000000 then '0' WHEN SUM(penjualans.total_balance) > 100000000 AND SUM(penjualans.total_balance) <= 200000000 then '2.5' WHEN SUM(penjualans.total_balance) > 200000000 AND SUM(penjualans.total_balance) <= 500000000 then '5' ELSE '10' END AS komisi"),
                DB::raw("CASE WHEN SUM(penjualans.total_balance) > 0 AND SUM(penjualans.total_balance) <= 100000000 then ROUND((0 / 100) * SUM(penjualans.total_balance),0) WHEN SUM(penjualans.total_balance) > 100000000 AND SUM(penjualans.total_balance) <= 200000000 then ROUND((2.5 /100) * SUM(penjualans.total_balance),0) WHEN SUM(penjualans.total_balance) > 200000000 AND SUM(penjualans.total_balance) <= 500000000 then ROUND((5 /100) * SUM(penjualans.total_balance),0) ELSE ROUND((10 /100) * SUM(penjualans.total_balance),0) END AS knom")
            )
            ->groupBy(DB::raw('MONTH(penjualans.date), YEAR(penjualans.date), marketings.nama'))
            ->get();

        // $penjualan = DB::select("SELECT MONTH(penjualans.date) as bulan, marketings.nama, SUM(penjualans.total_balance) as jual, marketings.nama FROM marketings LEFT JOIN penjualans ON marketings.id = penjualans.marketing_id GROUP BY marketings.nama, MONTH(penjualans.date), YEAR(penjualans.date),marketings.nama,marketings.id ORDER BY bulan");

        return response()->json($penjualan);
    }
}
