@extends('layouts.admin-master')
@section('shipping', 'show-sub active') 
@section('shipping-state', 'active') 
@push('links')
    <link href="{{asset('backend')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/lib/sweet/sweetalert2.min.css">
    <link href="{{asset('backend')}}/lib/select2/css/select2.min.css" rel="stylesheet">
    <style>
      .select2-container {
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
        <div class="col-lg-8">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Categoru List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p text-center">State Name</th>
                        <th class="wd-15p text-center">Division Name</th>
                        <th class="wd-15p text-center">District Name</th>
                        <th class="wd-15p text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($stats as $stat)
                        <tr>
                          <td style="vertical-align: middle" class="text-center"><strong>{{$stat->state_name}}</strong></td>
                          <td style="vertical-align: middle" class="text-center"><strong>{{$stat->division->division_name}}</strong></td>
                          <td style="vertical-align: middle" class="text-center"><strong>{{$stat->district->district_name}}</strong></td>
                          <td style="vertical-align: middle" class="text-center">
                            <a href="{{route('admin.ship.state.edite', $stat->id)}}" class="btn btn-pink">{{_("Edite")}}</a>
                            <a href="{{route('admin.ship.state.delete', $stat->id)}}" class="btn btn-danger delete">Delete</a>
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
                <h4 class="card-body-title">Add New Division</h4>
                <form action="{{route('admin.ship.state.store')}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Division Name</label>
                        <select name="division" id="division" class="d-none form-control select2-show-search select2-hidden-accessible">
                          <option value="">Select Division</option>
                          @foreach ($divisions as $division)
                              <option value="{{$division->id}}">{{ucwords($division->division_name)}}</option>
                          @endforeach
                        </select>
                        @error('division')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">District Name</label>
                        <select name="district" id="district" class="d-none form-control select2-show-search select2-hidden-accessible">
                          <option value="">Select District</option>
                        </select>
                        @error('district')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">State Name</label>
                        <input class="form-control" type="text" name="state_name">
                        @error('state_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add New State</button>
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

        $("#division").on('change', function(){
          $divId = $(this).val();
          $.ajax({
            type: "GET",
            url: "{{route('admin.get-division', '')}}/"+$divId,
            dataType: "json",
            success: function (response) {
              $("#district").empty();
              if(response != ""){
                $.each(response, function (index, value) {
                  $("#district").append(`<option value="${value.id}">${value.district_name}</option>`);
                });
              }else{
                $("#district").append(`<option value="">Data is not found</option>`);
              }
            }
          });
        });

    })(jQuery);
  </script> 
@endpush