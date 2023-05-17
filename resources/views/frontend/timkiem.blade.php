@extends('layouts.frontend')

@section('title', $tenloai ?? 'Sản phẩm')

@section('content')
	
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			@foreach($slide as $value)
			<div class="carousel-item active"data-bs-interval="4000">
				<img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" class="d-block w-100" alt="..." height="200px"width="600px">
    		</div>
			@endforeach
		</div>
	</div>
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>{{ $tenloai ?? 'Sản phẩm' }}</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">{{ $tenloai ?? 'Sản phẩm' }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="row align-items-center mb-4 pb-1">
							<div class="col-12">
								<div class="product_header">
									<div class="product_header_left">
										<div class="custom_select">
											<form action="{{ route('frontend.sanpham') }}" method="post">
												@csrf
												@if(isset($tenloai))
													<input type="hidden" id="tenloai_slug" name="tenloai_slug" value="{{ Str::slug($tenloai, '-') }}" />
												@endif
												<select class="form-control form-control-sm" id="sapxep" name="sapxep" onchange="if(this.value != 0) { this.form.submit(); }">
													<option value="default" {{ session('sapxep') == 'default' ? 'selected' : '' }}>Sắp xếp mặc định</option>
													<option value="popularity" {{ session('sapxep') == 'popularity' ? 'selected' : '' }}>Mua nhiều nhất</option>
													<option value="date" {{ session('sapxep') == 'date' ? 'selected' : '' }}>Hàng mới nhất</option>
													<option value="price" {{ session('sapxep') == 'price' ? 'selected' : '' }}>Xếp theo giá: thấp đến cao</option>
													<option value="price-desc" {{ session('sapxep') == 'price-desc' ? 'selected' : '' }}>Xếp theo giá: cao xuống thấp</option>
												</select>
											</form>
										</div>
									</div>
									<div class="product_header_right">
										<div class="products_view">
											<a href="javascript:void(0);" class="shorting_icon grid"><i class="ti-view-grid"></i></a>
											<a href="javascript:void(0);" class="shorting_icon list active"><i class="ti-layout-list-thumb"></i></a>
										</div>
										<div class="custom_select">
											<select class="form-control form-control-sm">
												<option value="">Hiển thị</option>
												<option value="9">9</option>
												<option value="12">12</option>
												<option value="18">18</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<ul class="pagination mt-3 justify-content-center pagination_style1">
								{{ $tam->links() }}
								</ul>
							</div>
						</div>
						<div class="row shop_container list">
							@foreach($tam as $value)
								<div class="col-lg-3 col-md-4 col-6">
									<div class="product">
										<span class="pr_flash bg-success">Khuyến mãi</span>
										<div class="product_img">
											<a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $value->LoaiSanPham->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">
												<img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" />
											</a>
											<div class="product_action_box">
												<ul class="list_none pr_action_btn">
													<li class="add-to-cart"><a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $value->tensanpham_slug]) }}"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="product_info">
											<h6 class="product_title">
												<a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $value->LoaiSanPham->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">{{ $value->tensanpham }}</a>
											</h6>
											<div class="product_price">
												<span class="price">{{ number_format($value->dongia) }}<sup>đ</sup></span>
												<del>{{ number_format($value->dongia * 1.1) }}<sup>đ</sup></del>
												<div class="on_sale">
													<span>Giảm giá 10%</span>
												</div>
											</div>
											<div class="rating_wrap">
												<div class="rating">
													<div class="product_rate" style="width:80%"></div>
												</div>
												<span class="rating_num">Số Lượng còn {{$value->soluong}}</span>
											</div>
											<div class="pr_desc">
												<p>Mô tả ngắn gọn về sản phẩm {{ $value->tensanpham }}.</p>
											</div>
											<div class="pr_switch_wrap">
												<div class="product_color_switch">
													<span class="active" data-color="#87554B"></span>
													<span data-color="#333333"></span>
													<span data-color="#DA323F"></span>
												</div>
											</div>
											<div class="list_product_action_box">
												<ul class="list_none pr_action_btn">
													<li class="add-to-cart"><a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $value->tensanpham_slug]) }}"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
						<div class="row">
							<div class="col-12">
								<ul class="pagination mt-3 justify-content-center pagination_style1">
								{{ $tam->links() }}
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
