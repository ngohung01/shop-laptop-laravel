@extends('layouts.frontend')

@section('title', 'Quên mật khẩu')

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>Quên mật khẩu</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">Quên mật khẩu</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="login_register_wrap section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-6 col-md-10">
						<div class="login_wrap">
							<div class="padding_eight_all bg-white">
								@if (session('fail'))
									<p class="alert alert-warning">{{session('fail')}}</p>
								@endif
								<div class="heading_s1">
									<h3>Quên mật khẩu</h3>
								</div>
								<form action="{{  route('user.lay-lai-mat-khau')  }}" method="post">
									@csrf
                                    <input type="hidden" name='token' value="{{$token}}"/>
									<div class="form-group">
										<input type="text" class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email khôi phục *" required />
										@if ($errors->has('email') || $errors->has('username'))
											<span class="invalid-feedback" role="alert"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></span>
										@endif
									</div>
									<div class="form-group">
										<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu *" required />
										@error('password')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
                                    <div class="form-group">
										<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Nhập lại mật khẩu *" required />
										@error('password_confirmation')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-fill-out btn-block">GỬI</button>
									</div>
								</form>
								{{-- <div class="different_login">
									<span>Hoặc</span>
								</div>
								<ul class="btn-login list_none text-center">
									<li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
									<li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
								</ul>
								<div class="form-note text-center">Bạn chưa có tài khoản? <a href="{{ route('user.dangky') }}">Đăng ký ngay</a></div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection