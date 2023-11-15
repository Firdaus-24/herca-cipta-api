<?php

namespace App\Http\Controllers\api;

use App\Models\Marketings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketingsController extends Controller
{
    public function index(Request $request)
    {
        $marketings = Marketings::all();
        return response()->json($marketings);
    }

    public function show(Marketings $marketings, $id)
    {
        $marketing = Marketings::find($id);
        return response()->json($marketing);
    }
}
