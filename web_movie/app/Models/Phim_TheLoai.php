<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim_TheLoai extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $table = 'the_loai_phim';


}
