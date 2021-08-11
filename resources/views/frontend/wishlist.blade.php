@extends('layouts.frontend-master')
@section('content')
<div class="container">
    <div class="my-wishlist-page">
        <div class="row">
            <div class="col-md-12 my-wishlist">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4" class="heading-title">My Wishlist</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $product_item)
                            <tr>
                                <td class="col-md-2"><img src="{{asset($product_item->products->product_thumbnail)}}" alt="imga"></td>
                                <td class="col-md-7">
                                    <div class="product-name"><a href="{{route('single.product', [$product_item->product_id, $product_item->products->product_slug_en])}}">{{$product_item->products->product_name_en}}</a></div>
                                    <div class="rating"> <i class="fa fa-star rate"></i> <i class="fa fa-star rate"></i> <i class="fa fa-star rate"></i> <i class="fa fa-star rate"></i> <i class="fa fa-star non-rate"></i> <span class="review">( 06 Reviews )</span> </div>
                                    <div class="price">${{$product_item->products->selling_price}}</div>
                                </td>
                                <td class="col-md-2"> <a href="#" class="btn-upper btn btn-primary">Add to cart</a> </td>
                                <td class="col-md-1 close-btn"> <a href="#" class=""><i class="fa fa-times"></i></a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection