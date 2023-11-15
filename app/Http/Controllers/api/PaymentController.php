<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();

        return response()->json($payments);
    }
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }
    public function store(Request $request)
    {

        // get data penjualan
        $grandtotal = DB::table('penjualans')->where('id', $request->penjualan_id)->first();

        if (!$grandtotal) {
            return response()->json([
                "response" => "data tidak terdaftar!!"
            ], 400);
        }
        // cek total pembayaran
        $payment = DB::table('payments')->where('penjualan_id', $request->penjualan_id)->orderBy('created_at', 'DESC')->first();


        $sumgrand = 0;

        if (!$payment) {
            $sumgrand = 0;
        } else {
            $sumgrand = $payment->grand_total;
        }
        $totalpayment = round($request->payment) + $sumgrand;

        $date = str_replace('/', '-', $request->tanggal);
        $newDate = date("Y-m-d", strtotime($date));

        if (intval($payment->grand_total == $grandtotal->grand_total)) {
            return response()->json([
                "response" => "sudah lunas"
            ], 200);
        }

        if (intval($totalpayment > $grandtotal->grand_total)) {
            return response()->json(['response' => 'pembayaran melebihi penjualan'], 400);
        } elseif (intval($totalpayment == $grandtotal->grand_total)) {
            Payment::create([
                'penjualan_id' => $request->penjualan_id,
                'customer_id' => $request->customer_id,
                'tanggal' => $newDate,
                'payment' => $request->payment,
                'grand_total' => $totalpayment
            ]);

            return response()->json(['response' => 'pembayaran telah lunas'], 200);
        } else {
            Payment::create([
                'penjualan_id' => $request->penjualan_id,
                'customer_id' => $request->customer_id,
                'tanggal' => $newDate,
                'payment' => $request->payment,
                'grand_total' => $totalpayment
            ]);

            return response()->json(['response' => 'data berhasil disimpan'], 200);
        }
    }
}
