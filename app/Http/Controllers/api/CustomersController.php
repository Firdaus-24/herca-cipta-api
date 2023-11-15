<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customers::all();
        return response()->json($customer);
    }

    public function show(Customers $customer)
    {
        return response()->json($customer);
    }
}
