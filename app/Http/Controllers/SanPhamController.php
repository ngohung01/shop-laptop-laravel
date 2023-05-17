<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Imports\SanPhamImport;
use App\Exports\SanPhamExport;
use App\Models\DanhGia;
use App\Models\DonHang_ChiTiet;
use Maatwebsite\Excel\Facades\Excel;
use Toastr;
use DB;
class SanPhamController extends Controller
{
	public $active ='sanpham';
	public function __construct(Request $request)
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{	
		$active = $this->active;
		$sanpham = SanPham::paginate(5);
		// dd($sanpham);
		return view('admin.sanpham.danhsach', compact('sanpham','active'));
	}
	
	public function getThem()
	{
		$active = $this->active;
		$loaisanpham = LoaiSanPham::all();
		$hangsanxuat = HangSanXuat::all();
		return view('admin.sanpham.them', compact('loaisanpham', 'hangsanxuat','active'));
	}
	
	public function postThem(Request $request)
	{
		$this->validate($request, [
			'loaisanpham_id' => ['required'],
			'hangsanxuat_id' => ['required'],
			'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham'],
			'soluong' => ['required', 'numeric'],
			'dongia' => ['required', 'numeric'],	
			'hinhanh' => ['required','nullable', 'image', 'max:2048'],
		]);
		
		// Kiểm tra tập tin rỗng hay không?
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			// Tạo thư mục nếu chưa có
			$lsp = LoaiSanPham::find($request->loaisanpham_id);
			File::isDirectory($lsp->tenloai_slug) or Storage::makeDirectory($lsp->tenloai_slug, 0775);
			
			// Xác định tên tập tin
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tensanpham, '-') . '.' . $extension;
			
			// Upload vào thư mục và trả về đường dẫn
			$path = Storage::putFileAs($lsp->tenloai_slug, $request->file('hinhanh'), $filename);
		}
		
		$orm = new SanPham();
		$orm->loaisanpham_id = $request->loaisanpham_id;
		$orm->hangsanxuat_id = $request->hangsanxuat_id;
		$orm->tensanpham = $request->tensanpham;
		$orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
		$orm->soluong = $request->soluong;
		$orm->dongia = $request->dongia;
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->motasanpham = $request->motasanpham;
		$orm->save();
		
		return redirect()->route('admin.sanpham');
	}
	
	public function getSua($id)
	{
		$active = $this->active;
		$sanpham = SanPham::find($id);
		$loaisanpham = LoaiSanPham::all();
		$hangsanxuat = HangSanXuat::all();
		return view('admin.sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat','active'));
	}
	
	public function postSua(Request $request, $id)
	{
		$this->validate($request, [
			'loaisanpham_id' => ['required'],
			'hangsanxuat_id' => ['required'],
			'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham,tensanpham,' . $id],
			'soluong' => ['required', 'numeric'],
			'dongia' => ['required', 'numeric'],
			'hinhanh' => ['nullable', 'image', 'max:2048'],
		]);
		
		// Kiểm tra tập tin rỗng hay không?
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			// Xóa tập tin cũ
			$sp = SanPham::find($id);
			Storage::delete($sp->hinhanh);
			
			// Xác định tên tập tin mới
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tensanpham, '-') . '.' . $extension;
			
			// Upload vào thư mục và trả về đường dẫn
			$lsp = LoaiSanPham::find($request->loaisanpham_id);
			$path = Storage::putFileAs($lsp->tenloai_slug, $request->file('hinhanh'), $filename);
		}
		
		$orm = SanPham::find($id);
		$orm->loaisanpham_id = $request->loaisanpham_id;
		$orm->hangsanxuat_id = $request->hangsanxuat_id;
		$orm->tensanpham = $request->tensanpham;
		$orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
		$orm->soluong = $request->soluong;
		$orm->dongia = $request->dongia;
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->motasanpham = $request->motasanpham;
		$orm->save();
		Toastr::success('Cập nhật thành công','Thông báo');
		
		return redirect()->route('admin.sanpham');
	}
	public function getXoa($id)
	{
		$orm = SanPham::find($id);
		// dd($orm);
		$rates = DB::table('danhgia')->where('sanpham_id',$id);
		// dd($rates);
		$orderDetail = DonHang_ChiTiet::where('sanpham_id',$id)->first();
		// dd($orderDetail);	
		if(empty($orderDetail)){
			if(!empty($rates->get())){
				// dd($rates->get());
				// DB::table('danhgia')->where('sanpham_id', $id)->delete();
				$rates->delete();
			}
				$orm->delete();
				// Xóa tập tin khi xóa sản phẩm
				if($orm->hinhanh){
					Storage::delete($orm->hinhanh);
				}
				Toastr::success('Xoá thành công','Thông báo');
				return redirect()->route('admin.sanpham');
		}else{
			Toastr::warning('Sản phẩm này có đơn hàng tồn tại trong hệ thống','Cảnh báo');
			return back();
		}
	}
	public function postNhap(Request $request)
	{
		$fileExtension = $request->file('file_excel')->extension();
		if($fileExtension == 'xlsx'){
			Excel::import(new SanPhamImport, $request->file('file_excel'));
			Toastr::warning('Thêm thành công.','Thông báo');
			return redirect()->route('admin.sanpham');
		}else{
			Toastr::warning('File không phù hợp.','Thông báo');
			return back();
		}
		
	}
	
	public function getXuat()
	{
		return Excel::download(new SanPhamExport, 'san-pham.xlsx');
	}
}