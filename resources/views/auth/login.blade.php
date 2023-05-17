@extends('layouts.admin')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Đăng nhập</div>
				<div class="card-body">
					<form method="post" action="{{ route('login') }}">
						@csrf
						<div class="mb-3">
							<label class="form-label" for="email">Tài khoản</label>
							<input type="text"
							class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}"
							id="email" name="email" value="{{ old('email') }}"
							placeholder="Email hoặc Tên đăng nhập" required />
							@if ($errors->has('email') || $errors->has('username'))
								<span class="invalid-feedback" role="alert">
								<strong>
									{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}
								</strong>
								</span>
							@endif
						</div>
						
						<div class="mb-3">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu" name="password" required />
							@error('password')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label" for="feedback-recaptcha">Xác thực đăng nhập</label>
							<div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
									data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
									data-size="normal"
									data-theme="light">
						    </div>
							@error('g-recaptcha-response')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							@enderror
						</div>
						
						<div class="mb-3 form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
							<label class="form-check-label" for="remember">Duy trì đăng nhập</label>
						</div>
						
						<div class="mb-0">
							<button type="submit" class="btn btn-info"><i class="fal fa-sign-in-alt"></i> Đăng nhập</button>
							@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('javascript')
 <script src="https://www.google.com/recaptcha/api.js?hl=vi" async defer></script>
@endsection