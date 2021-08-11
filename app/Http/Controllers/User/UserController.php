<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use PDF;
class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
    public function updateData(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);

        $updateUser = User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ]);

        if($updateUser){
            $notification = array(
                "toster" => "Yes",
                "message" => "Your Profile Updated",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);
        }

        return redirect()->back();
    }
    public function userImage()
    {
        return view('user.change-image');
    }
    public function updateimage(Request $request)
    {

        $request->validate([
            'image'=>'required'
        ]);

        $old_image = $request->old_image;

        if(Auth::user()->avater == 'demo-avater.png'){
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('frontend/media/'.$name_gen);
            $save_url = 'frontend/media/'.$name_gen;
            User::findOrFail(Auth::id())->Update([
                'avater' => $save_url
            ]);
            $notification=array(
                "toster" => "Yes",
                "message" => "Your Profile Updated",
                "alert-type" => "success"
            );
            return Redirect()->back()->with($notification);
        }else{
            unlink($old_image);
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,250)->save('frontend/media/'.$name_gen);
            $save_url = 'frontend/media/'.$name_gen;
            User::findOrFail(Auth::id())->Update([
                'avater' => $save_url
            ]);
            $notification=array(
                "toster" => "Yes",
                "message" => "Your Profile Updated",
                "alert-type" => "success"
            );
            return Redirect()->back()->with($notification);
        }
    }

    // UPDATE PASSWORD
    public function updatePassword()
    {
        return view('user.changepass');
    }
    public function StorPassword(Request $request)
    {
        $db_pass = Auth::user()->password;
        $current_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $confrom_pass = $request->confrom_pass;
        
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confrom_pass' => 'required'
        ]);

        if(Hash::check($current_pass, $db_pass)){
            if($new_pass == $confrom_pass){
                User::find(Auth::id())->update([ 
                    'password' => Hash::make($new_pass) 
                ]);
                $notification=array(
                    "toster" => "Yes",
                    "message" => "Change Successful",
                    "alert-type" => "success"
                );
                Auth::logout(); 
                return Redirect()->route("login")->with($notification);
            }else{
                $notification=array(
                    "toster" => "Yes",
                    "message" => "New password and confrom password not matching",
                    "alert-type" => "error"
                );
                return Redirect()->back()->with($notification);
            }
        }else{
            $notification=array(
                "toster" => "Yes",
                "message" => "Old Password not matching",
                "alert-type" => "error"
            );
            return Redirect()->back()->with($notification);
        }
    }

    // ORDER VIEW
    public function OrderView()
    {
        $orders = order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('user.order.orders', compact('orders'));
    }
    public function singleOrderView($id)
    {
        $order = order::find($id);
        $order_items = orderItem::where('order_id', $id)->get();
        return view('user.order.single', compact('order', 'order_items'));
    }
    public function InvoiceDownload($id)
    {
        $order = order::where('id', $id)->where('user_id', Auth::id())->first();
        $order_items = orderItem::where('order_id', $id)->get();

        $pdf = PDF::loadView('user.order.invoice', compact('order', 'order_items'))->setOptions([
            'tempDir'=>public_path(),
            'chroot'=>public_path(),
        ]);
        return $pdf->download('invoice.pdf');
        
    }
}