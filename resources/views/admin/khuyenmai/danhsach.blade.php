@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Khuyến mãi</div>
		<div class="card-body table-responsive">
			<p>
				<a href="{{ route('admin.khuyenmai.them') }}" class="btn btn-info"><i class="fal fa-plus"></i> Thêm mới</a>
			</p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Tên khuyến mãi</th>
						<th width="10%">Mã khuyến mãi</th>
						<th width="5%">Giảm giá</th>
						<th width="5%">Số lượng</th>
						<th width="5%">Ngày bắt đầu</th>
						<th width="5%">Ngày kết thúc</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($km as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->tenkhuyenmai }}</td>
							<td class="text-center">{{$value->makhuyenmai}}</td>
							<td>{{ $value->giamgia }}</td>
							<td>{{ $value->soluong }}</td>
							<td>{{ $value->ngaybatdau }}</td>
							<td>{{ $value->ngayketthuc }}</td>
							<td class="text-center"><a href="{{ route('admin.khuyenmai.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa mã khuyến mãi {{ $value->tenkhuyenmai }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection