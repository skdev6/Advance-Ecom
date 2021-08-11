<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
    public function profile()
    {
        return view('admin.profile.index');
    }
    public function image()
    {
        return view('admin.profile.image');
    }
    public function password()
    {
        return view('admin.profile.password');
    }
    public function UpdateProfile(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required|min:11|max:11'
        ]);

        $update = User::find(Auth::id())->update([
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'update_at'=>Carbon::now() 
        ]);

        if($update){
            $notification = array(
                "toster" => "Yes",
                "message" => "Your Profile Updated",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "Updated field",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification); 
    }
    // UPDATE IMAGE
    public function updateimage(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $old_image = $request->old_image;
        if(Auth::user()->avater == 'demo-avater.png'){ 
            $image = $request->file('image');
            $name_gen = "avater-".hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,250)->save('media/'.$name_gen);
            $save_url = "media/".$name_gen; 
            User::find(Auth::id())->update([
                'avater' => $save_url
            ]);
            $notification = array(
                'toster' => "Yes",
                "message" => "Image Updated",
                "alert-type" => "success"
            );
        }else{
            unlink($old_image);
            $image = $request->file('image');
            $name_gen = "avater-".hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,250)->save('media/'.$name_gen);
            $save_url = "media/".$name_gen;
            User::find(Auth::id())->update([
                'avater' => $save_url
            ]);
            $notification = array(
                'toster' => "Yes",
                "message" => "Image Updated",
                "alert-type" => "success"
            );
        }
        return redirect()->back()->with($notification);
    }
    // UPDATE PASSWORD
    public function UpdatePassword(Request $request)
    {
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $confrom_pass = $request->confrom_pass;
        $request->validate([
            'old_pass'=>'required',
            'new_pass'=>'required',
            'confrom_pass'=>'required', 
        ]);
        if(Hash::check($old_pass, Auth::user()->password)){
            if($new_pass == $confrom_pass){
                User::find(Auth::id())->update([
                    'password' => Hash::make($confrom_pass)
                ]);

                $notification = array(
                    'toster' => "Yes",
                    "message" => "Passord Changed successful please login with new password",
                    "alert-type" => "success"
                );
                Auth::logout(); 
                return Redirect()->route("login")->with($notification);
            }else{
                $notification = array(
                    'toster' => "Yes",
                    "message" => "Passord Not match",
                    "alert-type" => "error"
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "Old password not match",
                "alert-type" => "error"
            );
            return redirect()->back()->with($notification);
        }
    }
}