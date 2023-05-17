<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Str;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('user');
	}
	
	public function getHome(Request $request)
	{
		// $sanpham = new SanPham();
		$url_canonical = $request->url();
		$donhang = DonHang::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
		// $donhang_chitiet = $donhang->	
		//  dd($sanpham::find(20));
		//  dd($donhang);
		return view('user.index', compact('donhang','url_canonical'));
	}
	
	public function getDonHang()
	{
		// Quản lý đơn hàng của khách hàng
		// "Đơn hàng của tôi"
		$donhang = DonHang::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
		return view('user.index', compact('donhang'));
	}
	public function postDonHang($id){
		$donhang = DonHang::find($id);
		// dd($donhang);
		$donhang->tinhtrang_id = 5;
		$donhang->save();
		return redirect()->route('user');
	}
	
	public function getDonHang_ChiTiet(Request $request,$id)
	{
		$url_canonical = $request->url();

		return view('user.donhang_chitiet',compact('url_canonical'));
	}
	
	public function getMatKhau()
	{
		return view('user.doimatkhau');
	}
	
	public function getHoSo()
	{
		return view('user.hoso');
	}
	
	public function postCapNhatHoSo(Request $request)
	{
		$id = Auth::user()->id;
		$request->validate([
			'name' => ['required', 'string', 'max:100'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
			'password' => ['confirmed'],
		]);
		
		$orm = User::find($id);
		$orm->name = $request->name;
		$orm->username = Str::before($request->email, '@');
		$orm->email = $request->email;
		if(!empty($request->password)) $orm->password = Hash::make($request->password);
		$orm->save();
		return redirect()->route('user');
	}
}