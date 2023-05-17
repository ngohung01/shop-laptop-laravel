<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Toastr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class NguoiDungController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getDanhSach()
	{
		$nguoidung = User::withTrashed()->get();
		return view('admin.nguoidung.danhsach', compact('nguoidung'));
	}
	
	public function getThem()
	{
		return view('admin.nguoidung.them');
	}
	
	public function postThem(Request $request)
	{
		$request->validate([
			'name' => ['required', 'string', 'max:100'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'role' => ['required'],
			'password' => ['required', 'min:4', 'confirmed'],
		]);
		
		$orm = new User();
		$orm->name = $request->name;
		$orm->username = Str::before($request->email, '@');
		$orm->email = $request->email;
		$orm->password = Hash::make($request->password);
		$orm->role = $request->role;
		$orm->save();
		Toastr::success('Thêm thành công','Thông báo');
		
		return redirect()->route('admin.nguoidung');
	}
	
	public function getSua($id)
	{
		$nguoidung = User::find($id);
		return view('admin.nguoidung.sua', compact('nguoidung'));
	}
	
	public function postSua(Request $request)
	{
		$request->validate([
			'name' => ['required', 'string', 'max:100'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
			'role' => ['required'],
			'password' => ['confirmed'],
		]);
		
		$orm = User::find($request->id);
		$orm->name = $request->name;
		$orm->username = Str::before($request->email, '@');
		$orm->email = $request->email;
		$orm->role = $request->role;
		if(!empty($request->password)) $orm->password = Hash::make($request->password);
		$orm->save();
		Toastr::success('cập nhật thành công','Thông báo');
		return redirect()->route('admin.nguoidung');
	}
	
	public function getXoa($id)
	{
		// $orm = User::where('id',$id);
		$account = User::withTrashed()->find($id);
		// dd($account);	
		// if($account){
		// 	// dd($account);
		// 	$account->delete();
		// }else{
		// 	// $accountLock = User::onlyTrashed();
		// 	// dd($account);
		// 	$account -> restore();
		// }	
		// dd($account->deleted_at);
		$account->deleted_at ?  $account -> restore() : $account -> delete();
		return back();
		// $order = DonHang::where('user_id',$id);
		// if(!empty($order->get())){
		// 	$order->delete();
		// }
		// dd($order);
		// dd($orm);
		
		
	}
}