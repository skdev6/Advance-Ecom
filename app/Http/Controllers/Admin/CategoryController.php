<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $categores = Category::latest()->get();
        return view('admin.category.index', compact('categores'));
    }


    public function store(Request $request)
    {
       $category_icone = $request->category_icone; 
       $category_nameen = $request->category_nameen; 
       $caterogy_namebn = $request->caterogy_namebn;

       $request->validate([
        'category_icone' => 'required',
        'category_nameen' => 'required',
        'caterogy_namebn' => 'required'
       ],[
        'category_icone.required' => 'It required to be fill up'
       ]);

        $cat_insert = Category::insert([
            'category_name_en' => $category_nameen,
            'category_name_bn' => $caterogy_namebn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $category_nameen)),
            'category_slug_bn' => str_replace(' ', '-', $caterogy_namebn),
            'category_icon' => $category_icone,
            'created_at' => Carbon::now()
        ]);

        if($cat_insert){
            $notification = array(
                'toster' => "Yes",
                "message" => "Category created successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to create of category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification); 
    }

    
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edite', compact('category'));
    }


    public function update(Request $request, $id)
    {

        $category_icone = $request->category_icon; 
        $category_nameen = $request->category_name_en; 
        $caterogy_namebn = $request->category_name_bn;
 
        $request->validate([
         'category_icon' => 'required',
         'category_name_en' => 'required',
         'category_name_bn' => 'required'
        ],[
         'category_icone.required' => 'It required to be fill up'
        ]);
 
        $cat_update = Category::find($id)->update([
            'category_name_en' => $category_nameen,
            'category_name_bn' => $caterogy_namebn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $category_nameen)),
            'category_slug_bn' => str_replace(' ', '-', $caterogy_namebn),
            'category_icon' => $category_icone,
            'updated_at' => Carbon::now()
        ]); 
 
        if($cat_update){
            $notification = array(
                'toster' => "Yes",
                "message" => "Category updated successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to updated of category",
                "alert-type" => "error"
            );
        }
         return redirect()->route('admin.category')->with($notification); 
    }

    public function destroy($id)
    {
        $delete = Category::find($id)->delete();
        if($delete){ 
            $notification = array(
                'toster' => "Yes",
                "message" => "Category delete successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to delete of category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification);
    }

    // SUB CATEGORY SCRIPTS
    public function subcat_index()
    {
        $sub_category = SubCategory::latest()->get();
        $category = Category::orderBy('category_name_en', "ASC")->get();
        return view('admin.sub-category.index', compact('sub_category', 'category'));
    }

    public function subcat_store(Request $request)
    {
        $cat_id = $request->category_id;
        $sub_cat_name_en = $request->sub_category_nameen;
        $sub_cat_name_bn = $request->sub_caterogy_namebn;
        
        $request->validate([
            'category_id' => 'required',
            'sub_category_nameen' => 'required',
            'sub_caterogy_namebn' => 'required',
        ]);

        $insert = SubCategory::insert([
            'categories_id' => $cat_id,
            'category_name_en' => $sub_cat_name_en,
            'category_name_bn' => $sub_cat_name_bn,
            'category_slug_en' => strtolower(str_replace(' ', '-',  $sub_cat_name_en)),
            'category_slug_bn' => str_replace(' ', '-',  $sub_cat_name_bn),
            'created_at' => Carbon::now()
        ]);
        if($insert){
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Category Insert successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to Insert of Sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification); 
    }   

    public function subcat_edit($id)
    {
        $sub_category = SubCategory::find($id);
        $category = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.sub-category.edite', compact('sub_category', 'category'));
    }

    public function subcat_update(Request $request, $id)
    {
        $cat_id = $request->category_id;
        $sub_cat_name_en = $request->sub_category_nameen;
        $sub_cat_name_bn = $request->sub_caterogy_namebn;
        
        $request->validate([
            'category_id' => 'required',
            'sub_category_nameen' => 'required',
            'sub_caterogy_namebn' => 'required',
        ]);

        $updated = SubCategory::find($id)->update([ 
            'categories_id' => $cat_id,
            'category_name_en' => $sub_cat_name_en,
            'category_name_bn' => $sub_cat_name_bn,
            'category_slug_en' => strtolower(str_replace(' ', '-',  $sub_cat_name_en)),
            'category_slug_bn' => str_replace(' ', '-',  $sub_cat_name_bn),
            'updated_at' => Carbon::now()
        ]);

        if($updated){
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Category Update successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to Update of Sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->route('admin.sub-category')->with($notification);
    }

    public function subcat_delete($id)
    {
        $delete = SubCategory::find($id)->delete();
        if($delete){ 
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Category delete successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to delete of Sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification);
    }

    // SUB SUB CATEGORY
    public function sub_sub_index()
    {
        $subsub_category = SubSubCategory::latest()->get();
        $category = Category::latest()->get();
        return view('admin.sub-sub-category.index', compact('subsub_category', 'category'));
    }

    public function getSubCategory($id)
    {
        $sub_cat = SubCategory::where('categories_id', '=', $id)->orderBy('category_name_en', 'ASC')->get();
        if($sub_cat){
            return $sub_cat;
        }else{
            return "Category is empty";
        }
    }

    public function sub_substore(Request $request)
    {
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $sub_subcategory_nameen = $request->sub_subcategory_nameen;
        $sub_subcaterogy_namebn = $request->sub_subcaterogy_namebn;

        $request->validate([
            'category_id' => 'required|int',
            'subcategory_id' => 'required|int',
            'sub_subcategory_nameen' => 'required',
            'sub_subcaterogy_namebn' => 'required'
        ]);

        $subsubinsert = SubSubCategory::insert([
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'subsubcategory_name_en' => $sub_subcategory_nameen,
            'subsubcategory_name_bn' => $sub_subcaterogy_namebn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $sub_subcategory_nameen)),
            'subsubcategory_slug_bn' => str_replace(' ', '-', $sub_subcaterogy_namebn), 
            'created_at' => Carbon::now(),
        ]);

        if($subsubinsert){
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Sub Category Insert successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to insert of Sub sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification);
    }

    public function subsubcat_edit($id)
    {
        $subsub_cat = SubSubCategory::find($id);
        $category = Category::orderBy('category_name_en', 'ASC')->get();

        $subsubcategory_id = SubSubCategory::find($id)->category_id; 
        $subcategory = SubCategory::where('categories_id', '=', $subsubcategory_id)->orderBy('category_name_en', 'ASC')->get();
        return view('admin.sub-sub-category.edite', compact('subsub_cat', 'category', 'subcategory'));
    }

    public function subsubcat_update(Request $request, $id)
    {
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $sub_subcategory_nameen = $request->sub_subcategory_nameen;
        $sub_subcaterogy_namebn = $request->sub_subcaterogy_namebn;

        $request->validate([
            'category_id' => 'required|int',
            'subcategory_id' => 'required|int',
            'sub_subcategory_nameen' => 'required',
            'sub_subcaterogy_namebn' => 'required'
        ]);

        $subsubinsert = SubSubCategory::find($id)->update([
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'subsubcategory_name_en' => $sub_subcategory_nameen,
            'subsubcategory_name_bn' => $sub_subcaterogy_namebn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $sub_subcategory_nameen)),
            'subsubcategory_slug_bn' => str_replace(' ', '-', $sub_subcaterogy_namebn), 
            'updated_at' => Carbon::now(),
        ]);

        if($subsubinsert){
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Sub Category updated successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to updated of Sub sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->route('admin.sub-sub-category')->with($notification); 
    }

    public function subsubcat_delete($id)
    {
        $delete = SubSubCategory::find($id)->delete();
        if($delete){
            $notification = array(
                'toster' => "Yes",
                "message" => "Sub Sub Category delete successful",
                "alert-type" => "success"
            );
        }else{
            $notification = array(
                'toster' => "Yes",
                "message" => "failed to delete of Sub sub category",
                "alert-type" => "error"
            );
        }
        return redirect()->back()->with($notification);
    }

}