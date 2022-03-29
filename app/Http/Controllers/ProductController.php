<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function read()
    {
        $product = Product::with(['brand', 'category'])->get();

        return response()->json([
            'code' => 1,
            'message' => 'success',
            'data' => $product,
        ]);
    }
}