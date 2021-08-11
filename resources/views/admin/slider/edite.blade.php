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
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add New Brand</h4>
                <form action="{{route('admin.slide.update', $slide->id)}}" class="form-wrapper" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Slide Title</label>
                        <input class="form-control" type="text" name="slidetitle_en" value="{{$slide->title_en}}" placeholder="Slide Title">
                        @error('slidetitle_en')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Title Bangla</label>
                        <input class="form-control" type="text" name="slidetitle_bn" value="{{$slide->title_bn}}" placeholder="Slide Title Bangla">
                        @error('slidetitle_bn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Description</label>
                        <input class="form-control" type="text" name="slidedescription_en" value="{{$slide->description_en}}" placeholder="Slide Description">
                        @error('slidedescription_en')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Description Bangla</label>
                        <input class="form-control" type="text" name="slidedescription_bn" value="{{$slide->description_bn}}" placeholder="Slide Description Bangla">
                        @error('slidedescription_bn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img src="{{asset($slide->image)}}" class="w-100" alt="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Slide Image</label>
                        <input class="form-control" type="file" name="slideimage">
                        @error('slideimage')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Slide</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('inline-scripts')
<script>
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