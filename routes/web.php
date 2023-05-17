<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\HangSanXuatController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\SanPhamController; 
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DonHangChiTietController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\GopyController;
use App\Http\Controllers\KhuyenmaiController;

// Route::get('/welcome',function(){
// 	return view('welcome',['name' => 'Hưng']);
// });

// Đăng ký, đăng nhập, Quên mật khẩu
Auth::routes();

// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('frontend');

// Trang sản phẩm
Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('frontend.sanpham');
Route::post('/san-pham', [HomeController::class, 'postSanPham'])->name('frontend.sanpham');
Route::get('/san-pham/{tenloai_slug}', [HomeController::class, 'getSanPham'])->name('frontend.sanpham.danhmuc');
Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('frontend.sanpham.chitiet');
Route::get('/hang-san-xuat/{tenhang_slug}', [HomeController::class, 'getHang'])->name('frontend.sanpham.hang');
// Trang giỏ hàng
Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('frontend.giohang');
Route::get('/gio-hang/them/{tensanpham_slug}', [HomeController::class, 'getGioHang_Them'])->name('frontend.giohang.them');
Route::get('/gio-hang/xoa', [HomeController::class, 'getGioHang_XoaTatCa'])->name('frontend.giohang.xoatatca');
Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('frontend.giohang.xoa');
Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('frontend.giohang.giam');
Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('frontend.giohang.tang');

//tìm kiếm
Route::get('/timkiem', [HomeController::class, 'getTimkiem'])->name('frontend.timkiem');

// Trang đặt hàng
Route::get('/dat-hang', [HomeController::class, 'getDatHang'])->name('frontend.dathang');
Route::post('/dat-hang', [HomeController::class, 'postDatHang'])->name('frontend.dathang');
Route::get('/dat-hang-thanh-cong', [HomeController::class, 'getDatHangThanhCong'])->name('frontend.dathangthanhcong');

// Liên hệ
Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('frontend.lienhe');
Route::post('/lien-he/phanhoi', [HomeController::class, 'postLienHe'])->name('frontend.phanhoi');

// Trang khách hàng
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');
// Route::post('/khach-hang/dang-nhap', [HomeController::class, 'postDangNhap'])->name('user.postdangnhap');

Route::get('/khach-hang/quen-mat-khau', [HomeController::class, 'getQuenMatKhau'])
->middleware('guest')->name('user.quen-mat-khau');
Route::post('/khach-hang/quen-mat-khau', [HomeController::class, 'postQuenMatKhau'])
->middleware('guest');
Route::get('khach-hang/dat-lai-mat-khau/{token}', [HomeController::class, 'getDatLaiMatKhau'])
->middleware('guest')->name('user.datlaimatkhau');
Route::post('khach-hang/dat-lai-mat-khau', [HomeController::class, 'postDatLaiMatKhau'])
->middleware('guest')->name('user.lay-lai-mat-khau');

//Đánh giá sản phẩm
Route::post('/san-pham/danh-gia', [HomeController::class, 'postDanhgia'])->name('frontend.sanpham.danhgia');

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->middleware('user')->group(function() {
	// Trang chủ tài khoản khách hàng
	Route::get('/', [UserController::class, 'getHome'])->name('user');
	
	// Xem và cập nhật trạng thái đơn hàng
	// Route::get('/don-hang/{id}', [UserController::class, 'getDonHang'])->name('user.donhang');
	Route::post('/don-hang/{id}', [UserController::class, 'postDonHang'])->name('user.donhang');
	//Xem chi tiết đơn hàng
	Route::get('/don-hang/chi-tiet/{id}', [UserController::class,'getDonHang_ChiTiet'])->name('user.donhang.chitiet');
	// Cập nhật thông tin tài khoản
	Route::post('/cap-nhat-ho-so', [UserController::class, 'postCapNhatHoSo'])->name('user.capnhathoso');
});

