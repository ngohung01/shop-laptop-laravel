<?php

namespace App\Http\Controllers;
use Toastr;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class SlideController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$slide = Slide::all();
		return view('admin.slide.danhsach', compact('slide'));
	}
	
	public function getThem()
	{
		return view('admin.slide.them');
	}
	
	public function postThem(Request $request)
	{
		// Kiểm tra
		$this->validate($request, [
			'tenslide' => ['required', 'string', 'max:191', 'unique:slide'],
			'hinhanh' => ['nullable', 'image', 'max:1024']
		]);
		
		// Upload hình ảnh
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tenslide, '-') . '.' . $extension;
			$path = Storage::putFileAs('slide', $request->file('hinhanh'), $filename);
		}
		
		// Thêm
		$orm = new Slide();
		$orm->tenslide = $request->tenslide;
		$orm->tenslide_slug = Str::slug($request->tenslide, '-');
		$orm->link=$request->link;
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->save();
		Toastr::success('Thêm thành công','Thông báo');
		// Quay về danh sách
		return redirect()->route('admin.slide');
	}
	
	public function getSua($id)
	{
		$slide = Slide::find($id);
		return view('admin.slide.sua', compact('slide'));
	}
	
	public function postSua(Request $request, $id)
	{
		// Kiểm tra
		$this->validate($request, [
			'tenslide' => ['required', 'string', 'max:191', 'unique:slide,tenslide,' . $id],
			'hinhanh' => ['nullable', 'image', 'max:1024']
		]);
		
		// Upload hình ảnh
		$path = '';
		if($request->hasFile('hinhanh'))
		{
			// Xóa file cũ
			$orm = Slide::find($id);
			Storage::delete($orm->hinhanh);
			
			// Upload file mới
			$extension = $request->file('hinhanh')->extension();
			$filename = Str::slug($request->tenslide, '-') . '.' . $extension;
			$path = Storage::putFileAs('slide', $request->file('hinhanh'), $filename);
		}
		
		// Sửa
		$orm = Slide::find($id);
		$orm->tenslide = $request->tenslide;
		$orm->tenslide_slug = Str::slug($request->tenslide, '-');
		$orm->link=$request->link;
		if(!empty($path)) $orm->hinhanh = $path;
		$orm->save();
		Toastr::success('Sửa thành công','Thông báo');
		
		// Quay về danh sách
		return redirect()->route('admin.slide');
	}
	
	public function getXoa($id)
	{
		// Xóa
		$orm = Slide::find($id);
		$orm->delete();
		
		// Xoá hình ảnh khi xóa dữ liệu
		Storage::delete($orm->hinhanh);
		
		Toastr::success('Xoá thành công','Thông báo');
		// Quay về danh sách
		return redirect()->route('admin.slide');
	}
	
}