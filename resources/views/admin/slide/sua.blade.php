@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Sửa slide</div>
		<div class="card-body">
			<form action="{{ route('admin.slide.sua', ['id' => $slide->id]) }}" method="post" enctype="multipart/form-data">
				@csrf
				
				<div class="mb-3">
					<label class="form-label" for="tenslide">Tên slide</label>
					<input type="text" class="form-control @error('tenslide') is-invalid @enderror" id="tenslide" name="tenslide" value="{{ $slide->tenslide }}" required />
					@error('tenslide')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="link">Link</label>
					<input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ $slide->link }}" required />
					@error('link')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				
				<div class="mb-3">
					<label class="form-label" for="hinhanh">Hình ảnh</label>
					@if(!empty($slide->hinhanh))
						<img class="d-block rounded img-thumbnail" src="{{ env('APP_URL') . '/storage/app/' . $slide->hinhanh }}" width="100" />
						<span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
					@endif
					<input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
					@error('hinhanh')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="d-flex justify-content-between">
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật</button>
					<a href="{{route('admin.slide')}}" class="btn btn-primary">Quay lại</a>
				</div>
			</form>
		</div>
	</div>
@endsection