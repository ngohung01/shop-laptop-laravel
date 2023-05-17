@extends('layouts.frontend')

@section('title', 'Đặt hàng thành công')

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>Đặt hàng thành công</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">Đặt hàng thành công</li>
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
							<i class="fal fa-check-circle"></i>
							<div class="heading_s1">
								<h3>Bạn đã đặt hàng thành công!</h3>
							</div>
							<p>Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đang được xử lý và sẽ hoàn thành trong vòng 3-6 giờ. Bạn sẽ nhận được một email xác nhận khi đơn đặt hàng của bạn được hoàn thành.</p>
							<a href="{{ route('frontend') }}" class="btn btn-fill-out">TIẾP TỤC MUA SẮM</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection