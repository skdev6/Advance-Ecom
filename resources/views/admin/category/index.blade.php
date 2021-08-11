@extends('layouts.admin-master')
@section('category', 'active') 
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
                <h6 class="card-body-title">Categoru List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Category Icone</th>
                        <th class="wd-15p">Category Name En</th>
                        <th class="wd-20p">Category Name Bn</th>
                        <th class="wd-15p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categores as $category)
                        <tr>
                          <td style="vertical-align: middle" class="text-center"><i class="{{$category->category_icon}} tx-20"></i></td>
                          <td style="vertical-align: middle">{{$category->category_name_en}}</td>
                          <td style="vertical-align: middle">{{$category->category_name_bn}}</td>
                          <td style="vertical-align: middle">
                            <a href="{{route('admin.category.edite', $category->id)}}" class="btn btn-pink">{{_("Edite")}}</a>
                            <a href="{{route('admin.category.delete', $category->id)}}" class="btn btn-danger">Delete</a>
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
                <h4 class="card-body-title">Add New Category</h4>
                <form action="{{route('admin.category.store')}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Category Name Englis</label>
                        <input class="form-control" type="text" name="category_nameen" placeholder="Category Icone">
                        @error('category_nameen')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name Bangla</label>
                        <input class="form-control" type="text" name="caterogy_namebn" placeholder="Category name en">
                        @error('caterogy_namebn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Icone</label>
                        <input class="form-control" type="text" name="category_icone" placeholder="Category Icone">
                        @error('category_icone')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New Category</button>
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