<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\TinhTrang;
use Illuminate\Http\Request;
use Toastr;
class DonHangController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$donhang = DonHang::orderBy('created_at', 'desc')->get();
		return view('admin.donhang.danhsach', compact('donhang'));
	}
	
	public function getThem()
	{
		// Đặt hàng bên Front-end
	}
	
	public function postThem(Request $request)
	{
		// Xử lý đặt hàng bên Front-end
	}
	
	public function getSua($id)
	{
		$donhang = DonHang::find($id);
		$tinhtrang = TinhTrang::all();
		return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
	}
	
	public function postSua(Request $request, $id)
	{
		$this->validate($request, [
			'tinhtrang_id' => ['required'],
			'dienthoaigiaohang' => ['required', 'string', 'max:20'],
			'diachigiaohang' => ['required', 'string', 'max:191'],
		]);
		
		$orm = DonHang::find($id);
		$orm->tinhtrang_id = $request->tinhtrang_id;
		$orm->dienthoaigiaohang = $request->dienthoaigiaohang;
		$orm->diachigiaohang = $request->diachigiaohang;
		$orm->save();
		Toastr::success('Cập nhật thành công','Thông báo');
		return redirect()->route('admin.donhang');
	}
	
	public function getXoa($id)
	{
		
		DonHang_ChiTiet::where('donhang_id',$id)->delete();
		DonHang::find($id)->delete();

		Toastr::success('Xoá thành công','Thông báo');
		return redirect()->route('admin.donhang');
	}
	public function getThongke(){
		$tk = DonHang::all();
		return view('admin.thongke.danhsach',compact('tk'));
	}
	public function getThuchien(Request $request){
		$date = $request->ngay;
		$tam = DonHang::where('created_at',$date)->get	();
		// dd($tam);
		return view('admin.thongke.thuchien',compact('tam'));
	}
}