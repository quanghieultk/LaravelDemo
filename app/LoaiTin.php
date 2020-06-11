<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "LoaiTin";

    public function theloai()
    {
    	//loại tin thuộc một thể loại nên là liên kết 1-1
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    public function tintuc()
    {
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
