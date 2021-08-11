<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $product = Wishlist::with('products')->where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('product'));
    }
    public function store(Request $request, $id)
    {
        if(Auth::check()){
            $exists = Wishlist::where('user_id', Auth::id())->where("product_id", $id)->first();
            if(!$exists){
                Wishlist::insert([
                    'user_id'=>Auth::id(),
                    'product_id'=>$id
                ]);
                return response()->json(['success', 'title'=> 'Successful add on your wishlist']);
            }else{
                return response()->json(['error', 'title'=> 'This product already existsed']);
            }
        }else{
            return response()->json(['error', 'title'=> 'Please login fast then add wishlist']);
        }
    }
}
