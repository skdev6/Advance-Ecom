<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class BrandController extends Controller{

    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $name_en = $request->brandnameen;
        $name_bn = $request->brandnamebn;
        $brand_image = $request->brandimage;
        $request->validate([
            'brandnameen'=>'required',
            'brandnamebn'=>'required',
            'brandimage'=>'required'
        ]);

        $image = $request->file('brandimage');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(166,110)->save('media/brands/'.$name_gen);
        $save_url = 'media/brands/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $name_en,
            'brand_name_bn' => $name_bn,
            'brand_slug_en' => strtolower(str_replace(' ','-', $name_en)),
            'brand_slug_bn' => str_replace(' ','-', $name_bn),
            'brand_image'  => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'toster' => "Yes",
            "message" => "Brand added",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function edite($brand_id)
    {
        $brand = Brand::find($brand_id);
        return view('admin.brand.edite', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $name_en = $request->brandnameen;
        $name_bn = $request->brandnamebn;
        $brand_image = $request->brandimage;
        $old_image = $request->old_image;
        $request->validate([
            'brandnameen'=>'required',
            'brandnamebn'=>'required',
        ]);

        if($request->file('brandimage')){
            unlink($old_image);
            $image = $request->file('brandimage');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(166,100)->save('media/brands/'.$name_gen);
            $save_url = 'media/brands/'.$name_gen;
            $updated = Brand::find($id)->update([
                'brand_name_en' => $name_en,
                'brand_name_bn' => $name_bn,
                'brand_slug_en' => strtolower(str_replace(' ','-', $name_en)),
                'brand_slug_bn' => str_replace(' ','-', $name_bn),
                'brand_image'  => $save_url,
                'updated_at' => Carbon::now()
            ]);
            
        }else{
            $updated = Brand::find($id)->update([
                'brand_name_en' => $name_en,
                'brand_name_bn' => $name_bn,
                'brand_slug_en' => strtolower(str_replace(' ','-', $name_en)),
                'brand_slug_bn' => str_replace(' ','-', $name_bn),
                'updated_at' => Carbon::now()
            ]);
        }

        if($updated){
            $notification = array(
                'toster' => "Yes",
                "message" => "Brand Updated",
                "alert-type" => "success"
            ); 
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "Brand Not Updated please try again",
                "alert-type" => "error"
            ); 
        }

        return redirect()->route('admin.brand')->with($notification);

    }

    public function delete($id)
    {
        Brand::find($id)->delete();
        $notification = array(
            'toster' => "Yes",
            "message" => "Delete is success",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
}