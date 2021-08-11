@extends('layouts.admin-master')
@section('product', 'active') 
@push('links')
    <link href="{{asset('backend')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/lib/sweet/sweetalert2.min.css">
@endpush
@push('scripts')
    <script src="{{asset('backend')}}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{asset('backend')}}/lib/sweet/sweetalert2.all.min.js"></script>
@endpush
@section('content')
<div class="card pd-20 pd-sm-40">
    <h6 class="card-body-title">Categoru List</h6>
    <div class="table-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th class="wd-15p text-center">Image</th>
            <th class="wd-15p text-center">Product Name En</th>
            <th class="wd-20p text-center">Product Name Bn</th>
            <th class="wd-20p text-center">Product Quantity</th>
            <th class="wd-20p text-center">Product Descount</th>
            <th class="wd-20p text-center">Status</th>
            <th class="wd-15p text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
                <td style="vertical-align: middle;" class="text-center">
                    <img src="{{asset($product->product_thumbnail)}}" alt="" style="width:120px">
                </td>
                <td style="vertical-align: middle" class="text-center">
                    {{$product->product_name_en}} 
                </td>
                <td style="vertical-align: middle" class="text-center">
                     {{$product->product_name_bn}}
                </td>
                <td style="vertical-align: middle" class="text-center">
                     {{$product->product_qty}}
                </td>
                <td style="vertical-align: middle;" class="text-center">
                  @if ($product->discount_price == null)
                      <span class="badge badge-pill badge-dark">No</span>
                  @else
                      @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount / $product->selling_price) * 100;
                      @endphp
                      <span class="badge badge-pill badge-dark">{{round($discount)}}%</span> 
                  @endif
                </td>
                <td style="vertical-align: middle;" class="text-center">
                  @if ($product->status == 1)
                      <span class="badge badge-pill badge-success">Active</span>
                  @else 
                    <span class="badge badge-pill badge-success">Inactive</span>  
                  @endif
                </td>
                <td style="vertical-align: middle" class="text-center">
                    <div class="btn-group">
                      <a href="{{route('admin.product.edite', $product->id)}}" class="btn btn-pink"><i class="fa fa-eye"></i></a>
                      <a href="{{route('admin.product.edite', $product->id)}}" class="btn btn-pink"><i class="icon ion-edit"></i></a>
                      <a href="{{route('admin.product.delete', $product->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      @if ($product->status == 1)
                        <a href="{{route('admin.product.inactive', $product->id)}}" class="btn btn-danger"><i class="fas fa-arrow-down"></i></a>
                      @else 
                      <a href="{{route('admin.product.active', $product->id)}}" class="btn btn-success"><i class="fas fa-arrow-up"></i></a>
                      @endif
                    </div>
                </td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div><!-- table-wrapper -->
  </div><!-- card -->
  @endsection
  @push('inline-scripts')
<script>
    $(function(){
      'use strict';

      $('#datatable1').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });

    });
 
  </script> 
@endpush