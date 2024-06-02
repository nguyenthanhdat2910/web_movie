<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    public $timestamps = false ;
    use HasFactory;
    protected $table = 'danhmuc';

    public function phim(){
        return $this->hasMany(Phim::class)->orderBy('id','DESC');
    }
    public function phim_danh_muc(){
        return $this->belongsToMany(Phim::class,'danh_muc_phim','phim_id','danh_muc_id');
    }
}
