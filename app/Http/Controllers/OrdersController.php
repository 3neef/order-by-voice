<?php

namespace App\Http\Controllers;

use App\Services\ProductRecognitionService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function saveTranscript(Request $request)
    {
        $transcript = $request->input('transcript');

        $products = ["apple", "iphone", "mac Book","macbook", "samsung galaxy", "samsung note", "notebook"];
        $product_names = ProductRecognitionService::extractProductNames($transcript, $products );

        if ($product_names){

            return response()->json(['products' => $product_names]);
        }
        return response()->json(['status' => "nothing here"]);
    }
}
