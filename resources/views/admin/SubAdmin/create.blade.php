@extends('layouts.admin-master')
@section('role', 'show-sub')
@section('add-role', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Role</h4>
                <form action="{{route('admin.subadmin.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">User Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Role name">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Email">
                        @error('email')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password">
                        @error('password')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Confrom Password</label>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confrom Password">
                        @error('password_confirmation')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">User Role</label>
                        <select name="role_id" id="" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
