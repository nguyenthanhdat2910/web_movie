<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    public $timestamps = false ;
    protected $table = 'info_web';
    protected $fillable = [
        'title','mota','logo'
    ];
}
