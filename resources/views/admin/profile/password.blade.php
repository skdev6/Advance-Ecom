@extends('layouts.admin-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            @include('admin.profile.profile-sidebar') 
        </div>
        <div class="col-lg-6">
            <h2>{{__("This is user update Profie")}}</h2>
            <form action="{{route('admin.UpdatePassword')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="password" name="old_pass" class="form-control" placeholder="Old Password">
                    @error('old_pass')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="new_pass" class="form-control" placeholder="New Password">
                    @error('new_pass')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="confrom_pass" class="form-control" placeholder="Confrom Password">
                    @error('confrom_pass')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Password</button>
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