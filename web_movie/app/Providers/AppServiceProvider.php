<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\DanhMuc;
use App\Models\TheLoai;
use App\Models\TapPhim;
use App\Models\Phim;
use App\Models\Phim_TheLoai;
use App\Models\QuocGia;
use App\Models\Info;
use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $phimhot_sidebar = Phim::where('hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $phimhot_trailer = Phim::where('resolution',5)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
        $danhmuc = DanhMuc::orderBy ('position','ASC')->where('status',1)->get();
        $theloai = TheLoai::orderBy ('id','DESC')->get();
        $quocgia = QuocGia::orderBy ('id','DESC')->get();
        $info = Info::find(7);

        $all_danhmuc = DanhMuc::all()->count();
        $all_quocgia = QuocGia::all()->count();
        $all_theloai = TheLoai::all()->count();
        $all_phim = Phim::all()->count();


        View::share([
            'all_danhmuc'=>$all_danhmuc,
            'all_quocgia'=>$all_quocgia,
            'all_theloai'=> $all_theloai,
            'all_phim'=> $all_phim,
            'info'=>$info,
            'phimhot_sidebar'=>$phimhot_sidebar,
            'phimhot_trailer'=>$phimhot_trailer,
            'danhmuc_h'=>$danhmuc,
            'theloai_h'=>$theloai,
            'quocgia_h'=>$quocgia
        ]);
    }
}
