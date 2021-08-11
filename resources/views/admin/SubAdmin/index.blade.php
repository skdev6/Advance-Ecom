@extends('layouts.admin-master')
@section('subadmin', 'show-sub active') 
@section('all-subadmin', 'active') 
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
<div class="card pd-20 pd-sm-40">
    <h6 class="card-body-title">Categoru List</h6>
    <div class="table-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
          <tr>
            <th class="wd-15p text-center">SL</th>
            <th class="wd-15p text-center">Name</th>
            <th class="wd-15p text-center">Email</th>
            <th class="wd-15p text-center">Role</th>
            <th class="wd-15p text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
                <td style="vertical-align: middle;" class="text-center">
                  {{$loop->iteration}}
                </td>
                <td style="vertical-align: middle" class="text-center">
                    {{$user->name}} 
                </td>
                <td style="vertical-align: middle" class="text-center">
                    {{$user->email}} 
                </td>
                <td style="vertical-align: middle" class="text-center">
                    {{$user->role->name}} 
                </td>
                <td style="vertical-align: middle" class="text-center">
                    <div class="btn-group">
                      <a href="{{route('admin.role.edit', $user->id)}}" class="btn btn-pink"><i class="icon ion-edit"></i></a>
                      <a href="{{route('admin.role.destroy', $user->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div><!-- table-wrapper -->
  </div><!-- card -->
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

    });
 
  </script> 
@endpush