<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDev;
use App\Models\ShipDistrict;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getDistrict($id)
    {
        $district = ShipDev::find($id)->districts;
        return $district;
    }
    public function getState($id)
    {
        $district = ShipDistrict::find($id)->States;
        return $district;
    }
    public function storeCheckout(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['post_code'] = $request->post_code;
        $data['select_division'] = $request->select_division;
        $data['select_district'] = $request->select_district;
        $data['select_state'] = $request->select_state;
        $data['notes'] = $request->notes;
        $data['payment_nathod'] = $request->payment_nathod;
        $total = Cart::total();
        if($data['payment_nathod'] == 'Stripe'){
            return view('frontend.payment.stripe' , compact('data', 'total'));
        }elseif($data['payment_nathod'] == 'Card'){
            return 'card';
        }else{
            return 'Hand Cash';
        }
    }
}
