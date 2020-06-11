<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
    	$loaitin=LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem()
    {
    	$theloai = TheLoai::all(); 
    	return view('admin.loaitin.them',['theloai'=>$theloai]);

    }
    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:1|max:100|unique:LoaiTin,Ten', 
    			'TheLoai' =>'required'
    		]
    		,[
    			'Ten.required' => "Bạn chưa nhập tên loại tin",
    			'Ten.min'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 kí tự',
    			'Ten.max'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 kí tự',
    			'Ten.unique' => 'Tên đã tồn tại',
    			'TheLoai.required'=>'Bạn chưa chọn thể loại'
    		]);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
    }
    public function getSua($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
    	
    	$this->validate($request,
    		[
    			'Ten' => 'required|min:1|max:100|unique:LoaiTin,Ten',
    			'TheLoai' =>'required'
    		]
    		,[
    			'Ten.required' => 'Bạn chưa nhập tên loại tin',
    			'Ten.min' =>'Tên loại tin phải có độ dài từ 3 cho đến 100 kí tự',
    			'Ten.max' => 'Tên loại tin phải có độ dài từ 3 cho đến 100 kí tự',
    			'Ten.unique' => 'Tên đã tồn tại',
    			'TheLoai.required' => 'Bạn chưa chọn thể loại'
    		]);
    	$loaitin = LoaiTin::find($id);
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    public function getXoa($id)
    {
    	$theloai = LoaiTin::find($id);
    	$theloai->delete();

    	return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xóa thành công'); 
    }
}
