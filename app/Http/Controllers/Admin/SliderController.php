<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders')); 

    }
    public function store(Request $request)
    {
        $title_en = $request->slidetitle_en;
        $title_bn = $request->slidetitle_bn;
        $description_en = $request->slidedescription_en;
        $description_bn = $request->slidedescription_bn;
        $image = $request->file('slideimage');
        
        $request->validate([
            'slidetitle_en' => 'required',
            'slidetitle_bn' => 'required',
            'slidedescription_en' => 'required',
            'slidedescription_bn' => 'required',
            'slideimage' => 'required'
        ]);

        $image_name = uniqid()."-".strtolower(str_replace(' ', '-', $image->getClientOriginalName())); 

        Image::make($image)->resize(1600,1000)->save('media/slide/'.$image_name);
        $url = 'media/slide/'.$image_name;

        $result = Slider::insert([
            'image'=>$url,
            'title_en'=>$title_en,
            'title_bn'=>$title_bn,
            'description_en'=>$description_en,
            'description_bn'=>$description_bn,
            'created_at'=>Carbon::now() 
        ]);
        if($result){
            $notification = array(
                'toster' => "Yes",
                "message" => "Slide Added Successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "Slide Added Error",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $slide = Slider::find($id);
        return view('admin.slider.edite', compact('slide'));
    }
    public function update(Request $request, $id)
    {
        $title_en = $request->slidetitle_en;
        $title_bn = $request->slidetitle_bn;
        $description_en = $request->slidedescription_en;
        $description_bn = $request->slidedescription_bn;
        $image = $request->file('slideimage');
        
        $request->validate([
            'slidetitle_en' => 'required',
            'slidetitle_bn' => 'required',
            'slidedescription_en' => 'required',
            'slidedescription_bn' => 'required',
        ]);

        if($image){
            $image_name = uniqid()."-".strtolower(str_replace(' ', '-', $image->getClientOriginalName())); 
            Image::make($image)->resize(1600,1000)->save('media/slide/'.$image_name);
            $url = 'media/slide/'.$image_name;
            $result = Slider::find($id)->update([
                'image'=>$url,
                'title_en'=>$title_en,
                'title_bn'=>$title_bn,
                'description_en'=>$description_en,
                'description_bn'=>$description_bn,
                'updated_at'=>Carbon::now() 
            ]);
        }else{
            $result = Slider::find($id)->update([
                'title_en'=>$title_en,
                'title_bn'=>$title_bn,
                'description_en'=>$description_en,
                'description_bn'=>$description_bn,
                'updated_at'=>Carbon::now() 
            ]);
        }

        if($result){
            $notification = array(
                'toster' => "Yes",
                "message" => "Slide Updated Successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "Slide Updated Error",
                "alert-type" => "error"
            );
        }
        return redirect()->route('admin.slider')->with($notification);
    }
    public function destroy($id)
    {
        $result = Slider::find($id)->delete();
        if($result){
                $notification = array(
                    'toster' => "Yes",
                    "message" => "Slide Delete Successful",
                    "alert-type" => "success"
                );
            }else{
                $notification = array(
                    'toster' => "Yes",
                    "message" => "Slide Delete Error",
                    "alert-type" => "error"
                );
            } 
        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        Slider::find($id)->update([
            'status'=>0
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Slide Inactive",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
    public function active($id)
    { 
        Slider::find($id)->update([
            'status'=>1
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Slide Active",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }




}
