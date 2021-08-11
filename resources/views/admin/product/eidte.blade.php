@extends('layouts.admin-master')
@section('product', 'active')
@push('links')
    <link href="{{asset('backend')}}/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/SpinKit/spinkit.css" rel="stylesheet">
    <style>
        .select2-container {
            width: auto !important;
            display: block !important;
        }
        .insert-image img {
          width: 100%;
        }
        .insert-image span {
          max-width: 25%;
          padding: 10px 5px;
        }.insert-image span .remove {
          background: #f00;
          color: #fff;
          font-size: 13px;
          line-height: 15px;
          display: ;
          padding: 3px 13px;
          cursor: pointer;
        }
        .update-image {
  position: relative;
}
.update-image .btn-up {
	position: absolute;
	height: 100%;
	width: 100%;
	border: transparent;
	background: rgba(0,0,0,.5);
	color: #fff;opacity: 0;
}
.update-image:hover .btn-up{
  opacity: 1; 
  cursor: pointer;
}
.update-image .btn-up input[type="file"]{
  position: absolute;
  height: 100%;width: 100%;z-index: 2;opacity: 0; top: 0;left: 0;cursor: pointer;
}
.btn-delete{
  position: absolute;top: 0;right: 0;background-color: #fff;border-radius: 0;border-color: transparent;padding: 15px; z-index: 5;
}
.btn-delete:hover{
  background-color: #f00;color: #fff;cursor: pointer;
}
.update-image .sk-circle{
  position: absolute;
  left: 50%;top: 50%;
  transform: translate(-50%,-50%);
  margin: 0; 
}
.update-image .sk-child::before{
background-color: rgb(123, 255, 0);
}
    </style>
