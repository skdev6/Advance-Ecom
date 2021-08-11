<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
   public function index()
   {
       $coupons = Coupon::latest()->get();
       return view('admin.coupon.index', compact('coupons'));
   }
   public function store(Request $request)
   {
       $request->validate([
        'coupon_name' => 'required',
        'discound' => 'required',
        'validatedate' => 'required'
       ]);
       Coupon::insert([
        'coupon_name'=>$request->coupon_name,
        'coupon_descount'=>$request->discound,
        'coupon_validity'=>$request->validatedate,
        'created_at'=>Carbon::now()
       ]);
       $notification = array(
            'toster' => "Yes",
            "message" => "Coupon Created successful",
            "alert-type" => "success"
        );
        return redirect()->route('admin.coupon')->with($notification);
   }
   public function edite($id)
   {
       $coupon = Coupon::find($id);
       return view('admin.coupon.edite', compact('coupon'));
   }
   public function update(Request $request, $id)
   {
    $request->validate([
        'coupon_name' => 'required',
        'discound' => 'required',
        'validatedate' => 'required'
       ]);
       Coupon::find($id)->update([
        'coupon_name'=>$request->coupon_name,
        'coupon_descount'=>$request->discound,
        'coupon_validity'=>$request->validatedate,
        'created_at'=>Carbon::now()
       ]);
       $notification = array(
            'toster' => "Yes",
            "message" => "Coupon updated successful",
            "alert-type" => "success"
        );
       return redirect()->route('admin.coupon')->with($notification);
   }
   public function delete($id)
   {
       Coupon::find($id)->delete();
       $notification = array(
            'toster' => "Yes",
            "message" => "Coupon Delete successful",
            "alert-type" => "success"
        );
        return redirect()->route('admin.coupon')->with($notification);
   }
}
