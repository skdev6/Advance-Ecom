@extends('layouts.admin-master')
@section('coupon', 'active')
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
        <div class="col-lg-8">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Coupon List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Coupon</th>
                        <th class="wd-15p">Discount</th>
                        <th class="wd-20p">Validity</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-15p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($coupons as $coupon)
                        <tr>
                          <td>{{$coupon->coupon_name}}</td>
                          <td>{{$coupon->coupon_descount}}</td>
                          <td>{{Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F y')}}</td>
                          <td>
                            @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                <span class="badge badge-pill badge-success">Valide</span>
                            @else
                                <span class="badge badge-pill badge-danger">Invalide</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{route('admin.coupon.edite', $coupon->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{route('admin.coupon.delete',$coupon->id)}}" class="delete btn btn-danger">Delete</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div><!-- card -->
        </div>
        <div class="col-lg-4">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Coupon</h4>
                <form action="{{route('admin.coupon.store')}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Coupon Name</label>
                        <input class="form-control" type="text" name="coupon_name" placeholder="Coupon name">
                        @error('coupon_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Coupon Discound</label>
                        <input class="form-control" type="number" min="1" max="100" name="discound" placeholder="Coupon Discound">
                        @error('discound')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Coupon Validate Date</label>
                        <input class="form-control" type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="validatedate">
                        @error('validatedate')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New Coupon</button>
                    </div>
                </form>
            </div>
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