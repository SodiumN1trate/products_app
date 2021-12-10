<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductSearchController extends Controller
{
    public function search($title){
        error_log($title);
        $results = Product::where("title", "LIKE", "%$title")->get();
        return ProductResource::collection($results);
    }
}
