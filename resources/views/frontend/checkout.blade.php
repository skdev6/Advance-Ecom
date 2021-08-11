@extends('layouts.frontend-master')

@section('content')
    <div class="container">
        <div class="row checkout-box ">
            <div class="col-lg-8">
                <div class="panel panel-default checkout-step-01 ">
                    <div class="panel-body">
                        <h4 class="checkout-subtitle">Shipping Adress</h4>
                        <form action="{{route('user.store.checkout')}}" method="POST" class="adress-form">
                            @csrf
                            <div class="row">
                                <!-- guest-login -->
                                <div class="col-md-6 col-sm-6 guest-login">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Name<span>*</span></label>
                                        <input type="text" name="name" class="form-control unicase-form-control text-input" value="{{Auth::user()->name}}" placeholder="Name" data-validation="required">
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
                                        <input type="email" name="email" class="form-control unicase-form-control text-input" value="{{Auth::user()->email}}"  placeholder="Email" data-validation="required">
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Phone<span>*</span></label>
                                        <input type="text" name="phone" class="form-control unicase-form-control text-input" value="{{Auth::user()->phone}}"  placeholder="Phone" data-validation="required">
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Post<span>*</span></label>
                                        <input type="text" name="post_code" class="form-control unicase-form-control text-input" placeholder="Post" data-validation="required">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 already-registered-login">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Select Division<span>*</span></label>
                                        <select name="select_division" id="select_division" class="form-control"  data-validation="required">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Select District<span>*</span></label>
                                        <select name="select_district" id="select_district" class="form-control" data-validation="required">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Select State<span>*</span></label>
                                        <select name="select_state" id="select_state" class="form-control" data-validation="required">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Nots<span>*</span></label>
                                        <textarea name="notes" id="" cols="30" rows="10" class="form-control" data-validation="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <div class="row text-center">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Stripe<span>*</span></label>
                                                <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="Stripe">
                                            </div>  
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Card<span>*</span></label>
                                                <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="Card">
                                            </div>  
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">HandCash<span>*</span></label>
                                                <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="HandCash">
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue d-block" style="width: 100%;">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                @foreach ($cards as $card)
                                    <div style="display: flex; flex-wrap:wrap; margin-bottom:10px">
                                        <img src="{{asset($card->options->image)}}" alt="" style="max-width: 50px;">
                                        Qty: {{$card->qty}} <br>
                                        Size: {{$card->options->size}} <br>
                                        Color: {{$card->options->color}}
                                    </div>    
                                @endforeach
                                <hr>
                                @if (session()->get('coupon'))
                                    <strong>Sub Total</strong> : ${{$total}} <br>
                                    <strong>Coupon Name</strong> : {{session()->get('coupon')['coupon_name']}} <br>
                                    <strong>Coupon Discound</strong> : {{session()->get('coupon')['coupon_descount']}}% <br>
                                    <strong>Coupon Amount</strong> : ${{session()->get('coupon')['coupon_amount']}} <br>
                                    <strong>Grand Total</strong> : ${{session()->get('coupon')['coupon_total']}} <br>
                                @else   
                                    Count : {{$count}} <br>
                                    Sub Total : ${{$total}} <br>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>

    <script>
        ;(function($){
            

            $.validate({
                leng:'en'
            })


            $('#select_division').on('change', function(){
                console.log("Changed");
                var $id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('user.get.district', '')}}/"+$id,
                    dataType: "json",
                    success: function (response) {
                        $("#select_district").empty();
                        if(response != ""){
                            $.each(response, function (index, value) { 
                                $("#select_district").append(`<option value="${value.id}">${value.district_name}</option>`);
                            });
                        }else{
                            $("#select_district").append(`<option value="">Not Found</option>`);
                        }
                    }
                });
            });
            $('#select_district').on('change', function(){
                var $id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('user.get.state', '')}}/"+$id,
                    dataType: "json",
                    success: function (response) {
                        $("#select_state").empty();
                        if(response != ""){
                            $.each(response, function (index, value) { 
                                $("#select_state").append(`<option value="${value.id}">${value.state_name}</option>`);
                            });
                        }else{
                            $("#select_state").append(`<option value="">Not Found</option>`);
                        }
                    }
                });
            });

        })(jQuery)
    </script>
@endpush