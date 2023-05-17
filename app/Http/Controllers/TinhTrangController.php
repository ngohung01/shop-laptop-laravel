<?php

namespace App\Http\Controllers;
use Toastr;
use App\Models\TinhTrang;
use Illuminate\Http\Request;

class TinhTrangController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$tinhtrang = TinhTrang::all();
		return view('admin.tinhtrang.danhsach', compact('tinhtrang'));
	}
	
	public function getThem()
	{
		return view('admin.tinhtrang.them');
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang'],
		]);
		
		$orm = new TinhTrang();
		$orm->tinhtrang = $request->tinhtrang;
		$orm->save();
		Toastr::success('Thêm thành công','Thông báo');
		return redirect()->route('admin.tinhtrang');
	}
	
	public function getSua($id)
	{
		$tinhtrang = TinhTrang::find($id);
		return view('admin.tinhtrang.sua', compact('tinhtrang'));
	}
	
	public function postSua(Request $request, $id)
	{
		$this->validate($request, [
			'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang,tinhtrang,' . $id],
		]);
		
		$orm = TinhTrang::find($id);
		$orm->tinhtrang = $request->tinhtrang;
		$orm->save();
		Toastr::success('Cập nhật thành công','Thông báo');
		return redirect()->route('admin.tinhtrang');
	}
	
	public function getXoa($id)
	{
		$orm = TinhTrang::find($id);
		$orm->delete();
		Toastr::success('Xoá thành thành công','Thông báo');
		return redirect()->route('admin.tinhtrang');
	}
}