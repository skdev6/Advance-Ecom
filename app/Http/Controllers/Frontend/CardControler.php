<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDev;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CardControler extends Controller
{
    public function index()
    {
        $cards = Cart::content();
        return view('frontend.cart', compact('cards'));
    }
    public function addToCard(Request $req, $id)
    {

        $product = Product::find($id);
        $AddCart = Cart::add([
            'id'=>$id,
            'name'=>$product->product_name_en,
            'qty'=>$req->qty,
            'price'=>$product->discount_price != null ? $product->discount_price : $product->selling_price,
            'weight'=> 1,
            'options'=> [
                'color'=>$req->color,
                'size'=>$req->size,
                'image'=> $product->product_thumbnail
            ]
        ]);
        return response()->json(['success'=>true, 'title'=>'Product added successfuly']);
    }

    public function getCart()
    {
        return Cart::content();
    }

    public function miniCard()
    {
        $cards = Cart::content();
        $count = Cart::count();
        $total = Cart::total();

        return response()->json([
            'carts'=>$cards,
            'count'=>$count,
            'total'=>$total
        ]);
    }
    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with(['success', 'title'=>'Cart Remove Successfuly']);
    }

    // APPLY COUPON
    public function couponAplly(Request $request)
    {
       $coupon = Coupon::where('coupon_name', '=', $request->coupon_name)->first();
       if($coupon){
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_descount' => $coupon->coupon_descount,
                'coupon_amount' => round(str_replace(',', '', Cart::total()) * $coupon->coupon_descount/100),
                'coupon_total' => round(str_replace(',', '', Cart::total()) - str_replace(',', '', Cart::total()) * $coupon->coupon_descount/100),
            ]);
            return response()->json(['success'=> 'Coupon Code is valide']);
       }else{
           return response()->json(['error'=> 'Coupon Code is invalide']);
       }
    }
    public function CouponCal()
    {
        if(Session::has('coupon')){
            return response()->json([
                'subtotal'=>Cart::total(),
                'coupon_name'=>session()->get('coupon')['coupon_name'],
                'coupon_descount'=>session()->get('coupon')['coupon_descount'],
                'discound_amount'=>session()->get('coupon')['coupon_amount'],
                'coupon_total'=>session()->get('coupon')['coupon_total']
            ]);
        }else{
            return response()->json([
                'total'=>Cart::total()
            ]);
        }
    }
    public function RemoveCoupon()
    {
        session()->forget('coupon');
        return response()->json([
            'remove'=>'coupon remove success'
        ]);
    }

    // CHECK OUT CREATE
    public function CkeckoutCreate()
    {
        if(Auth::check()){
            if(Cart::total() > 0){
                $cards = Cart::content();
                $count = Cart::count();
                $total = Cart::total();
                $divisions = ShipDev::get();
                return view('frontend.checkout', compact('cards', 'count', 'total', 'divisions'));
            }else{
                $notification = array(
                    "toster" => "Yes",
                    "message" => "Your cart is empty",
                    "alert-type" => "success"
                );
                return redirect()->to('/')->with($notification);  
            }
        }else{
            $notification = array(
                "toster" => "Yes",
                "message" => "Please login first",
                "alert-type" => "success"
            );
            return redirect()->route('login')->with($notification);
        }
    }
}