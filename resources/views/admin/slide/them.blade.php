@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Thêm slide</div>
		<div class="card-body">
			<form action="{{ route('admin.slide.them') }}" method="post" enctype="multipart/form-data">
				@csrf
				
				<div class="mb-3">
					<label class="form-label" for="tenslide">Tên slide</label>
					<input type="text" class="form-control @error('tenslide') is-invalid @enderror" id="tenslide" name="tenslide" value="{{ old('tenslide') }}" required />
					@error('tenslide')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="mb-3">
					<label class="form-label" for="link">Link</label>
					<input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('tenslide') }}" required />
					@error('link')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				
				<div class="mb-3">
					<label class="form-label" for="hinhanh">Hình ảnh</label>
					<input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" />
					@error('hinhanh')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="d-flex justify-content-between">
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thêm vào CSDL</button>
					<a href="{{route('admin.slide')}}" class="btn btn-primary">Quay lại</a>
				</div>
			</form>
		</div>
	</div>
@endsection