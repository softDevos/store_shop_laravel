<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetails;

class OrderDetailsController extends Controller
{
    public function read()
    {
        $order_detail = OrderDetails::with(['user', 'order'])->get();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $order_detail,
        ]);
    }
}