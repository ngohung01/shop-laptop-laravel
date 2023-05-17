@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Sửa tình trạng</div>
		<div class="card-body">
			<form action="{{ route('admin.tinhtrang.sua', ['id' => $tinhtrang->id]) }}" method="post">
				@csrf
				
				<div class="mb-3">
					<label class="form-label" for="tinhtrang">Tên tình trạng</label>
					<input type="text" class="form-control @error('tinhtrang') is-invalid @enderror" id="tinhtrang" name="tinhtrang" value="{{ $tinhtrang->tinhtrang }}" required />
					@error('tinhtrang')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				<div class="d-flex justify-content-between">
					<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật</button>
					<a href="{{route('admin.tinhtrang')}}" class="btn btn-primary">Quay lại</a>
				</div>
			</form>
		</div>
	</div>
@endsection