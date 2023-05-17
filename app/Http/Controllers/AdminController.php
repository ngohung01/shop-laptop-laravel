<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Slide;
use App\Models\User;
use App\Models\gopy;
use App\Models\DonHang;
use Auth;
class AdminController extends Controller
{
	public $active='home';
	public function __construct()
	{
		// Bắt buộc phải đăng nhập
		$this->middleware('auth');
	}
	
	public function getHome(Request $request)
	{
		
		$slide=Slide::all();
		$gy=gopy::all();
		$donhang=DonHang::all();
		$users=User::all();
		$active =$this->active;
		// if(Auth::user()->role == 'admin'||Auth::user()->role == 'nvtv'){
			return view('admin.index',compact('donhang','users','gy','slide','active'));
		// }
		// else{
		// 	return redirect()->route('frontend');
		// }
	}
	// Tìm kiếm
	public function getTimkiem(Request $request){
		$active =$this->active;
		$key = $request->timkiem;
		$tam = SanPham::where('tensanpham','LIKE', '%'.$key.'%')->paginate(16);
		return view('admin.timkiem.timkiem',compact('tam','active'));

		
	}
}