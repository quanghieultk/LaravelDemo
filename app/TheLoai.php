<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";

    public function loaitin()
    {
    	//1 thể loại sẽ có nhiều loại tin: Đây là liên kết 1-Nhiều
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
