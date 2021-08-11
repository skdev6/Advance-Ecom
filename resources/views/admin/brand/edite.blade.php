@extends('layouts.admin-master')
@section('brand', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Brand</h4>
                <form action="{{route('admin.brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Brand Name English</label>
                        <input class="form-control" type="text" name="brandnameen" value="{{$brand->brand_name_en}}" placeholder="brand name en">
                        @error('brandnameen')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Brand Name Bangla</label>
                        <input class="form-control" type="text" name="brandnamebn" value="{{$brand->brand_name_bn}}" placeholder="brand name en">
                        @error('brandnamebn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Brand Image</label>
                        <input class="form-control" type="file" name="brandimage">
                        <input type="hidden" name="old_image" value="{{$brand->brand_image}}">
                        @error('brandimage')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
