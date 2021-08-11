@extends('layouts.admin-master')
@section('brand', 'active')
@push('links')
    <link href="{{asset('backend')}}/lib/select2/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container {
            width: auto !important;
            display: block !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{asset('backend')}}/lib/select2/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Brand</h4>
                <form action="{{route('admin.sub-category.update', $sub_category->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="category_id" id="" class="d-none form-control select2-show-search select2-hidden-accessible">
                            <option value="">Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}" {{$item->id == $sub_category->categories_id ? "selected" : ""}}>{{ucwords($item->category_name_en)}}</option>
                            @endforeach
                        </select>
                        @error('category_id') 
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name English</label>
                        <input class="form-control" type="text" name="sub_category_nameen" value="{{$sub_category->category_name_en}}" placeholder="brand name en">
                        @error('sub_category_nameen')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name Bangla</label>
                        <input class="form-control" type="text" name="sub_caterogy_namebn" value="{{$sub_category->category_name_bn}}" placeholder="brand name en">
                        @error('sub_caterogy_namebn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Category</button>
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

    });

  </script> 
@endpush