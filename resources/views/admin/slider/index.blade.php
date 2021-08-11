@extends('layouts.admin-master')
@section('slider', 'active')
@push('links')
    <link href="{{asset('backend')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/lib/sweet/sweetalert2.min.css">

@endpush
@section('style')
<style>
  td{
    vertical-align: middle !important; 
  }
</style>
@endsection
@push('scripts')
    <script src="{{asset('backend')}}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{asset('backend')}}/lib/sweet/sweetalert2.all.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Slide List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Slide Image</th>
                        <th class="wd-15p">Slide Title</th>
                        <th class="wd-20p">Description</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-15p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sliders as $slide)
                        <tr>
                          <td style="width: 150px;"><img src="{{asset($slide->image)}}" class="w-100" alt=""></td>
                          <td>{{$slide->title_en}}</td>
                          <td>{{$slide->description_en}}</td>
                          <td>
                            @if ($slide->status == 1)
                                <span class="badge badge-pill badge-success">Active</span>
                            @else
                                <span class="badge badge-pill badge-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{route('admin.slide.edit', $slide->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <a href="{{route('admin.slide.delete',$slide->id)}}" class="delete btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            @if ($slide->status == 1)
                              <a href="{{route('admin.slide.inactive',$slide->id)}}" class="btn btn-success"><i class="fas fa-arrow-down"></i></a>
                            @else
                              <a href="{{route('admin.slide.active',$slide->id)}}" class="btn btn-danger"><i class="fas fa-arrow-up"></i></a>
                            @endif
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
                <form action="{{route('admin.slide.store')}}" class="form-wrapper" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Slide Title</label>
                        <input class="form-control" type="text" name="slidetitle_en" placeholder="Slide Title">
                        @error('slidetitle_en')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Title Bangla</label>
                        <input class="form-control" type="text" name="slidetitle_bn" placeholder="Slide Title Bangla">
                        @error('slidetitle_bn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Description</label>
                        <input class="form-control" type="text" name="slidedescription_en" placeholder="Slide Description">
                        @error('slidedescription_en')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Description Bangla</label>
                        <input class="form-control" type="text" name="slidedescription_bn" placeholder="Slide Description Bangla">
                        @error('slidedescription_bn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Image</label>
                        <input class="form-control" type="file" name="slideimage">
                        @error('slideimage')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New Slide</button>
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