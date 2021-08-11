@extends('layouts.frontend-master')
@section('content')
    <div class="container">
        <div style="background-color: white">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Product Size</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cards as $card)
                                    <tr>
                                        <td><img src="{{asset($card->options->image)}}" alt="" style="max-width: 50px"></td>
                                        <td>{{$card->name}}</td>
                                        <td>{{$card->options->color}}</td>
                                        <td>{{$card->options->size}}</td>
                                        <td>{{$card->qty}}</td>
                                        <td>{{$card->subtotal}}</td>
                                        <td><button class="bg-transparent"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (!session()->get('coupon'))
                    <!-- /.estimate-ship-tax -->
                    <div class="col-md-6 col-sm-12 estimate-ship-tax">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="coupon-field" class="form-control unicase-form-control text-input" placeholder="You Coupon.."> </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" id="apply-coupon" class="btn-upper btn btn-primary">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /table -->
                    </div>  
                @endif
                <!-- /.estimate-ship-tax -->
                <div class="col-md-6 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead>
                            <tr>
                                <th id="Calculation"></th>
                            </tr>
                        </thead>
                        <!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{route('ckeckout')}}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a> <span class="">Checkout with multiples address!</span> </div>
                                </td>
                            </tr>
                        </tbody>
                        <!-- /tbody -->
                    </table>
                    <!-- /table -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@push('script')
    <script>

        ;(function($){
            $("#apply-coupon").on('click', function(){
                var Coupon_Name = $("#coupon-field").val();
                $.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}'
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{route('apply-coupon')}}",
                    data: {
                        coupon_name: Coupon_Name
                    },
                    dataType: "json",
                    success: function (response) {
                        const Tost = Swal.mixin({
							toast: true,
							animation: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
						});
						if(response.success){
							Tost.fire({
								type:'success',
								title:response.success,
								icon: 'success',
							});
						}else{
							Tost.fire({
								type:'error',
								title:response.error,
								icon: 'error',
							});
						}
                        Discound_fun();
                    }
                });
            });
            Discound_fun();
            function Discound_fun(){
                $.ajax({
                    type: "GET",
                    url: "{{route('coupon.calculation')}}",
                    dataType: "json",
                    success: function (response) {
                        if(response.total){
                            $("#Calculation").html(`
                                <div class="cart-sub-total"> Subtotal<span class="inner-left-md">$${response.total}</span> </div>
                                <div class="cart-grand-total"> Grand Total<span class="inner-left-md">$${response.total}</span> </div>
                            `);   
                        }else{
                            $("#Calculation").html(`
                                <div class="cart-sub-total"> Subtotal<span class="inner-left-md">$${response.subtotal}</span> </div>
                                <div class="cart-grand-total"> Grand Total<span class="inner-left-md">$${response.coupon_total}</span> <button class="close-coupon">✖</button></div>
                                <div class="cart-grand-total"> Coupon Name<span class="inner-left-md">${response.coupon_name}</span> </div>
                                <div class="cart-grand-total"> Coupon Discound<span class="inner-left-md">$${response.discound_amount}</span> </div>
                            `);  
                        }
                        removeCoupon(); 
                    }
                });
            }

            function removeCoupon(){
                $('.close-coupon').on('click', function(){
                    $.ajax({
                        type: "GET",
                        url: "{{route('remove-coupon')}}",
                        dataType: "json",
                        success: function (response) {
                            Discound_fun();
                            const Tost = Swal.mixin({
                                toast: true,
                                animation: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                            });
                            if(response.remove){
                                Tost.fire({
                                    type:'success',
                                    title:response.remove,
                                    icon: 'success',
                                });
                            }
                        }
                    });
                });
            }


        })(jQuery);
    </script>
@endpush