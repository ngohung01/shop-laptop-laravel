<?php

namespace App\Http\Controllers;
use App\Mail\DatHangEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use App\Models\Slide;
use App\Models\DonHang;
use App\Models\gopy;
use App\Models\Khuyenmai;
use App\Models\DonHang_ChiTiet;
use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Toastr;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	public function getHome(Request $request)
	{
		$url_canonical = $request->url();
		$khuyenmai = Khuyenmai::all();
		$sanpham = SanPham::paginate(8);
		$slide = Slide::all();
		return view('frontend.index', compact('sanpham','slide','khuyenmai','url_canonical'));
	}
	
	public function getDangKy(Request $request)
	{
		$url_canonical = $request->url();
		return view('user.dangky',compact('url_canonical'));
	}
	
	public function getDangNhap(Request $request)
	{
		$url_canonical = $request->url();
		return view('user.dangnhap',compact('url_canonical'));
	}
	
	public function postDangNhap(Request $request){
		// $errorMsg ='';
		// // dd($request);
		// if($request->email){
		// 	$username = $request -> email;
		// 	$password = $request -> password;
		// }else{
		// 	return back()->with('fail','Có lỗi đã xảy ra vui lòng kiểm tra lại tài khoản và mật khẩu');
		// }

		// $user = User::where('username',$username)->orWhere('email',$username)->first();
		// if(!isset($user)){
		// 	return back()->with('fail','Tài khoản không tồn tại');
		// }
		// if($user->role =='user'){
		// 	if(Hash::check($password,$user->password)){
		// 		Toastr::success('<p>Welcome '.$user->username.'</p> <br/> <p>Chúc bạn có một trải nghiệm vui vẻ</p>','Thông báo');

		// 		return view();
		// 	}else{
		// 		$errorMsg='Tài khoản hoặc mật khẩu không chính xác';
		// 	}
		// }else{
		// 	$errorMsg='Tài khoản không tồn tại';
		// }
		// return back()->with('fail',$errorMsg);
	}
	//Quên mật khẩu Khách hàng
	public function getQuenMatKhau(Request $request){
		$url_canonical = $request->url();
		return view('user.quenmatkhau',compact('url_canonical'));
	}

	public function postQuenMatKhau(Request $request){
		$request->validate(['email' => 'required|email']);
 
		$status = Password::sendResetLink(
			$request->only('email')
		);
		return $status === Password::RESET_LINK_SENT
					? back()->with(['status' => __($status)])
					: back()->withErrors(['email' => __($status)]);
		
	}

	public function getDatLaiMatKhau(Request $request){
		// dd($request);
		$url_canonical = $request->url();
		$token =  $request->token;
        return view('user.datlaimatkhau',compact('url_canonical','token'));
	}

	public function postDatLaiMatKhau(Request $request){
		// dd($request);
		$url_canonical = $request->url();
		// dd($request->only('email', 'password', 'password_confirmation', 'token'));	
		$request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'same:password'
		],[
			'password_confirmation' => 'Trường mật khẩu xác nhận không khớp'
		]);
		// dd($request);
		$check_token = DB::table('password_resets')->where([
			'email' => $request->email,
            'token' => $request->token
		]);
		if(!$check_token){
			session()->flash('fail','Token không xác định.');
		}else{
			User::where('email',$request->email)->update([
				'password' => Hash::make($request->password),
			]);
			DB::table('password_resets')->where('email',$request->email)->delete();
			session()->flash('success', 'Đổi mật khẩu thành công');
			Toastr::success('Đổi mật khẩu thành công','Thông báo');
			return redirect()-> route('user.dangnhap',compact('url_canonical'));
		}

		// $status = Password::reset(
		// 	$request->only('email', 'password', 'password_confirmation', 'token'),
		// 	function ($user, $password) {
		// 		// dd($user);
		// 		$user->forceFill([
		// 			'password' => Hash::make($password)
		// 		])->setRememberToken(Str::random(60));
	 
		// 		$user->save();
	 
		// 		event(new PasswordReset($user));
		// 	}
		// );
		// // dd($status);
		// dd(Password::PASSWORD_RESET);
		// return $status === Password::PASSWORD_RESET
		// 			? redirect()->route('login')->with('status', __($status))
		// 			: back()->withErrors(['email' => [__($status)]]);
	}
	//Sản phẩm
	public function getSanPham(Request $request,$tenloai_slug = '')
	{
		$url_canonical = $request->url();
		$tenloai = '';
		if(!empty($tenloai_slug))
		{
			$khuyenmai=Khuyenmai::all();
			$slide = Slide::all();
			$loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
			$sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)->paginate(16);
			$tenloai = $loaisanpham->tenloai;
		}
		else
		{
			$sanpham = SanPham::paginate(16);
		}
		
		return view('frontend.index', compact('sanpham', 'tenloai','slide','khuyenmai','url_canonical'));
	}
	public function getHang(Request $request,$tenhang_slug = '')
	{
		// dd($request);
		$url_canonical = $request->url();
		$tenhang = '';
		if(!empty($tenhang_slug))
		{
			$khuyenmai=Khuyenmai::all();
			$slide = Slide::all();
			$hangsanxuat = HangSanXuat::where('tenhang_slug', $tenhang_slug)->first();
			$sanpham = SanPham::where('hangsanxuat_id', $hangsanxuat->id)->paginate(16);
			$tenhang = $hangsanxuat->tenhang;
		}
		else
		{
			$sanpham = SanPham::paginate(16);
		}
		
		return view('frontend.index', compact('sanpham', 'tenhang','slide','khuyenmai','url_canonical'));
	}
	
	public function postSanPham(Request $request)
	{
		// dd($request);
		$url_canonical = $request->url();
		if(isset($request->tenloai_slug))
		{
			$khuyenmai=Khuyenmai::all();
			$slide=Slide::all();
			$loaisanpham = LoaiSanPham::where('tenloai_slug', $request->tenloai_slug)->first();
			$tenloai = $loaisanpham->tenloai;
			if($request->sapxep == 'popularity') // Mua nhiều nhất
			{
				$sanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
					->where('sanpham.loaisanpham_id', $loaisanpham->id)
					->selectRaw('sanpham.*, coalesce(sum(donhang_chitiet.soluongban), 0) tongsoluongban')
					->groupBy('sanpham.id')
					->orderBy('tongsoluongban', 'desc')
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'popularity');
			}
			elseif($request->sapxep == 'date') // Mới nhất
			{
				$sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)
					->orderBy('created_at', 'desc')
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'date');
			}
			elseif($request->sapxep == 'price') // Xếp theo giá: thấp đến cao
			{
				$sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)
					->orderBy('dongia', 'asc')
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'price');
			}
			elseif($request->sapxep == 'price-desc') // Xếp theo giá: cao xuống thấp
			{
				$sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)
					->orderBy('dongia', 'desc')
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'price-desc');
			}
			else // Mặc định
			{
				$sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'default');
			}
			
			return view('frontend.index', compact('sanpham', 'tenloai','slide','khuyenmai','url_canonical'));
		}
		else
		{
			$khuyenmai=Khuyenmai::all();
			$slide=Slide::all();
			if($request->sapxep == 'popularity') // Mua nhiều nhất
			{
				$sanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
					->selectRaw('sanpham.*, coalesce(sum(donhang_chitiet.soluongban), 0) tongsoluongban')
					->groupBy('sanpham.id')
					->orderBy('tongsoluongban', 'desc')
					->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'popularity');
			}
			elseif($request->sapxep == 'date') // Mới nhất
			{
				$sanpham = SanPham::orderBy('created_at', 'desc')->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'date');
			}
			elseif($request->sapxep == 'price') // Xếp theo giá: thấp đến cao
			{
				$sanpham = SanPham::orderBy('dongia', 'asc')->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'price');
			}
			elseif($request->sapxep == 'price-desc') // Xếp theo giá: cao xuống thấp
			{
				$sanpham = SanPham::orderBy('dongia', 'desc')->paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'price-desc');
			}
			else // Mặc định
			{
				$sanpham = SanPham::paginate(16);
				
				// Ghi vào SESSION
				session()->put('sapxep', 'default');
			}
			
			return view('frontend.index', compact('sanpham','slide','khuyenmai','url_canonical'));
		}
	}
	
	public function getSanPham_ChiTiet(Request $request,$tenloai_slug, $tensanpham_slug)
	{
		$url_canonical = $request->url();
		$loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->first();
		$sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();
		$sanphamlienquan = SanPham::where('loaisanpham_id', $loaisanpham->id)->orderBy('created_at', 'desc')->take(5)->get();
		// dd($sanpham);
		$dg=DanhGia::where('sanpham_id',$sanpham->id)->get();
		return view('frontend.sanpham_chitiet', compact('loaisanpham', 'sanpham', 'sanphamlienquan','dg','url_canonical'));
	}
	//Phản hồi
	public function getLienHe(Request $request)
	{
		$url_canonical = $request->url();
		return view('frontend.lienhe',compact('url_canonical'));
	}
	
	public function postLienHe (Request $request){
		$url_canonical = $request->url();
		$gy = new gopy();
		$gy->name = $request->name;
		$gy->email = $request->email;
		$gy->sodienthoai = $request->phone;
		$gy->chude = $request->subject;
		$gy->noidung = $request->message;
		$gy->save();
		Toastr::success('Góp ý thành công','Thông báo');
		return view('frontend.lienhe',compact('url_canonical'));

	}
	
	public function getGioHang(Request $request)
	{
		$url_canonical = $request->url();
		if(Cart::count())
			return view('frontend.giohang',compact('url_canonical'));
		else
			return view('frontend.giohang_rong',compact('url_canonical'));
	}
	
	public function getGioHang_Them($tensanpham_slug)
	{
		$sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();
		Cart::add([
			'id' => $sanpham->id,
			'name' => $sanpham->tensanpham,
			'price' => $sanpham->dongia,
			'qty' => 1,
			'weight' => 0,
			'options' => [
				'image' => $sanpham->hinhanh
			]
		]);
		
		// Quay về trang chủ kèm thông báo dạng flash session
		return redirect()->route('frontend')->with('status', 'Đã thêm sản phẩm <strong>'.$sanpham->tensanpham.'</strong> vào giỏ.');
	}
	
	public function getGioHang_Xoa($row_id)
	{
		Cart::remove($row_id);
		return redirect()->route('frontend.giohang');
	}
	
	public function getGioHang_XoaTatCa()
	{
		Cart::destroy();
		return redirect()->route('frontend.giohang');
	}
	
	public function getGioHang_Giam($row_id)
	{
		//get lấy 1 bản ghi còn content lấy tất cả bản ghi trong Cart
		$row = Cart::get($row_id);
		if($row->qty > 1)
			Cart::update($row_id, $row->qty - 1);
		return redirect()->route('frontend.giohang');
	}
	
	public function getGioHang_Tang($row_id)
	{
		$row = Cart::get($row_id);
		$sanpham = SanPham::find($row->id);
		if($row->qty < $sanpham->soluong)
		{
			Cart::update($row_id, $row->qty + 1);
			return redirect()->route('frontend.giohang');
		}
		else
		{
			Toastr::warning('Số lượng không đủ','Thông báo');
			return redirect()->route('frontend.giohang');
		}
	}
	
	public function getDatHang(Request $request)
	{
		$url_canonical= $request->url();
		// Nếu đã đăng nhập thì chuyển sang thanh toán
		if(Auth::check())
			return view('frontend.dathang',compact('url_canonical'));
		else // Nếu chưa đăng nhập thì chuyển sang đăng nhập
			return redirect()->route('user.dangnhap',compact('url_canonical'));
	}
	
	public function postDatHang(Request $request)
	{
	
		$messages = [
            'diachigiaohang.required' => 'Địa chỉ giao hàng không được bỏ trống',
			'dienthoaigiaohang.required' => 'Điện thoại giao hàng không được bỏ trống',
        ];
		
        $request->validate([
            'dienthoaigiaohang' => 'required|max:100',
			'diachigiaohang' => 'required|max:100',

        ], $messages);
		
		// if ($request->has('payment_option')) 
		// 	$payment = $request->input('payment_option');
		// 	// Xử lý logic với biến $gender
		// if($payment=="option3"){
			// Lưu vào đơn hàng
		$dh = new DonHang();
		$dh->user_id = Auth::user()->id;
		$dh->tinhtrang_id = 1; // Đơn hàng mới
		$dh->diachigiaohang = $request->diachigiaohang;
		$dh->dienthoaigiaohang = $request->dienthoaigiaohang;
		$dh->save();
		
		// Lưu vào đơn hàng chi tiết
		foreach(Cart::content() as $value)
		{
			$ct = new DonHang_ChiTiet();
			$ct->donhang_id = $dh->id;
			$ct->sanpham_id = $value->id;
			$ct->soluongban = $value->qty;
			$ct->dongiaban = $value->price;
			//trừ số lượng sản phẩm sau khi mua
			$sp=SanPham::find($value->id);
                if($sp->soluong>=$value->qty){
                    $sp->soluong-=$value->qty;
                    $sp->save();
                }
                else{
					Toastr::warning('Số lượng không đủ','Thông báo');
                    return redirect()->route('frontend.dathang');
                }
			$ct->save();
		}
		//gửi mail cho khách hàng
		Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
		return redirect()->route('frontend.dathangthanhcong');
		// }
			
		
		
	}
	
	public function getDatHangThanhCong(Request $request)
	{
		$url_canonical = $request->url();
		// Xóa giỏ hàng khi hoàn tất đặt hàng?
		Cart::destroy();
		
		return view('frontend.dathangthanhcong',compact('url_canonical'));
	}
	// Tìm kiếm
	public function getTimkiem(Request $request){
		$url_canonical = $request->url();
		$slide = Slide::all();
		$key = $request->timkiem;
		$tam = SanPham::where('tensanpham','LIKE', '%'.$key.'%')->paginate(16);
		return view('frontend.timkiem',compact('tam','slide','url_canonical'));
	}

	
	//Đánh giá sản phẩm
	public function postDanhgia(Request $request){
		$dg= new DanhGia();
		$dg->sanpham_id = $request->id;
		$dg->name = $request->name;
		$dg->email = $request->email;
		// $dg->sosao = $request->rate;
		$dg->noidung = $request->message;
		$dg->save();
		Toastr::success('Đánh giá thành công','Thông báo');
		return back();
	}
}