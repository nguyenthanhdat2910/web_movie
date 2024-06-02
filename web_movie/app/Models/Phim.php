<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    public $timestamps = false ;
    use HasFactory;
    protected $table = 'phim';

    public function danhmuc(){
        return $this->belongsTo(DanhMuc::class,'danh_muc_id');
    }
    public function quocgia(){
        return $this->belongsTo(QuocGia::class,'quoc_gia_id');
    }
    public function theloai(){
        return $this->belongsTo(TheLoai::class,'the_loai_id');
    }
    public function phim_the_loai(){
        return $this->belongsToMany(TheLoai::class,'the_loai_phim','phim_id','the_loai_id');
    }
    public function phim_danh_muc(){
        return $this->belongsToMany(DanhMuc::class,'danh_muc_phim','phim_id','danh_muc_id');
    }
    public function tapphim(){
        return $this->hasMany(TapPhim::class);
    }
}
