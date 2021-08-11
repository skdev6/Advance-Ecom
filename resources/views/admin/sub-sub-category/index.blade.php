@extends('layouts.admin-master')
@section('sub-sub-category', 'active')
@section('active-sub-sub-category', 'show-sub') 
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
                <h6 class="card-body-title">Sub Categoru List</h6>
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Category Name</th>
                        <th class="wd-15p">Sub Category Name</th>
                        <th class="wd-15p">Sub Sub Cate Name En</th>
                        <th class="wd-20p">Sub Sub Cate Name Bn</th>
                        <th class="wd-15p">SubAction</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($subsub_category as $subsub_cat)
                        <tr>
                          <td style="vertical-align: middle">{{$subsub_cat->category->category_name_en}}</td>
                          <td style="vertical-align: middle">{{$subsub_cat->subcategory->category_name_en}}</td>
                          <td style="vertical-align: middle">{{$subsub_cat->subsubcategory_name_en}}</td>
                          <td style="vertical-align: middle">{{$subsub_cat->subsubcategory_name_bn}}</td>
                          <td style="vertical-align: middle">
                            <a href="{{route('admin.sub-subcat.edit', $subsub_cat->id)}}" class="btn btn-pink">{{_("Edite")}}</a>
                            <a href="{{route('admin.sub-sub-category.delete', $subsub_cat->id)}}" class="delete btn btn-danger">Delete</a>
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
                <h4 class="card-body-title">Add New Sub Category</h4>
                <form action="{{route('admin.sub-subcategory.store')}}" class="form-wrapper" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label d-block">Select Category</label>
                        <select name="category_id" class="mn-1d-none form-control select2-show-search select2-hidden-accessible">
                            <option value="">Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{ucwords($item->category_name_en)}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label class="form-control-label d-block">Sub Sub Select Category</label>
                      <select name="subcategory_id" class="d-none form-control select2-show-search select2-hidden-accessible">
                        <option>Sub Sub Category</option>
                      </select>
                      @error('subcategory_id')
                            <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name Englis</label>
                        <input class="form-control" type="text" name="sub_subcategory_nameen" placeholder="Category Name Englis">
                        @error('sub_subcategory_nameen')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Category Name Bangla</label>
                        <input class="form-control" type="text" name="sub_subcaterogy_namebn" placeholder="Category Name Bangla">
                        @error('sub_subcaterogy_namebn')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" style="cursor: pointer;">Add New SubCategory</button>
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

      // Select2 by showing the search
      $('.select2-show-search').select2({
          minimumResultsForSearch: ''
        });

    });
 
    ;(function($){
      $('.delete').click(function(e){
          e.preventDefault();
          var located = $(this).attr('href'); 
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to delete this!",
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

        $('select[name="category_id"]').on('change', function(){
          const $id = $(this).val();
          const SubSubSelect = $('select[name="subcategory_id"]');
            if($id){
              $.ajax({ 
                type: "get",
                url: "{{route('admin.get-sub-cat', '')}}/"+$id,
                dataType: "json",
                success: function (response){
                  if(response != ""){ 
                    SubSubSelect.empty();
                    $.each(response, function (indexInArray, valueOfElement) {
                      SubSubSelect.append("<option value="+valueOfElement.id+">"+valueOfElement.category_name_en);
                    });
                  }else{
                    SubSubSelect.empty();
                    SubSubSelect.append("<option>Data is not found");
                  }
                }
              });
            }
        });

    })(jQuery);
  </script> 
@endpush