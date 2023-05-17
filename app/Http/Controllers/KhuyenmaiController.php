<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khuyenmai;
use Toastr;
use App\Models\User;
use App\Mail\KhuyenmaiEmail;
use Illuminate\Support\Facades\Mail;
use Auth;
class KhuyenmaiController extends Controller
{
    //
    public function getKhuyenmai(){
        $km=Khuyenmai::all();
        return view('admin.khuyenmai.danhsach',compact('km'));
    }
    public function getThem(){
        return view('admin.khuyenmai.them');
    }
    public function postThem(Request $request){
        $km=new Khuyenmai();
        $km->tenkhuyenmai=$request->tenkhuyenmai;
        $km->makhuyenmai=$request->makhuyenmai;
        $km->giamgia=$request->giamgia;
        $km->soluong=$request->soluong;
        $km->ngaybatdau=$request->ngaybatdau;
        $km->ngayketthuc=$request->ngayketthuc;
        $km->save();
        Toastr::success('Thêm thành công','Thông báo');
        //gửi Email phản hồi
        $mail=User::select('email')->get();
        Mail::to($mail)->send(new KhuyenmaiEmail($km));
        return redirect()->route('admin.khuyenmai');
    }
   public function getXoa($id){
        $orm=Khuyenmai::find($id);
        $orm->delete();
        return redirect()->route('admin.khuyenmai');
   }
}
