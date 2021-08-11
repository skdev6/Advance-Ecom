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
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Invoice</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->order_date}}</td>
                                    <td>${{$order->amound}}</td>
                                    <td>{{$order->payment_type}}</td>
                                    <td>{{$order->invoice_no}}</td>
                                    <td>
                                        <span class="badge badge-pill badge-warning">{{$order->status}}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('user.single.order.view', $order->id)}}" class="btn btn-sm btn-primary">View</a>
                                        <a href="{{route('user.download.invoice', $order->id)}}" class="btn btn-sm btn-primary">Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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