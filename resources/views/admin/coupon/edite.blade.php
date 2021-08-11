@extends('layouts.admin-master')
@section('brand', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Update Coupen</h4>
                <form action="{{route('admin.coupon.update', $coupon->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Coupon Name</label>
                        <input class="form-control" type="text" name="coupon_name" value="{{$coupon->coupon_name}}" placeholder="Coupon name">
                        @error('coupon_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Coupon Discound</label>
                        <input class="form-control" type="number" min="1" max="100" name="discound" value="{{$coupon->coupon_descount}}" placeholder="Coupon Discound">
                        @error('discound')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Coupon Validate Date</label>
                        <input class="form-control" type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="validatedate" value="{{$coupon->coupon_validity}}">
                        @error('validatedate')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
