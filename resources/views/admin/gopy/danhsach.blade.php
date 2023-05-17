@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Ý kiến khách hàng</div>
		<div class="card-body table-responsive">
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Họ và tên</th>
						<th width="20%">Email</th>
						<th width="15%">Số điện thoại</th>
						<th width="10%">Chủ đề</th>
						<th width="25%">Nội dung góp ý</th>
						<th width="30%">Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					@foreach($gy as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->email }}</td>
							<td>{{ $value->sodienthoai }}</td>
							<td>@if($value->chude==1)
								Góp ý
								@else
								Lỗi
								@endif
							</td>
							<td>{{ $value->noidung }}</td>
							<td>@if($value->phanhoi=='')
								Chưa trả lời <i class="fa-solid fa-x" style="color:red"></i>
								@else
								Đã trả lời <i class="fa-solid fa-check" style="color:green"></i>
								@endif
							</td>
							<td class="text-center"><a href="{{ route('admin.gopy.traloi', ['id' => $value->id]) }}"><i class="fa-thin fa-reply"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection