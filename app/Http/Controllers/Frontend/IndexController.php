<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\multiplImage;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $slides = Slider::where('status', 1)->orderBy('id', 'DESC')->get();
        $categores = Category::latest()->get();
        $productes = Product::latest()->get();
        $features = Product::where('featured', 1)->get();
        $hot_deals = Product::where('hot_deals', 1)->get();
        $special_offer = Product::where('special_offer', 1)->get();
        $special_deals = Product::where('special_deals', 1)->get();
        return view('frontend.index', compact('slides', 'categores', 'productes', 'features', 'hot_deals', 'special_offer', 'special_deals')); 
    }
    
    public function single_product($id, $slug)
    {
        $product = Product::findOrFail($id);
        $multi_image = multiplImage::where('product_id', $product->id)->get(); 
        return view('frontend.single-prod', compact('product', 'multi_image'));

    }

    public function tags_product($tags)
    {
        $tags_products = Product::where('status', 1)->where('product_tags_en', $tags)->orWhere('product_tags_bn', $tags)->orderBy('id', 'DESC')->get();
        return view('frontend.tags-product', compact('tags_products'));
    }

    public function productViewAjax($id)
    {
        $product = Product::with('category','brand')->findOrFail($id); 
        $product_color = explode(',',  $product->product_color_en);
        $product_size = explode(',', $product->product_size_en);

        return response()->json([
            'product'=>$product,
            'product_color'=>$product_color,
            'product_size'=>$product_size, 
        ]);
    }


}