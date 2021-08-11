@extends('layouts.admin-master')
@section('permiession', 'show-sub active')
@section('add-permiession', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card pd-20 pd-sm-40">
                <h4 class="card-body-title">Add Permiession</h4>
                <form action="{{route('admin.permiession.update',$permiession->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label class="form-control-label">Role Name</label>
                                <select name="role_id" id="" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" {{$role->id == $permiession->role_id ? "selected": '' }}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add New Permiession</button>
                            </div> 
                        </div>
                        <div class="col-lg-8">
                            <div class="text-right">
                                <label class="ckbox d-inline-block">
                                <input type="checkbox" value="1" id="select-all" checked=""><span>Select All</span>
                                </label>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Permission</th>
                                        <th class="text-center">ADd</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Delete</th>
                                        <th class="text-center">List</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Slider</td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[slider][add]"
                                                @isset($permiession->permisson['slider']['add'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[slider][edite]"
                                                @isset($permiession->permisson['slider']['edite'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[slider][view]
                                                @isset($permiession->permisson['slider']['view'])
                                                    checked
                                                @endisset
                                            ">
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[slider][delete]"
                                                @isset($permiession->permisson['slider']['delete'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td> 
                                            <input type="checkbox" value="1" class="form-control" name="permisson[slider][list]"
                                                @isset($permiession->permisson['slider']['list'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product</td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[product][add]"
                                            @isset($permiession->permisson['product']['add'])
                                                checked
                                            @endisset
                                        >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[product][edite]"
                                                @isset($permiession->permisson['product']['edite'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[product][view]"
                                                @isset($permiession->permisson['product']['view'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[product][delete]"
                                                @isset($permiession->permisson['product']['delete'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[product][list]"
                                                @isset($permiession->permisson['product']['list'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coupon</td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[coupon][add]"
                                                @isset($permiession->permisson['coupon']['add'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[coupon][edite]"
                                                @isset($permiession->permisson['coupon']['edite'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[coupon][view]"
                                                @isset($permiession->permisson['coupon']['view'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[coupon][delete]"
                                                @isset($permiession->permisson['coupon']['delete'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[coupon][list]"
                                                @isset($permiession->permisson['coupon']['list'])
                                                    checked
                                                @endisset
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[brand][add]"
                                            @isset($permiession->permisson['brand']['add'])
                                                checked
                                            @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[brand][edite]"
                                            @isset($permiession->permisson['brand']['edite'])
                                                checked
                                            @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[brand][view]"
                                            @isset($permiession->permisson['brand']['view'])
                                                checked
                                            @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[brand][delete]"
                                            @isset($permiession->permisson['brand']['delete'])
                                                checked
                                            @endisset
                                            >
                                        </td>
                                        <td>
                                            <input type="checkbox" value="1" class="form-control" name="permisson[brand][list]"
                                            @isset($permiession->permisson['brand']['list']) 
                                                checked
                                            @endisset
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('inline-scripts')
    <script>
        ;(function(){
            var selectAllItems = "#select-all";
            var checkboxItem = ":checkbox";

            $(selectAllItems).click(function() {
            
            if (this.checked) {
                $(checkboxItem).each(function() {
                this.checked = true;
                });
            } else {
                $(checkboxItem).each(function() {
                this.checked = false;
                });
            }
            
            });
        })(jQuery);  
    </script>  
@endpush