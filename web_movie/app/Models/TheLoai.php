<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    public $timestamps = false ;
    use HasFactory;
    protected $table = 'theloai';
    public function phim(){
        return $this->belongsTo(Phim::class)->orderBy('id','DESC');
    }
}
