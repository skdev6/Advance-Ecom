@extends('layouts.admin-master')
@section('role', 'show-sub')
@section('add-role', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Edit Role</h4>
                <form action="{{route('admin.role.update', $role->id)}}" method="POST">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-control-label">Role Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Role name" value="{{$role->name}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
