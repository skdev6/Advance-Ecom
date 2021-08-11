<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function SearchProduct(Request $request)
    {
        $products = Product::where('product_name_en', 'LIKE', "%".$request->search."%")
                            ->orWhere('product_name_bn', 'LIKE', "%".$request->search."%")
                            ->orWhere('product_code', 'LIKE', "%".$request->search."%")
                            ->orWhere('short_descp_en', 'LIKE', "%".$request->search."%")
                            ->orWhere('short_descp_bn', 'LIKE', "%".$request->search."%")
                            ->orWhere('long_descp_en', 'LIKE', "%".$request->search."%")
                            ->orWhere('product_tags_en', 'LIKE', "%".$request->search."%")
                            ->orWhere('product_tags_bn', 'LIKE', "%".$request->search."%")
                            ->orWhere('long_descp_bn', 'LIKE', "%".$request->search."%")->paginate(2);

        return view('frontend.search-result', compact('products'));
    }
}
