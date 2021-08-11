<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="MediaCenter, Template, eCommerce">
	<meta name="robots" content="all">
	<title>Flipmart premium HTML5 & CSS3 Template</title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/bootstrap.min.css">
	<!-- Customizable CSS -->
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/main.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/blue.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/owl.transitions.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/animate.min.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/rateit.css">
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="{{asset('backend')}}/lib/sweet/sweetalert2.min.css">
	<link rel="stylesheet" href="{{asset('backend/css/all.min.css')}}">
	@if (Session::has("toster"))
	<link rel="stylesheet" href="{{asset("backend")}}/lib/toster/toastr.min.css">
	@endif
	@stack('head-script')
	@stack('css-links')
	<!-- Icons/Glyphs -->
	<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/font-awesome.css">
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	@yield('style')
	<script src="https://js.stripe.com/v3/"></script>
</head>
<body class="cnt-home">
	<header class="header-style-1">
		<!-- ============================================== TOP MENU ============================================== -->
		<div class="top-bar animate-dropdown">
			<div class="container">
				<div class="header-top-inner">
					<div class="cnt-account"> 
						<ul class="list-unstyled">
							<li><a href="#"><i class="icon fa fa-user"></i>{{session()->get('language') == 'english' ? _("My Account") : _("আমার অ্যাকাউন্ট")}}</a></li>
							<li><a href="{{route('wishlist')}}"><i class="icon fa fa-heart"></i>{{session()->get('language') == 'english' ? _("Wishlist") : _("ইচ্ছেতালিকা")}}</a></li>
							<li><a href="{{route('view-cart')}}"><i class="icon fa fa-shopping-cart"></i>{{session()->get('language') == 'english' ? _("My Cart") : _("আমার কার্ট")}}</a></li>
							<li><a href="#"><i class="icon fa fa-check"></i>{{session()->get('language') == 'english' ? _("Checkout") : _("চেকআউট")}}</a></li>
							<li>
								@auth
								<a href="{{ route('user.dashboard') }}"></i> {{__('Profile')}} </a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
								@else
									<a href="{{route('login')}}"><i class="icon fa fa-lock"></i>Login/register</a>
								@endauth
							</li>
						</ul>
					</div>
					<!-- /.cnt-account -->
					<div class="cnt-block">
						<ul class="list-unstyled list-inline">
							<li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">USD</a></li>
									<li><a href="#">INR</a></li>
									<li><a href="#">GBP</a></li>
								</ul>
							</li>
							<li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
								<span class="value">{{session()->get('language') == 'english' ? "Language" : "ভাষা পরিবর্তন করুন"}}</span><b class="caret"></b></a>
								<ul class="dropdown-menu">
									@if (session()->get('language') == 'bangla')
										<li><a href="{{route('language.english')}}">English</a></li>
									@else 
										<li><a href="{{route('language.bangla')}}">বাংলা</a></li>
									@endif
								</ul>
							</li>
						</ul>
						<!-- /.list-unstyled -->
					</div>
					<!-- /.cnt-cart -->
					<div class="clearfix"></div>
				</div>
				<!-- /.header-top-inner -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.header-top -->
		<!-- ============================================== TOP MENU : END ============================================== -->
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
						<!-- ============================================================= LOGO ============================================================= -->
						<div class="logo">
							<a href="{{url("/")}}"> <img src="{{asset('frontend')}}/assets/images/logo.png" alt=""> </a>
						</div>
						<!-- /.logo -->
						<!-- ============================================================= LOGO : END ============================================================= -->
					</div>
					<!-- /.logo-holder -->
					<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
						<!-- /.contact-row -->
						<!-- ============================================================= SEARCH AREA ============================================================= -->
						<div class="search-area">
							<form action="{{route('search.product')}}" method="GET">
								<div class="control-group">
									<input name="search" class="search-field" placeholder="Search here..." />
									<button class="search-button"></button>
								</div>
							</form>
						</div>
						<!-- /.search-area -->
						<!-- ============================================================= SEARCH AREA : END ============================================================= -->
					</div>
					<!-- /.top-search-holder -->
					<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
						<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
						<div class="dropdown dropdown-cart">
							<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
								<div class="items-cart-inner">
									<div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
									<div class="basket-item-count"><span class="count">2</span></div>
									<div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price">
						<span class="sign">$</span><span class="value">600.00</span> </span>
									</div>
								</div>
							</a>
							<ul class="dropdown-menu">
								<li>
									<div class="add-card-mini"></div>
									<div class="clearfix cart-total">
										<div class="pull-right"> <span class="text">Sub Total :</span><span class='price' id="total-price">$600.00</span> </div>
										<div class="clearfix"></div> <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
									<!-- /.cart-total-->
								</li>
							</ul>
							<!-- /.dropdown-menu-->
						</div>
						<!-- /.dropdown-cart -->
						<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
					</div>
					<!-- /.top-cart-row -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.main-header -->
		<!-- ============================================== NAVBAR ============================================== -->
		<div class="header-nav animate-dropdown">
			<div class="container">
				<div class="yamm navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					</div>
					<div class="nav-bg-class">
						<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
							<div class="nav-outer">
								<ul class="nav navbar-nav">
									@php
										$category = App\Models\Category::orderBy('category_name_en', "ASC")->get();
									@endphp
									@foreach ($category as $cat_item)
										<li class="dropdown yamm-fw">
											<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{$cat_item->category_name_en}}</a>
											@php
												$subCategores = App\Models\SubCategory::where('categories_id', $cat_item->id)->orderBy('category_name_en', 'ASC')->get();
											@endphp
											<ul class="dropdown-menu container">
												<li>
													<div class="yamm-content ">
														<div class="row">
															@foreach ($subCategores as $subCategory_item)
																<div class="col-xs-12 col-sm-6 col-md-2 col-menu">
																	<h2 class="title">{{$subCategory_item->category_name_en}}</h2>
																	@php
																		$subSubCategores = App\Models\SubSubCategory::where('subcategory_id', $subCategory_item->id)->orderBy('subsubcategory_name_en')->get();
																	@endphp
																	<ul class="links">
																		@foreach ($subSubCategores as $subsub_item)
																			<li><a href="#">{{$subsub_item->subsubcategory_name_en}}</a></li>
																		@endforeach
																	</ul>
																</div>
															@endforeach
														</div>
													</div>
												</li>
											</ul>
										</li>
									@endforeach
								</ul>
								<!-- /.navbar-nav -->
								<div class="clearfix"></div>
							</div>
							<!-- /.nav-outer -->
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.nav-bg-class -->
				</div>
				<!-- /.navbar-default -->
			</div>
			<!-- /.container-class -->
		</div>
		<!-- /.header-nav -->
		<!-- ============================================== NAVBAR : END ============================================== -->
	</header>
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
		@yield('content')
	</div>
	<footer id="footer" class="footer color-bg">
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Contact Us</h4> </div>
						<!-- /.module-heading -->
						<div class="module-body">
							<ul class="toggle-footer" style="">
								<li class="media">
									<div class="pull-left"> <span class="icon fa-stack fa-lg">
                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span> </div>
									<div class="media-body">
										<p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
									</div>
								</li>
								<li class="media">
									<div class="pull-left"> <span class="icon fa-stack fa-lg">
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span> </div>
									<div class="media-body">
										<p>+(888) 123-4567
											<br>+(888) 456-7890</p>
									</div>
								</li>
								<li class="media">
									<div class="pull-left"> <span class="icon fa-stack fa-lg">
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span> </div>
									<div class="media-body"> <span><a href="#">flipmart@themesground.com</a></span> </div>
								</li>
							</ul>
						</div>
						<!-- /.module-body -->
					</div>
					<!-- /.col -->
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Customer Service</h4> </div>
						<!-- /.module-heading -->
						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a href="#" title="Contact us">My Account</a></li>
								<li><a href="#" title="About us">Order History</a></li>
								<li><a href="#" title="faq">FAQ</a></li>
								<li><a href="#" title="Popular Searches">Specials</a></li>
								<li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
							</ul>
						</div>
						<!-- /.module-body -->
					</div>
					<!-- /.col -->
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Corporation</h4> </div>
						<!-- /.module-heading -->
						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a title="Your Account" href="#">About us</a></li>
								<li><a title="Information" href="#">Customer Service</a></li>
								<li><a title="Addresses" href="#">Company</a></li>
								<li><a title="Addresses" href="#">Investor Relations</a></li>
								<li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
							</ul>
						</div>
						<!-- /.module-body -->
					</div>
					<!-- /.col -->
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="module-heading">
							<h4 class="module-title">Why Choose Us</h4> </div>
						<!-- /.module-heading -->
						<div class="module-body">
							<ul class='list-unstyled'>
								<li class="first"><a href="#" title="About us">Shopping Guide</a></li>
								<li><a href="#" title="Blog">Blog</a></li>
								<li><a href="#" title="Company">Company</a></li>
								<li><a href="#" title="Investor Relations">Investor Relations</a></li>
								<li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
							</ul>
						</div>
						<!-- /.module-body -->
					</div>
				</div>
			</div>
		</div>
		<div class="copyright-bar">
			<div class="container">
				<div class="col-xs-12 col-sm-6 no-padding social">
					<ul class="link">
						<li class="fb pull-left">
							<a target="_blank" rel="nofollow" href="#" title="Facebook"></a>
						</li>
						<li class="tw pull-left">
							<a target="_blank" rel="nofollow" href="#" title="Twitter"></a>
						</li>
						<li class="googleplus pull-left">
							<a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a>
						</li>
						<li class="rss pull-left">
							<a target="_blank" rel="nofollow" href="#" title="RSS"></a>
						</li>
						<li class="pintrest pull-left">
							<a target="_blank" rel="nofollow" href="#" title="PInterest"></a>
						</li>
						<li class="linkedin pull-left">
							<a target="_blank" rel="nofollow" href="#" title="Linkedin"></a>
						</li>
						<li class="youtube pull-left">
							<a target="_blank" rel="nofollow" href="#" title="Youtube"></a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 no-padding">
					<div class="clearfix payment-methods">
						<ul>
							<li><img src="{{asset('frontend')}}/assets/images/payments/1.png" alt=""></li>
							<li><img src="{{asset('frontend')}}/assets/images/payments/2.png" alt=""></li>
							<li><img src="{{asset('frontend')}}/assets/images/payments/3.png" alt=""></li>
							<li><img src="{{asset('frontend')}}/assets/images/payments/4.png" alt=""></li>
							<li><img src="{{asset('frontend')}}/assets/images/payments/5.png" alt=""></li>
						</ul>
					</div>
					<!-- /.payment-methods -->
				</div>
			</div>
		</div>
	</footer>