@endpush
@push('scripts')
    <script src="{{asset('backend')}}/lib/select2/js/select2.min.js"></script>
    <script src="{{asset('backend')}}/lib/summernote/summernote-bs4.min.js"></script>
    <script src="{{asset('backend')}}/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Peoduct</h4>
                <form action="{{route('admin.product.update', $product->id)}}" class="form-wrapper" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label d-block">Select Brand</label>
                            <select name="brand_id" class="mn-1d-none form-control select2-show-search select2-hidden-accessible">
                                <option value="">Select Brand</option>
                                @foreach ($brand as $item)
                                    <option value="{{$item->id}}" {{$product->brand_id == $item->id ? "selected" : ""}}>{{ucwords($item->brand_name_en)}}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label d-block">Sub Category</label>
                          <select name="category_id" class="d-none form-control select2-show-search select2-hidden-accessible">
                            @foreach ($categores as $category)
                                <option value="{{$category->id}}" {{$category->id == $product->category_id}}>{{$category->category_name_en}}</option>
                            @endforeach
                          </select>
                          @error('category_id')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label d-block">Sub Category</label>
                            <select name="subcategory_id" class="mn-1d-none form-control select2-show-search select2-hidden-accessible">
                                <option value="">Sub Category</option>
                                @foreach ($subCategory as $subCat)
                                    <option value="{{$subCat->id}}" {{$subCat->id == $product->subcategory_id ? "selected" : ""}}>
                                      {{$subCat->category_name_en}}
                                    </option>
                                @endforeach
                                <option value=""></option>
                            </select>
                            @error('subcategory_id')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label d-block">Sub Sub Category</label>
                          <select name="sub_subcategory_id" class="d-none form-control select2-show-search select2-hidden-accessible">
                            <option value="">Sub Sub Category</option>
                            @foreach ($subSubCategory as $subSubCat)
                                <option value="{{$subSubCat->id}}" {{$subSubCat->id == $product->sub_subcategory_id ? "selected" : ""}}>{{$subSubCat->subsubcategory_name_en}}</option>
                            @endforeach
                          </select>
                          @error('sub_subcategory_id')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Name English</label>
                            <input class="form-control" type="text" name="product_name_en" placeholder="Peoduct Name Englis" value="{{$product->product_name_en}}">
                            @error('product_name_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Name Bangla</label>
                            <input class="form-control" type="text" name="product_name_bn" placeholder="Peoduct Name Bangla" value="{{$product->product_name_bn}}">
                            @error('product_name_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Code</label>
                            <input class="form-control" type="text" name="product_code" placeholder="Peoduct Code" value="{{$product->product_code}}">
                            @error('product_code')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Quantity</label>
                            <input class="form-control" type="text" name="product_qty" placeholder="Peoduct Quantity" value="{{$product->product_qty}}">
                            @error('product_qty')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Tags En</label>
                            <input class="form-control has-tag" type="text" name="product_tags_en" placeholder="Peoduct Tags En" value="{{$product->product_tags_en}}">
                            @error('product_tags_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Tags Bn</label>
                            <input class="form-control has-tag" type="text" name="product_tags_bn" placeholder="Peoduct Tags Bn" value="{{$product->product_tags_bn}}">
                            @error('product_tags_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Size En</label>
                            <input class="form-control has-tag" type="text" name="product_size_en" placeholder="Peoduct Size En" value="{{$product->product_size_en}}">
                            @error('product_size_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Size Bn</label>
                            <input class="form-control has-tag" type="text" name="product_size_bn" placeholder="Peoduct Size Bn" value="{{$product->product_size_bn}}">
                            @error('product_size_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Color En</label>
                            <input class="form-control" type="text" name="product_color_en" placeholder="Peoduct Color En" value="{{$product->product_color_en}}">
                            @error('product_color_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Color Bn</label>
                            <input class="form-control" type="text" name="product_color_bn" placeholder="Peoduct Color Bn" value="{{$product->product_color_bn}}">
                            @error('product_color_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Selling Price</label>
                            <input class="form-control" type="text" name="selling_price" placeholder="Peoduct Selling Price" value="{{$product->selling_price}}">
                            @error('selling_price')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Discount</label>
                            <input class="form-control" type="text" name="discount_price" placeholder="Peoduct Discount" value="{{$product->discount_price}}">
                            @error('discount_price')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Short Description English</label>
                                <textarea class="summernote" name="short_descp_en">{{$product->short_descp_en}}</textarea>
                                @error('short_descp_en')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Short Description Bangla</label>
                                <textarea class="summernote" name="short_descp_bn">{{$product->short_descp_bn}}</textarea>
                                @error('short_descp_bn')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                        </div>  
                      </div>
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Long Description English</label>
                                <textarea class="summernote" name="long_descp_en">{{$product->long_descp_en}}</textarea>
                                @error('long_descp_en')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Long Description Bangla</label>
                                <textarea class="summernote" name="long_descp_bn">{{$product->long_descp_bn}}</textarea>
                                @error('long_descp_bn')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                        </div>  
                      </div>
                      <div class="col-lg-12 mb-4 mt-3">
                        <div class="row">
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="hot_deals" {{$product->hot_deals == 1 ? "checked" : ""}} value="{{$product->hot_deals}}"><span>Hot Deals</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="special_deals" {{$product->special_deals == 1 ? "checked" : ""}} value="{{$product->special_deals}}"><span>Spesial Deals</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="special_offer" {{$product->special_offer == 1 ? "checked" : ""}} value="{{$product->special_offer}}"><span>Spesial Offer</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="featured" {{$product->featured == 1 ? "checked" : ""}} value="{{$product->featured}}"><span>Featured</span> 
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" style="cursor: pointer;">Update Peoduct</button>
                    </div>
                </form>
                <div class="card p-2 bg-light mt-4">
                  <h6>Main Thumbnail</h6>
                  <div class="update-image mb-2" style="width: 300px">
                    <button class="btn-up">
                      <i class="fa fa-upload"></i>
                      <input type="file" class="prod-ajx-main-thumb" data-id="{{$product->id}}" data-old="{{$product->product_thumbnail}}">
                    </button>
                    <img src="{{asset($product->product_thumbnail)}}" alt="" class="w-100">
                  </div>
                  <h6 class="mt-3">Multiple Thumbnail</h6>
                  <div class="row multi-photo-row">
                    @foreach ($multiple_product_images as $multiple_product_image)
                    <div class="col-lg-2 prod-col">
                      <div class="multi-up update-image mb-2">
                        <button class="btn-up">
                          <i class="fa fa-upload"></i>
                          <input type="file" class="up-multi-thumb" data-id="{{$multiple_product_image->id}}">
                        </button>
                        <button class="btn-delete" data-id="{{$multiple_product_image->id}}"><i class="fas fa-trash"></i></button>
                        <img src="{{asset($multiple_product_image->product_name)}}" alt="" class="w-100">
                      </div>
                    </div>  
                    @endforeach
                    <div class="col-lg-2 d-flex align-items-center py-3">
                      <div>Add New Photo
                        <label class="custom-file">
                          <input type="file" id="file2" class="add-new-photo custom-file-input" data-id="{{$product->id}}">
                          <span class="custom-file-control custom-file-control-primary"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('inline-scripts')
<script>
    $(function(){


      $(".update-image .btn-delete").on('click', function () {
        var __this = $(this).parent('.update-image').parent('.prod-col');
        var $id = $(this).data('id');
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN':'{{csrf_token()}}'
          }
        });
        $.ajax({
          type: "post",
          url: "{{route('admin.product.delete-photo', $product->id)}}",
          data: {'img_id': $id},
          success: function (response) {
            if(response.success){
              __this.remove();
            }else{
              alert("please try again"); 
            }
          }
        });
      });

      $('.add-new-photo').on("change", function(){
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN':'{{csrf_token()}}'
          }
        });

        var $ID = $(this).data('id');
        var Photo = $(this).prop('files')[0];
        var form_data = new FormData();
        form_data.append('photo', Photo);

        $.ajax({
          type: "post",
          url: "{{route('admin.product.addnew.multi-photo', '')}}/"+$ID,
          data: form_data, 
          contentType: false,
          processData: false,
          success: function (response) {
            var BaseUrl = window.location.origin;
            $('.multi-photo-row').prepend(`
              <div class="col-lg-2">
                <div class="multi-up update-image mb-2">
                  <button class="btn-up">
                    <i class="fa fa-upload"></i>
                    <input type="file" class="up-multi-thumb" data-id="${response.image_id}">
                  </button>
                  <button class="btn-delete"><i class="fas fa-trash"></i></button>
                  <img src="${BaseUrl+"/"+response.img_link}" alt="" class="w-100">
                </div>
              </div> 
            `);
          }
        });
        });


      // AJAX IMAGE LOAD
      $(".prod-ajx-main-thumb").on("change", function(){
        var $id = $(this).data('id');
        
        var OldImage = $(this).data('old');
        var PhotoFile = $(this).prop('files')[0];
        var Formddata = new FormData();

        Formddata.append('photo', PhotoFile); 
        Formddata.append('old_image', OldImage);
        
        var Spenner = `<div class="img-load-spneer sk-circle"><div class="sk-circle1 sk-child"></div> <div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div> <div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div> <div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>`;
        $(this).parent().parent(".update-image").append(Spenner);
        var $spneer = $(this).parent().parent(".update-image").find('.img-load-spneer'); 
        var Image = $(this).parent().parent(".update-image").find('img');

        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN':'{{csrf_token()}}'
          }
        });
        $.ajax({
          type: "post",
          url: "{{route('admin.product.update.single-photo', '')}}/"+$id,
          data: Formddata,
          cache: false,
          contentType: false,
          processData: false,
          success: function (response) {
            if(response.success){
              Image.attr('src', window.location.origin+'/'+response.new_img); 
              $spneer.remove();
            }
          }
        });

      });

      // AJAX IMAGE LOAD
      $(".up-multi-thumb").on("change", function(){
        var $id = $(this).data('id');
        
        var OldImage = $(this).data('old');
        var PhotoFile = $(this).prop('files')[0];
        var Formddata = new FormData();

        Formddata.append('photo', PhotoFile); 
        Formddata.append('image_id', $id);
        
        var Spenner = `<div class="img-load-spneer sk-circle"><div class="sk-circle1 sk-child"></div> <div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div> <div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div> <div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>`;
        $(this).parent().parent(".update-image").append(Spenner);
        var $spneer = $(this).parent().parent(".update-image").find('.img-load-spneer'); 
        var Image = $(this).parent().parent(".update-image").find('img');

        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN':'{{csrf_token()}}'
          }
        });
        $.ajax({
          type: "post",
          url: "{{route('admin.product.update.multi-photo', $product->id)}}",
          data: Formddata,
          cache: false,
          contentType: false,
          processData: false,
          success: function (response) {
            if(response.success){
              Image.attr('src', window.location.origin+'/'+response.new_img); 
              $spneer.remove();
            }
          }
        });

      });

      // Select2 by showing the search
      $('.select2-show-search').select2({
          minimumResultsForSearch: ''
        });

      // Summernote editor 
      $('.summernote').summernote({
        height: 150,
        tooltip: false
      })

      $(".has-tag").tagsinput('items');

      $('select[name="category_id"]').on('change', function(){
          const $id = $(this).val();
          const SubSelect = $('select[name="subcategory_id"]');
            if($id){
              $.ajax({ 
                type: "get",
                url: "{{route('admin.get-sub-cat', '')}}/"+$id,
                dataType: "json",
                success: function (response){
                  if(response != ""){ 
                    SubSelect.empty();
                    $.each(response, function (indexInArray, valueOfElement) {
                      SubSelect.append("<option value="+valueOfElement.id+">"+valueOfElement.category_name_en);
                    });
                  }else{
                    SubSelect.empty();
                    SubSelect.append("<option>Data is not found");
                  }
                }
              });
            }
        });

        $('select[name="subcategory_id"]').on('change', function(){
          var $sub_id = $(this).val();
          var SubSubSelect = $('select[name="sub_subcategory_id"]');
          if($sub_id){
            $.ajax({ 
              type: "get",
              url: "{{route('admin.get-sub-sub-cat', '')}}/"+$sub_id,
              dataType: "json",
              success: function (response){
                if(response != ""){
                  SubSubSelect.empty();
                  $.each(response, function (indexInArray, valueOfElement) {
                    SubSubSelect.append("<option value="+valueOfElement.id+">"+valueOfElement.subsubcategory_name_en);
                  });
                }else{
                  SubSubSelect.empty();
                  SubSubSelect.append("<option>Data is not found");
                }
              }
            });
          }
        });

        $(".multi-up").on('change', function(){
          
        });




    });

  </script> 
@endpush