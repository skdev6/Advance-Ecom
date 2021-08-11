@extends('layouts.admin-master')
@section('brand', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Brand</h4>
                <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Category Name English</label>
                        <input class="form-control" type="text" name="category_name_en" value="{{$category->category_name_en}}" placeholder="brand name en">
                        @error('category_name_en')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name Bangla</label>
                        <input class="form-control" type="text" name="category_name_bn" value="{{$category->category_name_bn}}" placeholder="brand name en">
                        @error('category_name_bn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Icon</label>
                        <input class="form-control" type="text" name="category_icon" value="{{$category->category_icon}}">
                        @error('category_icon') 
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
