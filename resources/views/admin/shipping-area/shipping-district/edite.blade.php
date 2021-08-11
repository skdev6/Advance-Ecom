@extends('layouts.admin-master')
@section('shipping', 'show-sub active') 
@section('shipping-division', 'active') 
@push('links')
    <link href="{{asset('backend')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/lib/sweet/sweetalert2.min.css">
    <link href="{{asset('backend')}}/lib/select2/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container{
            width: auto !important;
            display: block !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{asset('backend')}}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{asset('backend')}}/lib/sweet/sweetalert2.all.min.js"></script>
    <script src="{{asset('backend')}}/lib/select2/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Update New District</h4>
                <form action="{{route('admin.ship.district.update', $district->id)}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">District Name</label>
                        <select name="division" id="" class="d-none form-control select2-show-search select2-hidden-accessible">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{$division->id}}" {{$division->id == $district->division_id ? 'selected' : ''}}>{{ucwords($division->division_name)}}</option>
                            @endforeach
                        </select>
                        @error('district_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">District Name</label>
                        <input class="form-control" type="text" name="district_name" value="{{$district->district_name}}">
                        @error('district_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update District</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('inline-scripts')
<script>
    ;(function($){
        // Select2 by showing the search
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });

    })(jQuery);
  </script> 
@endpush