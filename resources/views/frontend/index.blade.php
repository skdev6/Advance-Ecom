@extends('layouts.frontend-master')
@section('content')
@php
    function change_bgngla($str){
        $en = [1,2,3,4,5,6,7,8,9,0];
        $bn = ['১','২','৩','৪','৫','৬','৭','৮','৯','০'];
        $str = str_replace($en, $bn, $str);
        return $str;
    }
@endphp
<div class="container">
    <div class="row">
        <!-- ============================================== SIDEBAR ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
            @include('frontend.inc.category')
            <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                <h3 class="section-title">{{session()->get('language') == 'bangla' ? _("গরম হচ্ছে") : _("hot deals")}}</h3> 
                <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                    @foreach ($hot_deals as $hot_deal_item)
                        <div class="item">
                            <div class="products">
                                <div class="hot-deal-wrapper">
                                    <div class="image"> <img src="{{asset($hot_deal_item->product_thumbnail)}}" alt=""> </div>
                                        @if ($hot_deal_item->discount_price != null)
                                        <div class="sale-offer-tag">
                                        @php
                                            $price = $hot_deal_item->selling_price - $hot_deal_item->discount_price;
                                            $amount =  ($price/$hot_deal_item->selling_price) * 100;
                                        @endphp
                                        <span>{{change_bgngla(round($amount))}}%<br>off</span>
                                        </div>
                                        @endif
                                    <div class="timing-wrapper">
                                        <div class="box-wrapper">
                                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                                        </div>
                                        <div class="box-wrapper">
                                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                                        </div>
                                        <div class="box-wrapper hidden-md">
                                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.hot-deal-wrapper -->
                                <div class="product-info text-left m-t-20">
                                    <h3 class="name">
                                        <a href="{{route('single.product', [$hot_deal_item->id, $hot_deal_item->product_slug_en])}}">{{session()->get('language') == 'bangla' ? $hot_deal_item->product_name_bn : $hot_deal_item->product_name_en}}</a>
                                    </h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="product-price"> <span class="price">
                                {{session()->get('language') == 'bangla' ? change_bgngla($hot_deal_item->selling_price) : $hot_deal_item->selling_price}}
                            </span> <span class="price-before-discount">{{$hot_deal_item->discount_price != null ? $hot_deal_item->discount_price: ""}}</span> </div>
                                    <!-- /.product-price -->
                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <div class="add-cart-button btn-group">
                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                        </div>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('frontend.inc.tags')
            <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                <h3 class="section-title">Newsletters</h3>
                <div class="sidebar-widget-body outer-top-xs">
                    <p>Sign Up for Our Newsletter!</p>
                    <form role="form">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter"> </div>
                        <button class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                <div id="advertisement" class="advertisement">
                    <div class="item">
                        <div class="avatar"><img src="{{asset("frontend")}}/assets/images/testimonials/member1.png" alt="Image"></div>
                        <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                        <div class="clients_author">John Doe <span>Abc Company</span> </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="avatar"><img src="{{asset("frontend")}}/assets/images/testimonials/member3.png" alt="Image"></div>
                        <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                        <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="avatar"><img src="{{asset("frontend")}}/assets/images/testimonials/member2.png" alt="Image"></div>
                        <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                        <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.item -->
                </div>
                <!-- /.owl-carousel -->
            </div>
            <!-- ============================================== Testimonials: END ============================================== -->
            <div class="home-banner"> <img src="{{asset("frontend")}}/assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
        </div>
        <!-- /.sidemenu-holder -->
        <!-- ============================================== SIDEBAR : END ============================================== -->
        <!-- ============================================== CONTENT ============================================== -->
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
            <!-- ========================================== SECTION – HERO ========================================= -->
            <div id="hero">
                <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                    @foreach ($slides as $slides_item)
                        <div class="item" style="background-image: url({{asset($slides_item->image)}});">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="big-text fadeInDown-1">
                                        @if (session()->get('language') == 'english')
                                            {{$slides_item->title_en}}
                                        @else
                                            {{$slides_item->title_bn}}
                                        @endif
                                    </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs">
                                        @if (session()->get('language') == 'english')
                                            <span>{{$slides_item->description_en}}</span>
                                        @else
                                            <span>{{$slides_item->description_bn}}</span>
                                        @endif
                                    </div>
                                    <div class="button-holder fadeInDown-3">
                                        <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
            <div class="info-boxes wow fadeInUp">
                <div class="info-boxes-inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">money back</h4> </div>
                                </div>
                                <h6 class="text">30 Days Money Back Guarantee</h6> </div>
                        </div>
                        <!-- .col -->
                        <div class="hidden-md col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">free shipping</h4> </div>
                                </div>
                                <h6 class="text">Shipping on orders over $99</h6> </div>
                        </div>
                        <!-- .col -->
                        <div class="col-md-6 col-sm-4 col-lg-4">
                            <div class="info-box">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="info-box-heading green">Special Sale</h4> </div>
                                </div>
                                <h6 class="text">Extra $5 off on all items </h6> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                <div class="more-info-tab clearfix ">
                   <h3 class="new-product-title pull-left">New Products</h3>
                   <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                      <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                      @foreach ($categores as $category)
                      <li><a data-transition-type="backSlide" href="#category-{{$category->category_slug_en}}" data-toggle="tab">{{$category->category_name_en}}</a></li>
                      @endforeach
                   </ul>
                   <!-- /.nav-tabs -->
                </div>
                <div class="tab-content outer-top-xs">
                   <div class="tab-pane in active" id="all">
                      <div class="product-slider">
                         <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                             @foreach ($productes as $product)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{route('single.product', [$product->id, $product->product_slug_en])}}"><img src="{{asset($product->product_thumbnail)}}" alt=""></a>
                                                </div>
                                                <div class="tag new"><span>new</span></div>
                                            </div>
                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="detail.html">
                                                        {{session()->get('language') == 'english' ? $product->product_name_en : $product->product_name_bn}}
                                                    </a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price">
                                                    @if (session('language') == 'english')
                                                       {{$product->selling_price}}
                                                    @else
                                                        {{ change_bgngla($product->selling_price)}}
                                                    @endif 
                                                </span> 
                                                @if ($product->discount_price != NULL)
                                                    <span class="price-before-discount">{{change_bgngla($product->discount_price)}}</span>                                                     
                                                @endif
                                                </div>
                                                <!-- /.product-price -->
                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#productModal" data-toggle="tooltip" class="btn btn-primary icon has-ajax-card" data-id="{{$product->id}}" type="button" title="Add Cart"><i class="fa fa-shopping-cart"></i> </button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a data-toggle="tooltip" class="add-to-cart add-wishlist" href="#" data-id="{{$product->id}}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                         </div>
                      </div>
                   </div>
                  @foreach ($categores as $category)
                    <div class="tab-pane" id="category-{{$category->category_slug_en}}">
                        @php
                            $products_items = App\Models\Product::where('category_id', $category->id)->orderBy('product_name_en', 'DESC')->get();
                        @endphp
                        <div class="product-slider">
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                @forelse ($products_items as $product_item)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{route('single.product', [$product_item->id, $product_item->product_slug_en])}}"><img src="{{asset($product_item->product_thumbnail)}}" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    <div class="tag sale"><span>sale</span></div>
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{route('single.product', [$product_item->id, $product_item->product_slug_en])}}">{{session()->get('language') == 'english' ? $product_item->product_name_en : $product_item->product_name_bn}}</a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> <span class="price">
                                                        ${{change_bgngla($product->selling_price)}}</span>
                                                        @if ($product->discount_price != NULL)
                                                            <span class="price-before-discount">{{change_bgngla($product->discount_price)}}</span>                                                     
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                        </li>
                                                        <li class="lnk wishlist">
                                                            <a class="add-to-cart add-wishlist" href="#" data-id="{{$product_item->id}}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                        </li>
                                                        <li class="lnk">
                                                            <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                        </div>
                                        <!-- /.products -->
                                    </div>  
                                    @empty
                                    <div class="text-center w-100" style="padding-bottom:20px;">
                                        No Product Found
                                    </div>
                                @endforelse
                            </div>
                            <!-- /.home-owl-carousel -->
                        </div>
                    </div> 
                   @endforeach
                   
                </div>
                <!-- /.tab-content -->
             </div>
            <!-- /.scroll-tabs -->
            <!-- ============================================== SCROLL TABS : END ============================================== -->
            <!-- ============================================== WIDE PRODUCTS ============================================== -->
            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive" src="{{asset("frontend")}}/assets/images/banners/home-banner1.jpg" alt=""> </div>
                        </div>
                        <!-- /.wide-banner -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5 col-sm-5">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive" src="{{asset("frontend")}}/assets/images/banners/home-banner2.jpg" alt=""> </div>
                        </div>
                        <!-- /.wide-banner -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <section class="section featured-product wow fadeInUp">
                <h3 class="section-title">Featured products</h3>
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                    @foreach ($features as $product_item)
                        <div class="item item-carousel">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{route('single.product', [$product_item->id, $product_item->product_slug_en])}}"><img src="{{asset($product_item->product_thumbnail)}}" alt=""></a>
                                    </div>
                                    <!-- /.image -->
                                    <div class="tag sale"><span>sale</span></div>
                                </div>
                                <!-- /.product-image -->
                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{route('single.product', [$product_item->id, $product_item->product_slug_en])}}">{{session()->get('language') == 'english' ? $product_item->product_name_en : $product_item->product_name_bn}}</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price">
                                        ${{change_bgngla($product->selling_price)}}</span>
                                        @if ($product->discount_price != NULL)
                                            <span class="price-before-discount">{{change_bgngla($product->discount_price)}}</span>                                                     
                                        @endif
                                    </div>
                                </div>
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button data-toggle="modal" data-target="#productModal" data-toggle="tooltip" class="btn btn-primary icon has-ajax-card" data-toggle="dropdown" type="button" data-id="{{$product_item->id}}"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a  class="add-to-cart add-wishlist" href="#" data-id="{{$product_item->id}}"> <i class="icon fa fa-heart"></i> </a>
                                            </li>
                                            <li class="lnk">
                                                <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive" src="{{asset("frontend")}}/assets/images/banners/home-banner.jpg" alt=""> </div>
                            <div class="strip strip-text">
                                <div class="strip-inner">
                                <h2 class="text-right">New Mens Fashion<br>
                                <span class="shopping-needs">Save up to 40% off</span></h2> </div>
                            </div>
                            <div class="new-label">
                                <div class="text">NEW</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.inc.brand')
</div>
@endsection