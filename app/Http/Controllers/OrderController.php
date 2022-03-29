<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function read()
    {
        $order = Order::with(['product'])->get();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $order,
        ]);
    }
}