<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="product-thumb"><img class="w-100" id="Popup-prod-thumb" src="" alt=""></div>
				</div>
				<div class="col-lg-8">
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-group">
								<li class="list-group-item">Price: <strong id="Popup-prod-price"></strong></li>
								<li class="list-group-item">Product Code: <strong id="Popup-prod-prod-code"></strong></li>
								<li class="list-group-item">Category: <strong id="Popup-prod-cat"></strong></li>
								<li class="list-group-item">Brand: <strong id="Popup-prod-brand"></strong></li>
								<li class="list-group-item">Stock: <strong id="Popup-prod-stock"></strong></li>
							</ul>
						</div>
						<div class="col-lg-6">
							<div class="form-group mb-3">
								<label>Select Color</label>
								<select name="" class="form-control" id="Popup-prod-color"></select>
							</div>
							<div class="form-group mb-3">
								<label>Select Size</label>
								<select name="" class="form-control" id="Popup-prod-size"></select>
							</div>
							<div class="form-group mb-3">
								<label>Quantity</label>
								<input type="number" class="form-control" id="quantity-val">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 text-right mt-5">
					<button id="add_product_id" class="btn btn-success">Add To Card</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
  </div>
	<script src="{{asset('frontend')}}/assets/js/jquery-1.11.1.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/owl.carousel.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/echo.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/jquery.easing-1.3.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/bootstrap-slider.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/jquery.rateit.min.js"></script>
	<script type="text/javascript" src="{{asset('frontend')}}/assets/js/lightbox.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/bootstrap-select.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/wow.min.js"></script>
	<script src="{{asset('frontend')}}/assets/js/scripts.js"></script>
	<script src="{{asset('backend')}}/lib/sweet/sweetalert2.all.min.js"></script>
	@if (Session::has("toster"))
		<script src="{{asset("backend")}}/lib/toster/toastr.min.js"></script>
		<script>
			var type = "{{Session::get('alert-type')}}";
			switch (type) {
				case 'success':
					toastr.success("{{Session::get('message')}}") 
					break;
				
				case 'error':
					toastr.error("{{Session::get('message')}}") 
					break;
				default:
					break;
			}
		</script>
	@endif
	<script>
		;(function($){
			$('.has-ajax-card').on('click', function () {
				$prodID = $(this).data('id');
				$.ajax({
					type: "get",
					url: "product-view-ajax/"+$prodID,
					dataType:'json',
					success: function (data) {
						$("#Popup-prod-thumb").attr('src', "{{asset('/')}}"+data.product.product_thumbnail);
						$("#Popup-prod-price").text(data.product.selling_price);
						$("#Popup-prod-prod-code").text(data.product.product_code);
						$("#Popup-prod-cat").text(data.product.category.category_name_en);
						$("#Popup-prod-brand").text(data.product.brand.brand_name_en);
						$("#Popup-prod-stock").text(data.product.selling_price); 
						$("#add_product_id").attr('data-id', data.product.id); 
						$("#Popup-prod-color").empty(); 
						$.each(data.product_color, function (indexInArray, valueOfElement) { 
							$("#Popup-prod-color").append('<option value="">'+valueOfElement+'</option>'); 
						});
						$("#Popup-prod-size").empty(); 
						$.each(data.product_size, function (indexInArray, valueOfElement) { 
							$("#Popup-prod-size").append('<option value="">'+valueOfElement+'</option>'); 
						});
					}
				});
			});

			$('#add_product_id').on('click', function(){

				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}'
					}
				});
				var add_color = $("#Popup-prod-color option:selected").text();
				var add_size = $("#Popup-prod-size option:selected").text();;
				var Quantity_Val = $("#quantity-val").val();
				var add_prod_id = $("#add_product_id").data('id');
				$.ajax({
					type: "POST",
					url: "{{route('add-to-card', '')}}/"+add_prod_id,
					data: {
						color:add_color, size:add_size, qty: Quantity_Val, prod_id: add_prod_id
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
								title:response.title,
								icon: 'success',
							});
							CardMini();
						}else{
							Tost.fire({
								type:'error',
								title:'product added error',
								icon: 'error',
							});
						}
					}
				});

			});

			function CardMini() {


				$.ajax({
					type: "GET",
					url: "/mini-card-content",
					dataType: "json",
					success: function (response) {
						$.each(response.carts, function (index, value) {
							$(".add-card-mini").append(`<div class="cart-item product-summary">
								<div class="row">
									<div class="col-xs-4">
										<div class="image">
											<a href="detail.html"><img src="${value.options.image}" alt=""></a>
										</div>
									</div>
									<div class="col-xs-7">
										<h3 class="name"><a href="#">${value.name}</a></h3>
										<div class="price">$${value.price}</div>
									</div>
									<div class="col-xs-1 action"> <a class="mc-remove-action" href="{{route('remove-mini-cart', '')}}/${value.rowId}" data-id="${value.rowId}"><i class="fa fa-trash"></i></a> </div>
								</div>
							</div><div class="clearfix"></div><hr>`);
						});
						$("#total-price").text("$"+response.total);
						$("#total-price").text("$"+response.total);
						$(".total-price .value").text(response.total);
					}
				});
			}
			CardMini();


			$('.add-wishlist').on('click', function (event) {
				event.preventDefault();
				var Id = $(this).data('id');
				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}'
					}
				});
				$.ajax({
					type: "POST",
					url: "{{route('store.wishlist', '')}}/"+Id,
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
								title:response.title,
								icon: 'success',
							});
						}else{
							Tost.fire({
								type:'error',
								title:response.title,
								icon: 'error',
							});
						}
					}
				});
			});
		})(jQuery);
	</script>
	@stack('script')
</body>
</html>