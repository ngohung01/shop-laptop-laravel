<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	<title>@yield('title', 'Trang chủ quản trị') - {{ config('app.name', 'Laravel') }}</title>
	
	<!-- CSS -->
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/jqvmap/jqvmap.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/daterangepicker/daterangepicker.css')}}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('public/backend/plugins/summernote/summernote-bs4.min.css')}}">
	<link rel="stylesheet" href="{{ asset('public/css/fontawesome.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/custom.css') }}" />
	<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
	
	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	
</head>
<body>
	<!-- Preloader -->

{{-- 
	<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ env('APP_URL') . '/storage/app/logo/wellcome.png'}}" alt="" height="200" width="200">
  </div> --}}


	 <!-- Navbar -->
	 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin')}}" class="nav-link {{0 == 'home' ? 'active' :false}}">Home</a>
      </li>
      @if(Auth::check())
      <li class="nav-item d-none d-sm-inline-block">
        <a style="cursor: pointer" onclick="handleLogout(event)" class="nav-link">Đăng xuất</a>
        {{-- <a href="{{route('logout')}}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">Đăng xuất</a> --}}
      </li>'
      @endif
	  <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
										@csrf
		</form>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
         <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">{{config('app.name','Laravel')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
			      <i class="fal fa-fw fa-cog"></i>
              <p>
                Quản lí
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{route('admin.sanpham')}}" class="nav-link {{0 == 'sanpham' ? 'active' : false}}">
				        <i class="fal fa-fw fa-cubes"></i>
                  <p>Sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.loaisanpham') }}" class="nav-link {{0 == '/admin/loaisanpham' ? 'active' : false}}">
				        <i class="fal fa-fw fa-list"></i>
                  <p>Loại sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.hangsanxuat') }}" class="nav-link">
				      <i class="fal fa-fw fa-copyright"></i>
                  <p>Hãng sản xuất</p>
                </a>
              </li>
			        <li class="nav-item">
                <a href="{{ route('admin.donhang') }}" class="nav-link">
				      <i class="fal fa-fw fa-file-invoice"></i>
                  <p>Đơn hàng</p>
                </a>
              </li>
			        <li class="nav-item">
                <a href="{{ route('admin.slide') }}" class="nav-link">
				      <i class="fa-thin fa-sliders-simple"></i>
                  <p>Slide</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('admin.tinhtrang') }}" class="nav-link">
				<i class="fal fa-fw fa-ballot-check"></i>
                  <p>Tình trạng</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('admin.khuyenmai') }}" class="nav-link">
				<i class="fa-light fa-badge-dollar"></i>
                  <p>Mã khuyến mãi</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ route('admin.nguoidung') }}" class="nav-link">
				  <i class="fal fa-fw fa-users"></i>
                  <p>Tài khoản người dùng</p>
                </a>
              </li>
              <li class="nav-item menu-open">
            <a href="{{route('admin.thongke')}}" class="nav-link">
              <i class="fa-thin fa-chart-simple"></i>
              <p>Thống kê bán hàng</p>
            </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.gopy') }}" class="nav-link">
				    <i class="fa-regular fa-message"></i>
                  <p>Góp ý</p>
                </a>
              </li>
            
            </ul>
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">		
		<main class="pt-3 pb-2">
			@yield('content')
		</main>
		
		<hr class="shadow-sm" />
		<footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
	</div>
	<!-- jQuery -->
	<script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('public/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<script>
  $.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- ChartJS -->
	<script src="{{asset('public/backend/plugins/chart.js/Chart.min.js')}}"></script>
	<!-- Sparkline -->
	<script src="{{asset('public/backend/plugins/sparklines/sparkline.js')}}"></script>
	<!-- JQVMap -->
	<script src="{{asset('public/backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('public/backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{asset('public/backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
	<!-- daterangepicker -->
	<script src="{{asset('public/backend/plugins/moment/moment.min.js')}}"></script>
	<script src="plugins/daterangepicker/daterangepicker.js')}}"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
	<!-- Summernote -->
	<script src="{{asset('public/backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<!-- overlayScrollbars -->
	<script src="{{asset('public/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('public/backend/dist/js/adminlte.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{asset('public/backend/dist/js/pages/dashboard.js')}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	{!! Toastr::message() !!}
	<script defer>
   
    function handleLogout(e){
          e.preventDefault();
          $logout = confirm('Bạn có chắc chắn muốn thoát không?');
          if($logout){
            $('#logout-form').submit();
          }
        }
  </script>

	@yield('javascript')
</body>
</html>