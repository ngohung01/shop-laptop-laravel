@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Người dùng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('admin.nguoidung.them') }}" class="btn btn-info"><i class="fal fa-plus"></i> Thêm mới</a></p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr align='center'>
						<th width="5%">#</th>
						<th width="20%">Họ và tên</th>
						<th width="20%">Tên đăng nhập</th>
						<th width="25%">Email</th>
						<th width="10%">Quyền hạn</th>
						<th width="5%">Sửa</th>
						<th width="20%">Sửa trạng thái</th>
					</tr>
				</thead>
				<tbody>
					@foreach($nguoidung as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->username }}</td>
							<td>{{ $value->email }}</td>
							<td>{{ $value->role }}</td>
							<td class="text-center"><a href="{{ route('admin.nguoidung.sua', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
							{{-- <td class="text-center"><a href="{{ route('admin.nguoidung.xoa', ['id' => $value->id]) }}"
								 onclick = 'return confirm("Bạn có chắn chắn muốn xoá {{$value->username}} này ?")'><i class="fal fa-trash-alt text-danger"></i></a></td> --}}
							<td>
								{!!$value->deleted_at ?
									('<a href="'.route('admin.nguoidung.xoa',['id'=>$value->id]).'" 
									  class="btn btn-danger" style="color:aliceblue;width:100%" 
									  onclick = "return confirm(\'Bạn có chắn chắn muốn (Mở Khoá) tài khoản của '.$value->username.' không ?\')">Bị Khoá</a>
									  ')
									:
									('<a href="'.route('admin.nguoidung.xoa',['id'=>$value->id]).'" 
										class="btn btn-primary" style="color:aliceblue;width:100%" 
										onclick = "return confirm(\'Bạn có chắn chắn muốn (Khoá) tài khoản của '.$value->username.' không ?\')">Kích hoạt</a>
									 ')					
								!!}
							</td>	 
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
<script>
	function handleActive(e)
    {
       return confirm('Bạn có muốn ?');
    }
</script>