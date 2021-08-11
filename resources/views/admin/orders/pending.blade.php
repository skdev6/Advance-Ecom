@extends('layouts.admin-master')
@section('order', 'active show-sub') 
@section('pending-order', 'active')
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
        <div class="col-lg-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Pending Order</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Date</th>
                        <th class="wd-15p">Invoice</th>
                        <th class="wd-15p">Amount</th>
                        <th class="wd-15p">TNX ID</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-15p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $order)
                        <tr>
                            <td style="vertical-align: middle">
                                {{$order->order_date}}
                            </td>
                            <td style="vertical-align: middle">
                                #{{$order->invoice_no}}
                            </td>
                            <td style="vertical-align: middle">
                                {{$order->amound}}
                            </td>
                            <td style="vertical-align: middle">
                                {{$order->transaction_id}}
                            </td>
                            <td style="vertical-align: middle">
                                <span class="badge badge-pill badge-primary">{{$order->status}}</span>
                            </td>
                            <td style="vertical-align: middle">
                                <a href="{{route('admin.pending.order.view', $order->id)}}" class="btn btn-pink">{{_("View")}}</a>
                                <a href="{{route('admin.category.delete', $order->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr> 
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div><!-- card -->
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
      $('.delete').click(function(e){
          e.preventDefault();
          var located = $(this).attr('href'); 
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
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