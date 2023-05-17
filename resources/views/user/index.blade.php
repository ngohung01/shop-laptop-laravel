@extends('layouts.frontend')

@section('title', 'Quản lý tài khoản')

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>Quản lý tài khoản</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">Quản lý tài khoản</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="dashboard_menu">
							<ul class="nav nav-tabs flex-column" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Trang chủ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Đơn hàng của tôi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>Sổ địa chỉ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Thông tin tài khoản</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="" 
										onclick="
									 	event.preventDefault();
										document.getElementById('logout-form').submit();
									 ">
										<i class="ti-lock"></i> Đăng xuất
									</a>
									{{-- <a class="nav-link" style="cursor: pointer;" onclick="handleLogout(event)"><i class="ti-lock"></i>Đăng xuất</a> --}}
									<form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
										@csrf
									</form>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">
						<div class="tab-content dashboard_content">
							<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
								<div class="card">
									<div class="card-header">
										<h5>Trang chủ khách hàng</h5>
									</div>
									<div class="card-body">
										<p class="text-center"><img src="{{ asset('public/assets/images/consumer.png') }}" /></p>
										<p>Xin chào khách hàng {{ Auth::user()->name }}.</p>
										<p class="text-justify">Từ trang chủ khách hàng, bạn có thể dễ dàng kiểm tra và xem các <a href="javascript:void(0);" onclick="$('#orders-tab').trigger('click')">đơn hàng</a> của mình, quản lý <a href="javascript:void(0);" onclick="$('#address-tab').trigger('click')">sổ địa chỉ</a> giao hàng và thanh toán và chỉnh sửa thông tin <a href="javascript:void(0);" onclick="$('#account-detail-tab').trigger('click')">hồ sơ cá nhân.</a></p>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
								<div class="card mh-100 overflow-auto" style="height:500px">
									{{-- <div class="card-header">
										<h5>Đơn hàng của tôi</h5>
									</div> --}}
									<div class="card-body">
										{{-- <div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th width="10%">#</th>
														<th>Ngày đặt hàng</th>
														<th>Trạng thái</th>
														<th width="10%">Chi tiết</th>
													</tr>
												</thead>
												<tbody>
													@if (!empty($donhang))
														@foreach($donhang as $value)
														<tr>
															<td>{{ $value->id}}</td>
															<td>{{$value->created_at}}</td>
															<td>{{$value->tinhtrang->tinhtrang}}</td>
															<td><a href="{{route('user.donhang.chitiet',['id'=>$value->id])}}" class="btn btn-fill-out btn-sm">Chi tiết</a></td>
														</tr>
														@endforeach
													@else
													@endif
													
												</tbody>
											</table>
										</div> --}}
										<ul class="nav nav-pills mb-3 d-flex justify-content-between" id="pills-tab" role="tablist">
											<li class="nav-item" role="presentation">
											  <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">Tất cả</button>
											</li>
											<li class="nav-item" role="presentation">
											  <button class="nav-link" id="pills-waitConfirm-tab" data-bs-toggle="pill" data-bs-target="#pills-waitConfirm" type="button" role="tab" aria-controls="pills-waitConfirm" aria-selected="false">Đang hàng mới</button>
											</li>
											<li class="nav-item" role="presentation">
											  <button class="nav-link" id="pills-transport-tab" data-bs-toggle="pill" data-bs-target="#pills-transport" type="button" role="tab" aria-controls="pills-transport" aria-selected="false">Đang chuyển giao</button>
											</li>
											<li class="nav-item" role="presentation">
												<button class="nav-link" id="pills-delivered-tab" data-bs-toggle="pill" data-bs-target="#pills-delivered" type="button" role="tab" aria-controls="pills-delivered" aria-selected="false">Đã giao</button>
											</li>
											<li class="nav-item" role="presentation">
												<button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel" aria-selected="false">Huỷ bỏ</button>
											</li>
										  </ul>
										  <div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
												{{-- Tất cả --}}
												@if (!empty($donhang))
													@foreach ($donhang as $item)
														<div class="card text-left ">
															@php
																$tongtien =0;
															@endphp
															<div class="card-header d-flex justify-content-between align-items-center">
																<div class="card-header-content">
																	<p>Số điện thoại : {{$item->dienthoaigiaohang}}</p>
																	<p>Địa chỉ giao hàng : {{$item->diachigiaohang}}</p>
																	<p>Ngày đặt : {{$item->created_at->format('d/m/Y')}}</p>
																</div>
																<div class="card-header-status text-uppercase" style="color: rgb(232, 158, 68)">
																	{{$item->tinhtrang->tinhtrang}}
																</div>
															</div>
															<div class="card-body overflow-auto" style="max-height:250px">
																@foreach ($item->donhang_chitiet as $donhangchitiet)
																	<div class="d-flex justify-content-between align-items-center">
																		<img src="{{ env('APP_URL'). '/storage/app/'. $donhangchitiet->sanpham->hinhanh}}" alt="Ảnh" width="100" height="100" class="card-body-img">
																		<div class="card-body-content w-75 ">
																			<p class="mb-0">{{$donhangchitiet->sanpham->tensanpham}}</p>
																			<p class="mb-0">x{{$donhangchitiet->soluongban}}</p>
																		</div>
																		<div class="card-body-price" style="color: rgb(232, 158, 68)">
																			{{$donhangchitiet->dongiaban}} <sup>đ</sup>
																		</div>
																	</div>
																	@php
																		$tongtien += $donhangchitiet->dongiaban * $donhangchitiet->soluongban;
																	@endphp
																@endforeach
															</div>
															<hr>
															<div class="taxVat d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																@php
																	$tax = $tongtien *0.1;
																@endphp
																 <p>Thuế (VAT 10%) :</p>
																 <p style="color: rgb(232, 158, 68)">{{$tax}} <sup>đ</sup></p>
															</div>
															@if ($item->tinhtrang->id == 1)
																<div class="card-footer text-muted d-flex justify-content-between align-items-center">
																	<a href="#" class="btn btn-primary" 
																	   onclick="
																	   event.preventDefault();
																	   $check = confirm('Bạn có chắc chắn muốn huỷ đơn hàng này ?');
																	   if($check){
																		 document.getElementById('form-huydon-{{$item->id}}').submit();
																	   }
																	   "
																	   >Huỷ đơn hàng</a>
																	<p >Tổng tiền : <span style="color: rgb(232, 158, 68)">{{$tongtien+$tax}} <sup>đ</sup> </span>  </p>
																</div>
																<form action="{{route('user.donhang',['id'=>$item->id])}}" method="post" id="form-huydon-{{$item->id}}">@csrf</form>
															@else
																<div class="total-price d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																	<p>Tổng tiền :</p>
																	<p style="color: rgb(232, 158, 68)">{{$tongtien + $tax}} <sup>đ</sup></p>
																</div>
															@endif
														</div>
														<hr style="border:1px solid #04873184" />
													@endforeach
												@else
													<div class="container">Bạn chưa có đơn hàng nào . <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
												@endif
											</div>
											<div class="tab-pane fade" id="pills-waitConfirm" role="tabpanel" aria-labelledby="pills-waitConfirm-tab">
													{{-- Đơn hàng mới --}}
													@if (!empty($donhang))
															@php
																$donhangmoi = false;
															@endphp
														@foreach ($donhang as $item)
															@if ($item->tinhtrang_id == 1)
																@php
																	$donhangmoi = true;
																@endphp
																<div class="card text-left ">
																	@php
																		$tongtien =0;
																	@endphp
																	<div class="card-header d-flex justify-content-between align-items-center">
																		<div class="card-header-content">
																			<p>Số điện thoại : {{$item->dienthoaigiaohang}}</p>
																			<p>Địa chỉ giao hàng : {{$item->diachigiaohang}}</p>
																			<p>Ngày đặt : {{$item->created_at->format('d/m/Y')}}</p>
																		</div>
																		<div class="card-header-status text-uppercase" style="color: rgb(232, 158, 68)">
																			{{$item->tinhtrang->tinhtrang}}
																		</div>
																	</div>
																	<div class="card-body overflow-auto" style="max-height:250px">
																		@foreach ($item->donhang_chitiet as $donhangchitiet)
																			<div class="d-flex justify-content-between align-items-center">
																				<img src="{{ env('APP_URL'). '/storage/app/'. $donhangchitiet->sanpham->hinhanh}}" alt="Ảnh" width="100" height="100" class="card-body-img">
																				<div class="card-body-content w-75 ">
																					<p class="mb-0">{{$donhangchitiet->sanpham->tensanpham}}</p>
																					<p class="mb-0">x{{$donhangchitiet->soluongban}}</p>
																				</div>
																				<div class="card-body-price" style="color: rgb(232, 158, 68)">
																					{{$donhangchitiet->dongiaban}} <sup>đ</sup>
																				</div>
																			</div>
																			@php
																				$tongtien += $donhangchitiet->dongiaban * $donhangchitiet->soluongban;
																			@endphp
																		@endforeach
																	</div>
																	<hr>
																	<div class="taxVat d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																		@php
																			$tax = $tongtien *0.1;
																		@endphp
																		<p>Thuế (VAT 10%) :</p>
																		<p style="color: rgb(232, 158, 68)">{{$tax}} <sup>đ</sup></p>
																	</div>
																		<div class="card-footer text-muted d-flex justify-content-between align-items-center">
																			<a href="#" class="btn btn-primary" 
																			onclick="
																			event.preventDefault();
																			$check = confirm('Bạn có chắc chắn muốn huỷ đơn hàng này ?');
																			if($check){
																				document.getElementById('form-huydon-{{$item->id}}').submit();
																			}
																			"
																			>Huỷ đơn hàng</a>
																			<p >Tổng tiền : <span style="color: rgb(232, 158, 68)">{{$tongtien+$tax}} <sup>đ</sup> </span>  </p>
																		</div>
																		<form action="{{route('user.donhang',['id'=>$item->id])}}" method="post" id="form-huydon-{{$item->id}}">@csrf</form>
																</div>
																<hr style="border:1px solid #04873184" />
															@endif
														@endforeach
														@if ($donhangmoi == false)
															<div class="container">Bạn chưa có đơn hàng mới nào . <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
														@endif
													@else
														<div class="container">Bạn chưa có đơn hàng nào . <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
													@endif
											</div>
											<div class="tab-pane fade" id="pills-transport" role="tabpanel" aria-labelledby="pills-transport-tab">
													{{-- Đơn chuyển giao --}}
													@if (!empty($donhang))
														@php
															$donhangdanggiao = false;
														@endphp
													@foreach ($donhang as $item)
														@if ($item->tinhtrang_id == 3)
															@php
																$donhangdanggiao = true;
															@endphp
															<div class="card text-left ">
																@php
																	$tongtien =0;
																@endphp
																<div class="card-header d-flex justify-content-between align-items-center">
																	<div class="card-header-content">
																		<p>Số điện thoại : {{$item->dienthoaigiaohang}}</p>
																		<p>Địa chỉ giao hàng : {{$item->diachigiaohang}}</p>
																		<p>Ngày đặt : {{$item->created_at->format('d/m/Y')}}</p>
																	</div>
																	<div class="card-header-status text-uppercase" style="color: rgb(232, 158, 68)">
																		{{$item->tinhtrang->tinhtrang}}
																	</div>
																</div>
																<div class="card-body overflow-auto" style="max-height:250px">
																	@foreach ($item->donhang_chitiet as $donhangchitiet)
																		<div class="d-flex justify-content-between align-items-center">
																			<img src="{{ env('APP_URL'). '/storage/app/'. $donhangchitiet->sanpham->hinhanh}}" alt="Ảnh" width="100" height="100" class="card-body-img">
																			<div class="card-body-content w-75 ">
																				<p class="mb-0">{{$donhangchitiet->sanpham->tensanpham}}</p>
																				<p class="mb-0">x{{$donhangchitiet->soluongban}}</p>
																			</div>
																			<div class="card-body-price" style="color: rgb(232, 158, 68)">
																				{{$donhangchitiet->dongiaban}} <sup>đ</sup>
																			</div>
																		</div>
																		@php
																			$tongtien += $donhangchitiet->dongiaban * $donhangchitiet->soluongban;
																		@endphp
																	@endforeach
																</div>
																<hr>
																<div class="taxVat d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																	@php
																		$tax = $tongtien *0.1;
																	@endphp
																	<p>Thuế (VAT 10%) :</p>
																	<p style="color: rgb(232, 158, 68)">{{$tax}} <sup>đ</sup></p>
																</div>
																<div class="total-price d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																	<p>Tổng tiền :</p>
																	<p style="color: rgb(232, 158, 68)">{{$tongtien + $tax}} <sup>đ</sup></p>
																</div>
															</div>
															<hr style="border:1px solid #04873184" />
														@endif
													@endforeach
													@if ($donhangdanggiao == false)
														<div class="container text-center">Bạn chưa có đơn hàng nào đang được giao. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
													@endif
												@else
													<div class="container">Bạn chưa có đơn hàng nào. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
												@endif
											</div>
											<div class="tab-pane fade" id="pills-delivered" role="tabpanel" aria-labelledby="pills-delivered-tab">
													{{-- Đơn đã giao --}}
													@if (!empty($donhang))
														@php
															$donhangdagiao = false;
														@endphp
														@foreach ($donhang as $item)
															@if ($item->tinhtrang_id == 8)
																@php
																	$donhangdagiao = true;
																@endphp
																<div class="card text-left ">
																	@php
																		$tongtien =0;
																	@endphp
																	<div class="card-header d-flex justify-content-between align-items-center">
																		<div class="card-header-content">
																			<p>Số điện thoại : {{$item->dienthoaigiaohang}}</p>
																			<p>Địa chỉ giao hàng : {{$item->diachigiaohang}}</p>
																			<p>Ngày đặt : {{$item->created_at->format('d/m/Y')}}</p>
																		</div>
																		<div class="card-header-status text-uppercase" style="color: rgb(232, 158, 68)">
																			{{$item->tinhtrang->tinhtrang}}
																		</div>
																	</div>
																	<div class="card-body overflow-auto" style="max-height:250px">
																		@foreach ($item->donhang_chitiet as $donhangchitiet)
																			<div class="d-flex justify-content-between align-items-center">
																				<img src="{{ env('APP_URL'). '/storage/app/'. $donhangchitiet->sanpham->hinhanh}}" alt="Ảnh" width="100" height="100" class="card-body-img">
																				<div class="card-body-content w-75 ">
																					<p class="mb-0">{{$donhangchitiet->sanpham->tensanpham}}</p>
																					<p class="mb-0">x{{$donhangchitiet->soluongban}}</p>
																				</div>
																				<div class="card-body-price" style="color: rgb(232, 158, 68)">
																					{{$donhangchitiet->dongiaban}} <sup>đ</sup>
																				</div>
																			</div>
																			@php
																				$tongtien += $donhangchitiet->dongiaban * $donhangchitiet->soluongban;
																			@endphp
																		@endforeach
																	</div>
																	<hr>
																	<div class="taxVat d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																		@php
																			$tax = $tongtien *0.1;
																		@endphp
																		<p>Thuế (VAT 10%) :</p>
																		<p style="color: rgb(232, 158, 68)">{{$tax}} <sup>đ</sup></p>
																	</div>
																		<div class="total-price d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																			<p>Tổng tiền :</p>
																			<p style="color: rgb(232, 158, 68)">{{$tongtien + $tax}} <sup>đ</sup></p>
																		</div>
																</div>
																<hr style="border:1px solid #04873184" />
															@endif
														@endforeach
															@if ($donhangdagiao == false)
																<div class="container text-center">Bạn chưa có đơn hàng nào đã được giao. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
															@endif
													@else
														<div class="container">Bạn chưa có đơn hàng nào. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
													@endif
											</div>
											<div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
													{{-- Đơn đã huỷ --}}
													@if (!empty($donhang))
														@php
															$dondahuy = false;
														@endphp
														@foreach ($donhang as $item)
															@if ($item->tinhtrang_id == 5)
																@php
																	$dondahuy = true;
																@endphp
																<div class="card text-left ">
																	@php
																		$tongtien =0;
																	@endphp
																	<div class="card-header d-flex justify-content-between align-items-center">
																		<div class="card-header-content">
																			<p>Số điện thoại : {{$item->dienthoaigiaohang}}</p>
																			<p>Địa chỉ giao hàng : {{$item->diachigiaohang}}</p>
																			<p>Ngày đặt : {{$item->created_at->format('d/m/Y')}}</p>
																		</div>
																		<div class="card-header-status text-uppercase" style="color: rgb(232, 158, 68)">
																			{{$item->tinhtrang->tinhtrang}}
																		</div>
																	</div>
																	<div class="card-body overflow-auto" style="max-height:250px">
																		@foreach ($item->donhang_chitiet as $donhangchitiet)
																			<div class="d-flex justify-content-between align-items-center">
																				<img src="{{ env('APP_URL'). '/storage/app/'. $donhangchitiet->sanpham->hinhanh}}" alt="Ảnh" width="100" height="100" class="card-body-img">
																				<div class="card-body-content w-75 ">
																					<p class="mb-0">{{$donhangchitiet->sanpham->tensanpham}}</p>
																					<p class="mb-0">x{{$donhangchitiet->soluongban}}</p>
																				</div>
																				<div class="card-body-price" style="color: rgb(232, 158, 68)">
																					{{$donhangchitiet->dongiaban}} <sup>đ</sup>
																				</div>
																			</div>
																			@php
																				$tongtien += $donhangchitiet->dongiaban * $donhangchitiet->soluongban;
																			@endphp
																		@endforeach
																	</div>
																	<hr>
																	<div class="taxVat d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																		@php
																			$tax = $tongtien *0.1;
																		@endphp
																		<p>Thuế (VAT 10%) :</p>
																		<p style="color: rgb(232, 158, 68)">{{$tax}} <sup>đ</sup></p>
																	</div>
																	<div class="total-price d-flex justify-content-between align-items-center " style="padding: 0.75rem 1.25rem">
																		<p>Tổng tiền :</p>
																		<p style="color: rgb(232, 158, 68)">{{$tongtien + $tax}} <sup>đ</sup></p>
																	</div>
																</div>
																<hr style="border:1px solid #04873184" />
															@endif
														@endforeach
															@if ($dondahuy == false)
																<div class="container text-center">Bạn chưa huỷ đơn nào. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
															@endif
													@else
														<div class="container">Bạn chưa có đơn hàng nào. <a href="{{route('frontend')}}">Click vào đây để mua hàng</a> </div>
													@endif
											</div>
										  </div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
								<div class="row">
									<div class="col-lg-6">
										<div class="card">
											<div class="card-header">
												<h5>Nhà riêng</h5>
											</div>
											<div class="card-body">
												<address>
													{{ Auth::user()->name }}<br />
													122 Trần Hưng Đạo<br />
													Khóm Đông Thạnh A<br />
													Phường Mỹ Thạnh<br />
													Thành phố Long Xuyên<br /> 
													Tỉnh An Giang<br />
												</address>
												<a href="#" class="btn btn-fill-out">Chỉnh sửa</a>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="card">
											<div class="card-header">
												<h5>Cơ quan</h5>
											</div>
											<div class="card-body">
												<address>
													{{ Auth::user()->name }}<br />
													Đại học An Giang<br />
													18 Ung Văn Khiêm<br />
													Phường Đông Xuyên<br />
													Thành phố Long Xuyên<br /> 
													Tỉnh An Giang<br />
												</address>
												<a href="#" class="btn btn-fill-out">Chỉnh sửa</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
								<div class="card">
									<div class="card-header">
										<h5>Thông tin tài khoản</h5>
									</div>
									<div class="card-body">
										<form action="{{ route('user.capnhathoso') }}" method="post">
											@csrf
											<div class="form-group">
												<label>Họ và tên <span class="required">*</span></label>
												<input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" required />
												@error('name')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Địa chỉ Email <span class="required">*</span></label>
												<input class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}" required />
												@error('email')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Mật khẩu mới</label>
												<input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
												@error('password')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Xác nhận mật khẩu mới</label>
												<input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
												@error('password_confirmation')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											
											<button type="submit" class="btn btn-fill-out">Cập nhật thông tin</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

{{-- <script>
 function handleLogout(e){
	e.preventDefault();
	logout = confirm('Bạn chắc chắn có muốn thoát tài khoản ? ')
	if(logout){
		document.getElementById('logout-form').submit()
	} 

 }
</script> --}}
