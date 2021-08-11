@extends('layouts.admin-master')
@section('order', 'active show-sub')
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
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white text-center">Shipping Information</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong style="margin-right:20px;">Name : </strong>{{$orders->name}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Email : </strong>{{$orders->email}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Phone : </strong>{{$orders->phone}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Division : </strong>{{$orders->division->division_name}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">District : </strong>{{$orders->district->district_name}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">State : </strong>{{$orders->state->state_name}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Post Code : </strong>{{$orders->post_code}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Order Date : </strong>{{$orders->order_date}}</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mb-0 text-white text-center">Order Information</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong style="margin-right:20px;">Name : </strong>{{$orders->user->name}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Phone : </strong>{{$orders->user->phone}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Payment By : </strong>{{$orders->payment_type}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">TNX ID : </strong>{{$orders->transaction_id}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">invoice id : </strong>{{$orders->invoice_no}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Order Total : </strong>{{$orders->amound}}</li>
                    <li class="list-group-item"><strong style="margin-right:20px;">Order Status : </strong><span class="badge badge-pill badge-primary">{{$orders->status}}</span></li>
                    @if ($orders->status == 'pending')
                      <li class="list-group-item"><a href="{{route('admin.pending-to-confirem', $orders->id)}}" class="next-step btn btn-success w-100">Confirm Order</a></li>  
                    @elseif($orders->status == 'confirmed')
                      <li class="list-group-item"><a href="{{route('admin.confiremed-to-processing', $orders->id)}}" class="next-step btn btn-success w-100">Processing Order</a></li> 
                    @elseif($orders->status == 'processing')
                      <li class="list-group-item"><a href="{{route('admin.processing-to-picked', $orders->id)}}" class="next-step btn btn-success w-100">Picked Order</a></li>
                    @elseif($orders->status == 'picked')
                      <li class="list-group-item"><a href="{{route('admin.picked-to-shiped', $orders->id)}}" class="next-step btn btn-success w-100">Shipped Order</a></li>
                    @elseif($orders->status == 'shipped')
                      <li class="list-group-item"><a href="{{route('admin.shiped-to-delivered', $orders->id)}}" class="next-step btn btn-success w-100">delivery Order</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Single Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_items as $order_item)
                        <tr>
                            <td style="vertical-align: middle;"><img src="{{asset($order_item->product->product_thumbnail)}}" style="width: 50px;" alt=""></td>
                            <td style="vertical-align: middle;">{{$order_item->product->product_name_en}}</td>
                            <td style="vertical-align: middle;">{{$order_item->product->product_code}}</td>
                            <td style="vertical-align: middle;">{{$order_item->color}}</td>
                            <td style="vertical-align: middle;">{{$order_item->size}}</td>
                            <td style="vertical-align: middle;">{{$order_item->product->qty}}</td>
                            <td style="vertical-align: middle;">{{$order_item->product->selling_price}}</td>
                            <td style="vertical-align: middle;">{{$order_item->price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

      $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
      });


    });
 
    ;(function($){
      $('.next-step').click(function(e){
          e.preventDefault();
          var located = $(this).attr('href'); 
          Swal.fire({
            title: 'Are you sure?',
            text: "You want to gp Next Step",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#23BF08',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = located;
            }else{
              Swal.fire({
                title: 'Your file has been safe',
              })
            }
          })
        });
    })(jQuery);
  </script> 
@endpush