// Trang tài khoản quản lý
//middleware auth kiểm tra xem admin đã đăng nhập chưa -> chuyển sang login nếu chưa 
// middleware admin kiểm tra xem có phải là admin ko nếu k thì thoát khỏi trang admin
Route::prefix('admin')->middleware('auth','admin')->group(function() {
	// Trang chủ tài khoản quản lý
	Route::get('/', [AdminController::class, 'getHome'])->name('admin');

	
	// Quản lý Sản phẩm
	Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('admin.sanpham');
	Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('admin.sanpham.them');
	Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('admin.sanpham.them');
	Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('admin.sanpham.sua');
	Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('admin.sanpham.sua');
	Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('admin.sanpham.xoa');
	Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('admin.sanpham.nhap');
	Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('admin.sanpham.xuat');
	


	// Quản lý Loại sản phẩm
	Route::get('/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('admin.loaisanpham');
	Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('admin.loaisanpham.them');
	Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('admin.loaisanpham.them');
	Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('admin.loaisanpham.sua');
	Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('admin.loaisanpham.sua');
	Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('admin.loaisanpham.xoa');
	
	// Quản lý Hãng sản xuất
	Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('admin.hangsanxuat');
	Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('admin.hangsanxuat.them');
	Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('admin.hangsanxuat.them');
	Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('admin.hangsanxuat.sua');
	Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('admin.hangsanxuat.sua');
	Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('admin.hangsanxuat.xoa');
	Route::post('/hangsanxuat/nhap', [HangSanXuatController::class, 'postNhap'])->name('admin.hangsanxuat.nhap');
	Route::get('/hangsanxuat/xuat', [HangSanXuatController::class, 'getXuat'])->name('admin.hangsanxuat.xuat');
	
	// Quản lý slide
	Route::get('/slide', [SlideController::class, 'getDanhSach'])->name('admin.slide');
	Route::get('/slide/them', [SlideController::class, 'getThem'])->name('admin.slide.them');
	Route::post('/slide/them', [SlideController::class, 'postThem'])->name('admin.slide.them');
	Route::get('/slide/sua/{id}', [SlideController::class, 'getSua'])->name('admin.slide.sua');
	Route::post('/slide/sua/{id}', [SlideController::class, 'postSua'])->name('admin.slide.sua');
	Route::get('/slide/xoa/{id}', [SlideController::class, 'getXoa'])->name('admin.slide.xoa');

	//Quản lý Tình trạng
	Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('admin.tinhtrang');
	Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('admin.tinhtrang.them');
	Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('admin.tinhtrang.them');
	Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('admin.tinhtrang.sua');
	Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('admin.tinhtrang.sua');
	Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('admin.tinhtrang.xoa');
	
	// Quản lý Đơn hàng
	Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('admin.donhang');
	Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('admin.donhang.them');
	Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('admin.donhang.them');
	Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('admin.donhang.sua');
	Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('admin.donhang.sua');
	Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('admin.donhang.xoa');
	
	// Quản lý Đơn hàng chi tiết
	Route::get('/donhang/chitiet', [DonHangChiTietController::class, 'getDanhSach'])->name('admin.donhang.chitiet');
	Route::get('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'getSua'])->name('admin.donhang.chitiet.sua');
	Route::post('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'postSua'])->name('admin.donhang.chitiet.sua');
	Route::get('/donhang/chitiet/xoa/{id}', [DonHangChiTietController::class, 'getXoa'])->name('admin.donhang.chitiet.xoa');
	
	// Quản lý Tài khoản người dùng
	Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('admin.nguoidung');
	Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('admin.nguoidung.them');
	Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('admin.nguoidung.them');
	Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('admin.nguoidung.sua');
	Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('admin.nguoidung.sua');
	Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('admin.nguoidung.xoa');

	//Quản lí góp ý
	Route::get('/gopy', [GopyController::class, 'getGopy'])->name('admin.gopy');
	Route::get('/gopy/{id}', [GopyController::class, 'getTraloi'])->name('admin.gopy.traloi');
	Route::post('/gopy/{id}', [GopyController::class, 'postTraloi'])->name('admin.gopy.traloi');

	//thống kê
	Route::get('/thongke', [DonHangController::class, 'getThongke'])->name('admin.thongke');
	Route::get('/thongke/thuchien', [DonHangController::class, 'getThuchien'])->name('thongke');

	//Khuyến mãi
	Route::get('/khuyenmai', [KhuyenmaiController::class, 'getKhuyenmai'])->name('admin.khuyenmai');
	Route::get('/khuyenmai/them', [KhuyenmaiController::class, 'getThem'])->name('admin.khuyenmai.them');
	Route::post('/khuyenmai/them', [KhuyenmaiController::class, 'postThem'])->name('admin.khuyenmai.them');
	Route::get('/khuyenmai/xoa/{id}', [KhuyenmaiController::class, 'getXoa'])->name('admin.khuyenmai.xoa');


	//tìm kiếm trang admin
	Route::get('/timkiem', [AdminController::class, 'getTimkiem'])->name('admin.sanpham.timkiem');
	
});