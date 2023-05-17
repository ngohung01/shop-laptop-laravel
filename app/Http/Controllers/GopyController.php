<?php

namespace App\Http\Controllers;
use Toastr;
use Illuminate\Http\Request;
use App\Models\gopy;
use App\Mail\GopyEmail;
use Illuminate\Support\Facades\Mail;
use Auth;
class GopyController extends Controller
{
    //
    public function getGopy(Request $request){
        $gy=gopy::all();
        return view('admin.gopy.danhsach',compact('gy'));
    }
    public function getTraloi($id){
        $gy=gopy::find($id);
        return view('admin.gopy.traloi',compact('gy'));
    }
    public function postTraloi(Request $request,$id){
        $gy=gopy::find($id);
        $gy->phanhoi=$request->traloi;
        $gy->save();
        Toastr::success('Phản hồi thành công','Thông báo');
        //gửi Email phản hồi
        Mail::to($gy->email)->send(new GopyEmail($gy));
        return redirect()->route('admin.gopy');
    }
}
