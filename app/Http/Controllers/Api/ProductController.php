<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function order(Request $request)
    {
        $response = [];

        $product = Product::find($request->product_id);
        $quantity = $request->quantity;
        if($product->available_stock >= $quantity){
            $product->decrement('available_stock',$quantity);
            $response = response()->json(['message' => "You have successfully ordered this product."],201);
        }
        else{
            $response = response()->json(['message' => "Failed to order this product due to unavailability of the stock"],400);
        }

        return $response;
    }
}
