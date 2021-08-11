@extends('layouts.admin-master')
@section('brand', 'active')
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
                <h6 class="card-body-title">Brand List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Brand</th>
                        <th class="wd-15p">Last name</th>
                        <th class="wd-20p">Position</th>
                        <th class="wd-15p">Start date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($brands as $brand)
                        <tr>
                          <td><img src="{{asset($brand->brand_image)}}" alt=""></td>
                          <td>{{$brand->brand_name_en}}</td>
                          <td>{{$brand->brand_name_bn}}</td>
                          <td>
                            <a href="{{route('admin.brand.edite', $brand->id)}}" class="btn btn-success">Edit</a><a href="{{route('admin.brand.delete',$brand->id)}}" class="delete btn btn-danger">Delete</a>
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
                <h4 class="card-body-title">Add New Brand</h4>
                <form action="{{route('admin.brand.store')}}" class="form-wrapper" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Brand Name English</label>
                        <input class="form-control" type="text" name="brandnameen" value="brand name en" placeholder="brand name en">
                        @error('brandnameen')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Brand Name Bangla</label>
                        <input class="form-control" type="text" name="brandnamebn" value="brand name en" placeholder="brand name en">
                        @error('brandnamebn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Brand Image</label>
                        <input class="form-control" type="file" name="brandimage">
                        @error('brandimage')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New Brand</button>
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