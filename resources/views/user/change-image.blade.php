@extends('layouts.frontend-master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset(Auth::user()->avater)}}" alt="" class="rounded w-100">
                        @include('user.nav')
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>{{__("This is user update Profie")}}</h2>
                <form action="{{route('user.updateimage')}}" method="POST" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="old_image" value="{{Auth::user()->avater}}"> 
                        <input type="file" name="image" class="form-control unicase-form-control text-input" placeholder="Name"> 
                        @error('image')
                            <span style="color: red">{{$message}}</span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .list-group{
            border: 1px solid #f6f6f6;
        }
        .list-group li a{
            display: block;
            padding: 10px 15px;
            border-bottom: 1px solid #f6f6f6; 
        }
        .list-group li:last-child a{
            border-bottom:none;  
        }  
        .list-group li a:hover{
            background-color: #408804;
            color: #fff;
        } 
        .mt-4{
            margin-top: 2rem; 
        }
    </style>
@endsection