@extends('layouts.admin-master')
@section('product', 'active')
@push('links')
    <link href="{{asset('backend')}}/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
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
                <form action="{{route('admin.product.store')}}" class="form-wrapper" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label d-block">Select Brand</label>
                            <select name="brand_id" class="mn-1d-none form-control select2-show-search select2-hidden-accessible">
                                <option value="">Select Brand</option>
                                @foreach ($brand as $item)
                                    <option value="{{$item->id}}">{{ucwords($item->brand_name_en)}}</option>
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
                                <option value="{{$category->id}}">{{$category->category_name_en}}</option>
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
                          </select>
                          @error('sub_subcategory_id')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Name English</label>
                            <input class="form-control" type="text" name="product_name_en" placeholder="Peoduct Name Englis">
                            @error('product_name_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Name Bangla</label>
                            <input class="form-control" type="text" name="product_name_bn" placeholder="Peoduct Name Bangla">
                            @error('product_name_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Code</label>
                            <input class="form-control" type="text" name="product_code" placeholder="Peoduct Code">
                            @error('product_code')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Quantity</label>
                            <input class="form-control" type="text" name="product_qty" placeholder="Peoduct Quantity">
                            @error('product_qty')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Tags En</label>
                            <input class="form-control has-tag" type="text" name="product_tags_en" placeholder="Peoduct Tags En">
                            @error('product_tags_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Tags Bn</label>
                            <input class="form-control has-tag" type="text" name="product_tags_bn" placeholder="Peoduct Tags Bn">
                            @error('product_tags_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Size En</label>
                            <input class="form-control has-tag" type="text" name="product_size_en" placeholder="Peoduct Size En">
                            @error('product_size_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Size Bn</label>
                            <input class="form-control has-tag" type="text" name="product_size_bn" placeholder="Peoduct Size Bn">
                            @error('product_size_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Color En</label>
                            <input class="form-control has-tag" type="text" name="product_color_en" placeholder="Peoduct Color En">
                            @error('product_color_en')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Color Bn</label>
                            <input class="form-control has-tag" type="text" name="product_color_bn" placeholder="Peoduct Color Bn">
                            @error('product_color_bn')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Selling Price</label>
                            <input class="form-control" type="text" name="selling_price" placeholder="Peoduct Selling Price">
                            @error('selling_price')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Discount</label>
                            <input class="form-control" type="text" name="discount_price" placeholder="Peoduct Discount">
                            @error('discount_price')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div> 
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct Main Thumbnail</label>
                            <input class="form-control" type="file" name="product_thumbnail" placeholder="Peoduct Main Thumbnail">
                            @error('product_thumbnail')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Peoduct multiple Thumbnail</label>
                            <input class="form-control multi-image" type="file" name="multi_img[]" multiple>
                            <div class="d-flex flex-wrap insert-image"></div>
                            @error('multi_img')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Short Description English</label>
                                <textarea class="summernote" name="short_descp_en">Hello, universe!</textarea>
                                @error('short_descp_en')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Short Description Bangla</label>
                                <textarea class="summernote" name="short_descp_bn">Hello, universe!</textarea>
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
                                <textarea class="summernote" name="long_descp_en">Hello, universe!</textarea>
                                @error('long_descp_en')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block">Peoduct Long Description Bangla</label>
                                <textarea class="summernote" name="long_descp_bn">Hello, universe!</textarea>
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
                              <input type="checkbox" name="hot_deals" checked="" value="1"><span>Hot Deals</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="special_deals" checked="" value="1"><span>Spesial Deals</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="special_offer" checked="" value="1"><span>Spesial Offer</span>
                            </label>
                          </div>
                          <div class="col-lg-2">
                            <label class="ckbox">
                              <input type="checkbox" name="featured" checked="" value="1"><span>Featured</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" style="cursor: pointer;">Add Peoduct</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('inline-scripts')
<script>
    $(function(){
      'use strict';

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

        if (window.File && window.FileList && window.FileReader) {
          $(".multi-image").on("change", function(e){
            var files = e.target.files,
              filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
              var f = files[i]
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                  "<br/><span class=\"remove\">Remove image</span>" +
                  "</span>").appendTo(".insert-image");
                $(".remove").click(function(){
                  $(this).parent(".pip").remove();
                });
              });
              fileReader.readAsDataURL(f);
            }
            console.log(files);
          });
        } else {
          alert("Your browser doesn't support to File API")
        }




    });

  </script> 
@endpush