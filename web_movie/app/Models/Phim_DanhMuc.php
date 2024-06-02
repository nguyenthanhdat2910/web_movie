<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim_DanhMuc extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $table = 'danh_muc_phim';

}
