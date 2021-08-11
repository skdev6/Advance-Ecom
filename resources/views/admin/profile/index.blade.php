@extends('layouts.admin-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            @include('admin.profile.profile-sidebar') 
        </div>
        <div class="col-lg-6">
            <h2>{{__("This is user update Profie")}}</h2>
            <form action="{{route('admin.UpdateProfile')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{Auth::user()->name}}">
                    @error('name')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                    @error('email')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" name="phone" class="form-control" placeholder="Phone" value="{{Auth::user()->phone}}">
                    @error('phone')
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
        .btn{
            cursor: pointer;
        }
        .list-group{
            border: 1px solid #f6f6f6;
            padding: 0;margin: 0;list-style: none; 
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