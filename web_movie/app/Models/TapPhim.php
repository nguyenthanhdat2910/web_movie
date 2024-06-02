<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapPhim extends Model
{

    use HasFactory;
    public $timestamps = false ;
    protected $table = 'tap_phim';
    public function phim(){
        return $this->belongsTo(Phim::class);
    }
}
