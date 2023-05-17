@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Trả lời</div>
		<div class="card-body">
			<form action="{{ route('admin.gopy.traloi', ['id' => $gy->id]) }}" method="post" enctype="multipart/form-data">
				@csrf
                <div class="mb-3">
				<input type="text" value="{{$gy->name}}" readonly class="form-control">
                </div>
                <div class="mb-3">
                <input type="text" value="{{$gy->email}}" readonly class="form-control">
                </div>
                <div class="mb-3">
                <input type="text" value="{{$gy->sodienthoai}}" readonly class="form-control">
                </div>
                <div class="mb-3">
                @if($gy->chude==1)
                <input type="text" value="Góp ý" readonly class="form-control">
                @else
                <input type="text" value="Lỗi" readonly class="form-control">
                @endif
                </div>
                <div class="mb-3">
                <textarea name="" id="" cols="30" rows="5" class="form-control" readonly>{{$gy->noidung}}</textarea>
                </div>
                <div class="mb-3">
                <textarea name="traloi" id="" cols="30" rows="10" class="form-control">{{$gy->phanhoi}}</textarea>
                </div>
				<div class="d-flex justify-content-between">
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i>Phản hồi</button>
					<a href="{{route('admin.gopy')}}" class="btn btn-primary">Quay lại</a>
				</div>
			</form>
		</div>
	</div>
@endsection