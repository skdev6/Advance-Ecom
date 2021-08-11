<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\multiplImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    // CREATE PRODUCT
    public function create()
    {
        $brand = Brand::latest()->get();
        $categores = Category::latest()->get();
        return view('admin.product.add', compact('brand', 'categores'));

    }

    // GET SUB SUB CAT
    public function get_subsubCate($id)
    {
        $subsub_cat = SubSubCategory::where('subcategory_id', '=', $id)->orderBy("subsubcategory_name_en")->get();
        return json_encode($subsub_cat);
        
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'brand_id'=>'required',
            'category_id'=>'required',
            'product_name_en'=>'required',
            'product_name_bn'=>'required',
            'product_code'=>'required',
            'product_qty'=>'required',
            'product_tags_en'=>'required',
            'product_tags_bn'=>'required',
            'product_size_en'=>'required',
            'product_size_bn'=>'required',
            'product_color_en'=>'required',
            'product_color_bn'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'product_thumbnail'=>'required',
            'multi_img'=>'required',
            'short_descp_en'=>'required',
            'short_descp_bn'=>'required',
            'long_descp_en'=>'required',
            'long_descp_bn'=>'required',
        ]);

        $hot_deals = $request->hot_deals == 1 ? 1 : 0;
        $special_deals = $request->special_deals == 1 ? 1 : 0;
        $special_offer = $request->special_offer == 1 ? 1 : 0;
        $featured = $request->featured == 1 ? 1 : 0;

        $image = $request->file('product_thumbnail');
        $name_gen = uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('media/product/'.$name_gen);
        $proimage_url = 'media/product/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ','-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ','-', $request->product_name_bn),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'product_thumbnail' => $proimage_url,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,
            'hot_deals' => $hot_deals,
            'special_deals' => $special_deals,
            'special_offer' => $special_offer,
            'featured' => $featured,
            'status' => "1",
            'created_at' => Carbon::now()
        ]);

        $multi_image = $request->file('multi_img');

        foreach ($multi_image as $key => $multi_single) {
            $name_gen = uniqid().".".$multi_single->getClientOriginalExtension();
            Image::make($multi_single)->save('media/product/'.$name_gen);
            $multi_url = 'media/product/'.$name_gen;
            multiplImage::insert([
                'product_id'=>$product_id,
                'product_name'=>$multi_url,
                'created_at'=>Carbon::now(),
            ]);
        }

        $notification = array(
            'toster' => "Yes",
            "message" => "Product created successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
 
    }

    public function edite($id)
    {
        $brand = Brand::latest()->get();
        $categores = Category::latest()->get();
        $subCategory = SubCategory::latest()->get();
        $subSubCategory = SubSubCategory::latest()->get();
        $product = Product::find($id);
        $multiple_product_images = multiplImage::where('product_id', '=', $id)->get();
        return view('admin.product.eidte', compact('brand', 'categores', 'product', 'subCategory', 'subSubCategory', 'multiple_product_images'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_id'=>'required',
            'category_id'=>'required',
            'product_name_en'=>'required',
            'product_name_bn'=>'required',
            'product_code'=>'required',
            'product_qty'=>'required',
            'product_tags_en'=>'required',
            'product_tags_bn'=>'required',
            'product_size_en'=>'required',
            'product_size_bn'=>'required',
            'product_color_en'=>'required',
            'product_color_bn'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'short_descp_en'=>'required',
            'short_descp_bn'=>'required',
            'long_descp_en'=>'required',
            'long_descp_bn'=>'required',
        ]);
        $hot_deals = $request->hot_deals == 1 ? 1 : 0;
        $special_deals = $request->special_deals == 1 ? 1 : 0;
        $special_offer = $request->special_offer == 1 ? 1 : 0;
        $featured = $request->featured == 1 ? 1 : 0;
        Product::find($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ','-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ','-', $request->product_name_bn),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,
            'hot_deals' => $hot_deals,
            'special_deals' => $special_deals,
            'special_offer' => $special_offer,
            'featured' => $featured,
            'status' => "1",
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'toster' => "Yes",
            "message" => "Product Updated successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);

    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        $notification = array(
            'toster' => "Yes",
            "message" => "Product Delete successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function update_singlephoto(Request $request, $id)
    { 
        
        $photo = $request->file('photo');  

        $name_gen = uniqid().".".$photo->getClientOriginalExtension();
        $result = Image::make($photo)->save('media/product/'.$name_gen);
        $save_url = 'media/product/'.$name_gen;
        $result = Product::find($id)->update([
            'product_thumbnail'=>$save_url,
        ]);

        if($result){ 
            return response()->json(['success'=>true, 'new_img'=>$save_url]);
        }else{
            return response()->json(['success'=>false]);
        }
         
    }

    public function update_multiphoto(Request $request, $id)
    {
        $image_id = $request->image_id;
        $image = $request->file('photo');
        
        $name_gen = uniqid().".".$image->getClientOriginalExtension();
        $result = Image::make($image)->save('media/product/'.$name_gen);
        $save_url = 'media/product/'.$name_gen;
        
        multiplImage::find($image_id)->update([
            'product_name' => $save_url
        ]);

        if($result){ 
            return response()->json(['success'=>true, 'new_img'=>$save_url]);  
        }else{
            return response()->json(['success'=>false]);
        }
    }

    public function add_new_multiphoto(Request $request, $id)
    {
        $photo = $request->file('photo');
        $gen_name = hexdec(uniqid()).".".$photo->getClientOriginalExtension();
        Image::make($photo)->save('media/product/'.$gen_name);
        $save_url = 'media/product/'.$gen_name;
        $result = multiplImage::insertGetId([
            'product_id'=>$id,
            'product_name'=>$save_url,
            'created_at' => Carbon::now() 
        ]);

        if($result){
            return response()->json(['success'=>true, 'img_link'=>$save_url, 'image_id'=> $result]);
        }else{
            return response()->json(['success'=>false]); 
        }
    }

    public function delete_multiphoto(Request $request, $id)
    {
        $img_id = $request->img_id;
        $result = multiplImage::find($img_id)->delete();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]); 
        }
    }

    // PRODUCT ACTIVE INACTIVE
    public function product_active($id)
    {
        Product::find($id)->update([
            'status' => 1
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Product Active successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
    public function product_inactive($id)
    {
        Product::find($id)->update([
            'status' => 0
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Product Inactive successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }



}
