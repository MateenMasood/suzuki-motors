<?php

namespace App\Http\Controllers\Products\ProductsMiscellaneous;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVersion;

class ProductsRelatedSelect2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function select2ProductVersionModel(Request $request)
    {
        return response()->json(ProductVersion::where('product_id',$request->productId)->get(['id','model','variant_label']));
    }
}
