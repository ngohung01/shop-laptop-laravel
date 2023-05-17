@extends('layouts.frontend')

@section('title', 'Giỏ hàng')

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>Giỏ hàng</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">Giỏ hàng</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="text-center order_complete">
							<i class="fal fa-shopping-cart"></i>
							<div class="heading_s1">
								<h3>Giỏ hàng chưa có sản phẩm!</h3>
							</div>
							<p>Giỏ hàng của bạn đang rỗng, xin hãy lấp đầy nó bằng việc duyệt qua các sản phẩm của cửa hàng và bỏ vào giỏ các sản phẩm mà bạn yêu thích và có ý định sẽ sở hữu nó.</p>
							<a href="{{ route('frontend') }}" class="btn btn-fill-out">TIẾP TỤC MUA SẮM</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection