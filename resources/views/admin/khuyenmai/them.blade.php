@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Thêm mã khuyến mãi</div>
		<div class="card-body">
			<form action="{{ route('admin.khuyenmai.them') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="mb-3">
					<label class="form-label" for="tenkhuyenmai">Tên khuyến mãi</label>
					<input type="text" class="form-control @error('tenkhuyenmai') is-invalid @enderror" id="tenkhuyenmai" name="tenkhuyenmai" value="{{ old('tenkhuyenmai') }}" required />
				</div>
				<div class="mb-3">
					<label class="form-label" for="makhuyenmai">Mã khuyến mãi</label>
					<input type="text" class="form-control @error('makhuyenmai') is-invalid @enderror" id="makhuyenmai" name="makhuyenmai" value="{{ old('makhuyenmai') }}" required />
				</div>
                <div class="mb-3">
					<label class="form-label" for="giamgia">Giảm giá</label>
					<input type="number" class="form-control @error('giamgia') is-invalid @enderror" id="giamgia" name="giamgia" value="{{ old('giamgia') }}" required />
				</div>
                <div class="mb-3">
					<label class="form-label" for="soluong">Số lượng</label>
					<input type="number" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong" value="{{ old('soluong') }}" required />
				</div>
                <div class="mb-3">
					<label class="form-label" for="ngaybatdau">Ngày bắt đầu</label>
					<input type="date" class="form-control @error('ngaybatdau') is-invalid @enderror" id="ngaybatdau" name="ngaybatdau" value="{{ old('ngaybatdau') }}" required />
				</div>
                <div class="mb-3">
					<label class="form-label" for="ngayketthuc">Ngày kết thúc</label>
					<input type="date" class="form-control @error('ngayketthuc') is-invalid @enderror" id="ngayketthuc" name="ngayketthuc" value="{{ old('ngayketthuc') }}" required />
				</div>
                
				
			
				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thêm vào CSDL</button>
			</form>
		</div>
	</div>
@endsection