@extends('layouts.admin')

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
					@foreach($tam as $value)
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
@endsection
