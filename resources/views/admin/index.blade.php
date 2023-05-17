@extends('layouts.admin')

@section('content')
	 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$donhang->count()}}</h3>

                <p>Đơn hàng mới</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('admin.donhang')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$gy->count()}}</h3>

                <p>Tin nhắn mới</p>
              </div>
              <div class="icon">
              <i class="fa-thin fa-messages"></i>
              </div>
              <a href="{{route('admin.gopy')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$users->count()}}</h3>

                <p>Người dùng</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin.nguoidung')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$slide->count()}}</h3>

                <p>Slide</p>
              </div>
              <div class="icon">
              <i class="fa-thin fa-sliders"></i>
              </div>
              <a href="{{route('admin.slide')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
          
@endsection