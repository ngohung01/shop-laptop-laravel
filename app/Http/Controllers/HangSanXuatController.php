<?php

namespace App\Http\Controllers;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Imports\HangSanXuatImport;
use App\Exports\HangSanXuatExport;
use App\Models\SanPham;
use Maatwebsite\Excel\Facades\Excel;
use Toastr;
class HangSanXuatController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$hangsanxuat = HangSanXuat::all();
		return view('admin.hangsanxuat.danhsach', compact('hangsanxuat'));
	}
	
	public function getThem()
	{
		return view('admin.hangsanxuat.them');
	}
	
	public function postThem(Request $request)
	{
		// Kiểm tra
		$this->validate($request, [
			'tenhang' => ['required', 'string', 'max:191', 'unique:hangsanxuat'],
			'hinhanh' => ['nullable', 'image', 'max:1024']
		]);
		
		// Upload hình ảnh
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
			$path = Storage::putFileAs('hang-san-xuat', $request->file('hinhanh'), $filename);
		}
		
		// Thêm
		$orm = new HangSanXuat();
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->save();
		Toastr::success('Thêm thành công','Thông báo');
		// Quay về danh sách
		return redirect()->route('admin.hangsanxuat');
	}
	
	public function getSua($id)
	{
		$hangsanxuat = HangSanXuat::find($id);
		return view('admin.hangsanxuat.sua', compact('hangsanxuat'));
	}
	
	public function postSua(Request $request, $id)
	{
		// Kiểm tra
		$this->validate($request, [
			'tenhang' => ['required', 'string', 'max:191', 'unique:hangsanxuat,tenhang,' . $id],
			'hinhanh' => ['nullable', 'image', 'max:1024']
		]);
		
		// Upload hình ảnh
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			// Xóa file cũ
			$orm = HangSanXuat::find($id);
			Storage::delete($orm->hinhanh);
			
			// Upload file mới
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tenhang, '-') . '.' . $extension;
			$path = Storage::putFileAs('hang-san-xuat', $request->file('hinhanh'), $filename);
		}
		
		// Sửa
		$orm = HangSanXuat::find($id);
		$orm->tenhang = $request->tenhang;
		$orm->tenhang_slug = Str::slug($request->tenhang, '-');
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->save();
		Toastr::success('cập nhật thành công','Thông báo');
		// Quay về danh sách
		return redirect()->route('admin.hangsanxuat');
	}
	
	public function getXoa($id)
	{
		// Xóa
		$orm = HangSanXuat::find($id);
		$products = SanPham::where('hangsanxuat_id',$id)->first();
		// dd($products);
		if(empty($products)){
			
			$orm->delete();
			// Xoá hình ảnh khi xóa dữ liệu
			Storage::delete($orm->hinhanh);
			// Quay về danh sách
			Toastr::success('Xoá thành công','Thông báo');
			return redirect()->route('admin.hangsanxuat');
		}else{
			Toastr::warning('Hãng sản xuất này đang có sản phẩm tồn tại','Cảnh báo');
			return back();
		}
	}
	
	public function postNhap(Request $request)
	{
		$checkFile = $request->file('file_excel')->extension();
		if($checkFile == 'xlsx'){
			Excel::import(new HangSanXuatImport, $request->file('file_excel'));
			Toastr::success('Nhập thành công','Thông báo');
			return redirect()->route('admin.hangsanxuat');
		}else {
			Toastr::warning('Nhập thất bại lỗi file','Thông báo');
			return back();
		}
		
	}
	
	public function getXuat()
	{
		return Excel::download(new HangSanXuatExport, 'hang-san-xuat.xlsx');
	}
}