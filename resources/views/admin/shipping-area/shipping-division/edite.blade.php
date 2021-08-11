@extends('layouts.admin-master')
@section('shipping', 'show-sub active') 
@section('shipping-division', 'active') 
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
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Update New Division</h4>
                <form action="{{route('admin.ship.update', $division->id)}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Division Name</label>
                        <input class="form-control" type="text" name="division_name" value="{{$division->division_name}}">
                        @error('division_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update Division</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('inline-scripts')
<script>
    $(function(){
      

    });
 
    ;(function($){
      
    })(jQuery);
  </script> 
@endpush