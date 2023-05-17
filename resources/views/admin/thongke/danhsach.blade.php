@extends('layouts.admin')
{{-- 
@section('content')
	<div class="card">
		<div class="card-header">Đơn hàng</div>
		<div class="card-body table-responsive">
		<form action="{{route('thongke')}}" method="get">
			Chọn ngày thống kê: <input type="date" name="ngay" required>
			<button class="btn btn-primary" type="submit">Lọc</button>
		</form>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Khách hàng</th>
						<th width="45%">Thông tin giao hàng</th>
						<th width="15%">Ngày đặt</th>
						<th width="10%">Tình trạng</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tk as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->User->name }}</td>
							<td>
								<span class="d-block">Điện thoại: <strong>{{ $value->dienthoaigiaohang }}</strong></span>
								<span class="d-block">Địa chỉ giao: <strong>{{ $value->diachigiaohang }}</strong></span>
								<span class="d-block">Sản phẩm:</span>
								<table class="table table-bordered table-hover table-sm mb-0">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th>Sản phẩm</th>
											<th width="5%">SL</th>
											<th width="15%">Đơn giá</th>
											<th width="20%">Thành tiền</th>
										</tr>
									</thead>
									<tbody>
										@php $tongtien = 0;$thue=0; $tongtienbandau=0;@endphp
										@foreach($value->DonHang_ChiTiet as $chitiet)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $chitiet->SanPham->tensanpham }}</td>
												<td>{{ $chitiet->soluongban }}</td>
												<td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
												<td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
											</tr>
											@php $thue += ($chitiet->soluongban * $chitiet->dongiaban)*0.1;
											$tongtienbandau +=$chitiet->soluongban * $chitiet->dongiaban;
											$tongtien =$tongtienbandau+$thue ;
											@endphp
										@endforeach
										<tr>
											<td colspan="4">Thuế (VAT 10%):</td>
											<td class="text-end"><strong>{{ number_format($thue) }}</strong><sup><u>đ</u></sup></td>
										</tr>
										<tr>
											<td colspan="4">Tổng tiền sản phẩm:</td>
											<td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
										</tr>
									</tbody>
								</table>
							</td>
							<td>{{ $value->created_at->format('d/m/Y') }}</td>
							<td>{{ $value->TinhTrang->tinhtrang }}</td>
							<td class="text-center"><a href="{{ route('admin.donhang.sua', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.donhang.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa đơn hàng của khách {{ $value->User->name }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection --}}


@section('content')
<div class="col-lg-6">
	<div class="card">
	  <div class="card-header border-0">
		<div class="d-flex justify-content-between">
		  <h3 class="card-title">Sales</h3>
		  <a href="javascript:void(0);">View Report</a>
		</div>
	  </div>
	  <div class="card-body">
		<div class="d-flex">
		  <p class="d-flex flex-column">
			<span class="text-bold text-lg">$18,230.00</span>
			<span>Sales Over Time</span>
		  </p>
		  <p class="ml-auto d-flex flex-column text-right">
			<span class="text-success">
			  <i class="fas fa-arrow-up"></i> 33.1%
			</span>
			<span class="text-muted">Since last month</span>
		  </p>
		</div>
		<!-- /.d-flex -->

		<div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
		  <canvas id="sales-chart" height="250" style="display: block; height: 200px; width: 572px;" width="715" class="chartjs-render-monitor"></canvas>
		</div>

		<div class="d-flex flex-row justify-content-end">
		  <span class="mr-2">
			<i class="fas fa-square text-primary"></i> This year
		  </span>

		  <span>
			<i class="fas fa-square text-gray"></i> Last year
		  </span>
		</div>
	  </div>
	</div>
	<!-- /.card -->

	<div class="card">
	  <div class="card-header border-0">
		<h3 class="card-title">Online Store Overview</h3>
		<div class="card-tools">
		  <a href="#" class="btn btn-sm btn-tool">
			<i class="fas fa-download"></i>
		  </a>
		  <a href="#" class="btn btn-sm btn-tool">
			<i class="fas fa-bars"></i>
		  </a>
		</div>
	  </div>
	  <div class="card-body">
		<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
		  <p class="text-success text-xl">
			<i class="ion ion-ios-refresh-empty"></i>
		  </p>
		  <p class="d-flex flex-column text-right">
			<span class="font-weight-bold">
			  <i class="ion ion-android-arrow-up text-success"></i> 12%
			</span>
			<span class="text-muted">CONVERSION RATE</span>
		  </p>
		</div>
		<!-- /.d-flex -->
		<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
		  <p class="text-warning text-xl">
			<i class="ion ion-ios-cart-outline"></i>
		  </p>
		  <p class="d-flex flex-column text-right">
			<span class="font-weight-bold">
			  <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
			</span>
			<span class="text-muted">SALES RATE</span>
		  </p>
		</div>
		<!-- /.d-flex -->
		<div class="d-flex justify-content-between align-items-center mb-0">
		  <p class="text-danger text-xl">
			<i class="ion ion-ios-people-outline"></i>
		  </p>
		  <p class="d-flex flex-column text-right">
			<span class="font-weight-bold">
			  <i class="ion ion-android-arrow-down text-danger"></i> 1%
			</span>
			<span class="text-muted">REGISTRATION RATE</span>
		  </p>
		</div>
		<!-- /.d-flex -->
	  </div>
	</div>
  </div>
@endsection