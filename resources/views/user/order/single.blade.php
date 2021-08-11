@extends('layouts.frontend-master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset(Auth::user()->avater)}}" alt="" class="rounded w-100">
                        @include('user.nav')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <h3 style="margin:0; margin-bottom:10px;margin-left:10px; padding-top:20px;">Shipping Detials</h3>
                            <ul class="list" style="padding:20px;">
                                <li style="display: block; padding:15px 10px;">|-> Name: <strong style="margin-left: 20px; displayLinline-block;">{{$order->name}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> Email: <strong style="margin-left: 20px; displayLinline-block;">{{$order->email}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> Division: <strong style="margin-left: 20px; displayLinline-block;">{{$order->division->division_name}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> District: <strong style="margin-left: 20px; displayLinline-block;">{{$order->district->district_name}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> State: <strong style="margin-left: 20px; displayLinline-block;">{{$order->state->state_name}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> Post Code: <strong style="margin-left: 20px; displayLinline-block;">{{$order->post_code}}</strong></li>
                                <li style="display: block; padding:15px 10px;">|-> Order Date: <strong style="margin-left: 20px; displayLinline-block;">{{$order->order_date}}</strong></li>
                                <li style="display: block; padding:15px 10px;">
                                    |-> <span class="badge badge-pill badge-warning"> {{$order->status}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <h3 style="margin:0; margin-bottom:10px;margin-left:10px; padding-top:20px;">Invoice Detials</h3>
                            <ul class="list" style="padding:20px;">
                                <li style="padding:15px 10px;">|-> Name: <strong style="margin-left: 20px; displayLinline-block;">{{$order->user->name}}</strong></li>
                                <li style="padding:15px 10px;">|-> Phone: <strong style="margin-left: 20px; displayLinline-block;">{{$order->user->phone}}</strong></li>
                                <li style="padding:15px 10px;">|-> Payment Type: <strong style="margin-left: 20px; displayLinline-block;">{{$order->payment_type}}</strong></li>
                                <li style="padding:15px 10px;">|-> tranx ID: <strong style="margin-left: 20px; displayLinline-block;">{{$order->transaction_id}}</strong></li>
                                <li style="padding:15px 10px;">|-> Invoice: <strong style="margin-left: 20px; displayLinline-block;">{{$order->invoice_no}}</strong></li>
                                <li style="padding:15px 10px;">|-> Total: <strong style="margin-left: 20px; displayLinline-block;">{{session()->get('language') == 'bangla' ? '৳'.$order->amound : '$'.$order->amound}}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $order_item)
                            <tr>
                                <td><img src="{{asset($order_item->product->product_thumbnail)}}" alt="" style="width:80px;"></td>
                                <td>{{session()->get('language') == 'english' ? $order_item->product->product_name_en : $order_item->product->product_name_bn}}</td>
                                <td>{{$order_item->product->product_code}}</td>
                                <td>{{$order_item->color}}</td>
                                <td>{{$order_item->size}}</td>
                                <td>{{$order_item->qty}}</td>
                                <td>{{$order_item->price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                @if ($order->status != 'delivered')
                    <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Return resone"></textarea>
                @endif
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