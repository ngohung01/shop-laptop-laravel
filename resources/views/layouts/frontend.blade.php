<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta content="INDEX,FOLLOW" name="robots" />
	<link rel="canonical" href="{{$url_canonical}}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<meta property="og:url"           content="{{$url_canonical}}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="hihihihihihihi" />
	<meta property="og:description"   content="hahahahahaha" />
	<meta property="og:image"         content="" />
	
	<title>@yield('title', 'Trang chủ') - {{ config('app.name', 'Laravel') }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/animate.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/ionicons.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/themify-icons.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/linearicons.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/flaticon.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/simple-line-icons.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/owlcarousel/css/owl.carousel.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/owlcarousel/css/owl.theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/owlcarousel/css/owl.theme.default.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/magnific-popup.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/slick.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/slick-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body>
	<!-- <div class="preloader">
		<div class="lds-ellipsis">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div> -->

	
	<header class="header_wrap fixed-top header_with_topbar" style="background-color:yellow">
		<div class="bottom_header dark_skin main_menu_uppercase">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="{{ route('frontend') }}">
					{{-- <img src="{{ asset('public/assets/images/logo.png') }}"> --}}
						<b style="font-size: 2rem"> Kibar Shop </b> 
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
						<span class="ion-android-menu"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
						<ul class="navbar-nav">
							<li><a class="nav-link nav_item" href="{{ route('frontend') }}">Trang chủ</a></li>
							<li class="dropdown">
								<a class="nav-link dropdown-toggle" href="{{ route('frontend.sanpham') }}" data-toggle="dropdown">Sản phẩm</a>
								<div class="dropdown-menu">
									<ul>
										@foreach($navbarlsp as $value)
											<li><a class="dropdown-item nav-link nav_item" href="{{ route('frontend.sanpham.danhmuc', ['tenloai_slug' => $value->tenloai_slug]) }}">{{$value->tenloai}}</a></li>
										@endforeach
									</ul>
								</div>
							</li>
							<li class="dropdown">
								<a class="nav-link dropdown-toggle" href="{{ route('frontend.sanpham') }}" data-toggle="dropdown">Hãng Sản Xuất</a>
								<div class="dropdown-menu">
									<ul>
										@foreach($navbarhsx as $value)
											<li align='center'><a class="dropdown-item nav-link nav_item" href="{{ route('frontend.sanpham.hang', ['tenhang_slug' => $value->tenhang_slug]) }}"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" width="80" class="img-thumbnail" /></a></li>
										@endforeach
									</ul>
								</div>
							</li>
							<li><a class="nav-link nav_item" href="{{ route('frontend.lienhe') }}">Liên hệ</a></li>
						</ul>
					</div>
					<ul class="navbar-nav attr-nav align-items-center">
						<li>
							<a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>
							<div class="search_wrap">
								<span class="close-search"><i class="ion-ios-close-empty"></i></span>
								<form action="{{route('frontend.timkiem')}}" method="get">
									<input type="hidden" name="hl" id="hl" value="vi" />
									<input type="text" placeholder="Tên sản phẩm cần tìm ?" class="form-control" id="search_input" name="timkiem" />
									<button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
								</form>
							</div>
							<div class="search_overlay"></div>
						</li>
						@if(Auth::check()=='')
						<li><a href="{{ route('user') }}" class="nav-link"><i class="linearicons-user"></i></a></li>
						@else
						<li><a href="{{ route('user') }}" class="nav-link">{{Auth::user()->name}}</a></li>
						@endif
						<li class="dropdown cart_dropdown">
							<a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">{{ Cart::count() ?? 0 }}</span></a>
							@if(Cart::count())
								<div class="cart_box dropdown-menu dropdown-menu-right">
									<ul class="cart_list">
										@foreach(Cart::content() as $value)
											<li>
												<a href="{{ route('frontend.giohang.xoa', ['row_id' => $value->rowId]) }}" class="item_remove"><i class="ion-close"></i></a>
												<a href="#"><img src="{{ env('APP_URL') . '/storage/app/' . $value->options->image }}" />{{ $value->name }}</a>
												<span class="cart_quantity"> {{ $value->qty }} x <span class="cart_amount">{{ number_format($value->price) }}</span><sup>đ</sup></span>
											</li>
										@endforeach
									</ul>
									<div class="cart_footer">
										<p class="cart_total"><strong>Tổng tiền sản phẩm:</strong> <span class="cart_price">{{ Cart::priceTotal() }}</span><sup>đ</sup></p>
										<p class="cart_buttons">
											<a href="{{ route('frontend.giohang') }}" class="btn btn-fill-line view-cart">GIỎ HÀNG</a>
											<a href="{{ route('frontend.dathang') }}" class="btn btn-fill-out checkout">THANH TOÁN</a>
										</p>
									</div>
								</div>
							@endif
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	
	{{-- Content --}}
	@yield('content')
	
	{{-- Footer --}}
	<footer class="footer_dark">
		<div class="footer_top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="widget">
							<div class="footer_logo">
							{{-- <img class="" src="{{ asset('public/assets/images/Sang shop.png') }}" /> --}}
							     <b style="font-size: 2rem ; color:#fff">Kibar Shop</b>
							</div>
							<p>Công ty trách nhiệm hữu hạn một thành viên </p>
						</div>
						<div class="widget">
							<ul class="social_icons social_white">
								<li><a href="https://www.facebook.com/profile.php?id=100091912221646"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
								<li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-sm-6">
						<div class="widget">
							<h6 class="widget_title">Useful links</h6>
							<ul class="widget_links">
								<li><a href="#">About Us</a></li>
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Location</a></li>
								<li><a href="#">Affiliates</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-sm-6">
						<div class="widget">
							<h6 class="widget_title">Category</h6>
							<ul class="widget_links">
								<li><a href="http://hung.com:2001/ShopSmartphone/san-pham/dien-thoai">Điện thoại</a></li>
								<li><a href="http://hung.com:2001/ShopSmartphone/san-pham/may-tinh-bang">Máy tính bảng</a></li>
								<li><a href="http://hung.com:2001/ShopSmartphone/san-pham/may-tinh-xach-tay">Máy tính xách tay</a></li>
								<li><a href="http://hung.com:2001/ShopSmartphone/san-pham/phu-kien">Phụ kiện</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="widget">
							<h6 class="widget_title">Khách hàng</h6>
							<ul class="widget_links">
								<li><a href="#"></a></li>
								<li><a href="#"></a></li>
								<li><a href="http://hung.com:2001/ShopSmartphone/khach-hang">Tài khoản của tôi</a></li>
								<li><a href="http://hung.com:2001/ShopSmartphone/khach-hang">Lịch sử đơn hàng</a></li>
								<li><a href="#"></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="widget">
							<h6 class="widget_title">Contact info</h6>
							<ul class="contact_info contact_info_light">
								<li>
									<i class="ti-location-pin"></i>
									<p>2-28 Ng. 678 Đ. La Thành, Giảng Võ, Ba Đình, Hà Nội, Việt Nam</p>
								</li>
								<li>
									<i class="ti-email"></i>
									<a href="mailto:anhungbnn@gmail.com">anhungbnn@gmail.com</a>
								</li>
								<li>
									<i class="ti-mobile"></i>
									<a href="tel:0339535682">+84 0339535682</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom_footer border-top-tran">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p class="mb-md-0 text-center text-md-left">Copyright © 2023 {{ config('app.name', 'Laravel') }}.</p>
					</div>
					<div class="col-md-6">
						<ul class="footer_payment text-center text-lg-right">
							<li><a href="#"><img src="{{ asset('public/assets/images/visa.png') }}" alt="visa" /></a></li>
							<li><a href="#"><img src="{{ asset('public/assets/images/discover.png') }}" alt="discover" /></a></li>
							<li><a href="#"><img src="{{ asset('public/assets/images/master_card.png') }}" alt="master_card" /></a></li>
							<li><a href="#"><img src="{{ asset('public/assets/images/paypal.png') }}" alt="paypal" /></a></li>
							<li><a href="#"><img src="{{ asset('public/assets/images/amarican_express.png') }}" alt="amarican_express" /></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<a href="#" class="scrollup" style="display:none;"><i class="ion-ios-arrow-up"></i></a>
	
	<script src="{{ asset('public/assets/js/jquery-1.12.4.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery-ui.js') }}"></script>
	<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/magnific-popup.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/parallax.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/hoverparallax.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.countTo.js') }}"></script>
	<script src="{{ asset('public/assets/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/isotope.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.appear.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.parallax-scroll.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.dd.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.elevatezoom.js') }}"></script>
	@yield('javascript')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>	
	<script src="{{ asset('public/assets/js/scripts.js') }}"></script>
	<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
	{!! Toastr::message() !!}
	<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "110493088699237");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v16.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
	<!-- Nút like và chia sẻ -->
	<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=682465823330214&autoLogAppEvents=1" nonce="dSl6uaL3"></script>
</body>
</html>
