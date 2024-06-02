<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\TheLoai;
use App\Models\TapPhim;
use App\Models\Phim;
use App\Models\Phim_TheLoai;
use App\Models\Phim_DanhMuc;
use App\Models\QuocGia;
use App\Models\Info;
use DB;


class TrangChu_controller extends Controller
{


    public function locphim(){


        $sapxep= $_GET['sap_xep'];
        $theloai_get= $_GET['the_loai'];
        $quocgia_get= $_GET['quoc_gia'];
        $year_get= $_GET['year'];

        if($sapxep=='' && $theloai_get=='' && $quocgia_get=='' && $year_get==''){
            return redirect()->back();
        }else{
            $list_phim = Phim::withCount('tapphim'); // đếm số tập

            if($quocgia_get){
                $list_phim = $list_phim ->where('quoc_gia_id',$quocgia_get);
            }
            if($sapxep){
                $list_phim = $list_phim ->orderBy($sapxep,'DESC');
            }
            if($year_get){
                $list_phim = $list_phim ->where('year',$year_get);
            }
            if($theloai_get){
               $theloai_loc = Phim_TheLoai::where('the_loai_id',$theloai_get)->get(); //nhóm the loai có chưa the loại được chọn
               $nhieu_theloai = [];
               foreach($theloai_loc as $key => $phim_tl){
                   $nhieu_theloai[]= $phim_tl->phim_id;
               }
               $list_phim = $list_phim->whereIn('id',$nhieu_theloai);
            }

            $phim = array();
            $phim = $list_phim->paginate(20);

            return view('layouts.page.locphim',compact('phim'));
        }
    }
    public function timkiem()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $phim = Phim::where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(10);

            return view('layouts.page.timkiem',compact('search','phim'));
        }else{
            return redirect()->to('/');
        }


    }
    public function Trangchu()
    {

        $phimhot = Phim::where('hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $danhmuc_home = DanhMuc::orderBy ('position','ASC')->get();
        $phim_danhmuc = Phim::with('phim_danh_muc')->orderBy('position','ASC')->get();
        return view('layouts.page.trangchu',compact('danhmuc_home','phimhot','phim_danhmuc'));
    }
    public function danhmuc($slug)
    {

        $danhmuc_slug = DanhMuc::where('slug',$slug)->first();
        $phim_danhmuc = Phim_DanhMuc::where('danh_muc_id',$danhmuc_slug->id)->get();
        $nhieu_danhmuc = [];
        foreach($phim_danhmuc as $key => $phimt){
            $nhieu_danhmuc[]= $phimt->phim_id;
        }

        $phim = Phim::whereIn('id',$nhieu_danhmuc)->where('status',1)->orderBy('ngaycapnhat','DESC')->paginate(10);
        return view('layouts.page.danhmuc',compact('danhmuc_slug','phim'));
    }
    public function year($year)
    {
        $year = $year;
        $phim = Phim::where('year',$year)->where('status',1)->orderBy('ngaycapnhat','DESC')->paginate(10);
        return view('layouts.page.year',compact('year','phim'));
    }
    public function tag($tag)
    {
        $tag = $tag;
        $phim = Phim::where('tags','LIKE','%'.$tag.'%')->where('status',1)->orderBy('ngaycapnhat','DESC')->paginate(10);
        return view('layouts.page.tags',compact('tag','phim'));
    }
    public function quocgia($slug)
    {

        $quocgia_slug = QuocGia::where('slug',$slug)->first();
        $phim = Phim::where('quoc_gia_id', $quocgia_slug->id)->where('status',1)->orderBy('ngaycapnhat','DESC')->paginate(10);
        return view('layouts.page.quocgia',compact('quocgia_slug','phim'));
    }

    public function theloaiphim($slug)
    {

        $theloai_slug = TheLoai::where('slug',$slug)->first();

        $phim_theloai = Phim_TheLoai::where('the_loai_id',$theloai_slug->id)->get();
        $nhieu_theloai = [];
        foreach($phim_theloai as $key => $phimt){
            $nhieu_theloai[]= $phimt->phim_id;
        }

        $phim = Phim::whereIn('id',$nhieu_theloai)->where('status',1)->orderBy('ngaycapnhat','DESC')->paginate(10);
        return view('layouts.page.theloaiphim',compact('theloai_slug','phim'));
    }
    public function ctphim($slug)
    {

            $phim = Phim::with('danhmuc','theloai','quocgia','phim_the_loai','phim_danh_muc')->where('slug',$slug)->where('status',1)->first();
            $phim_lienquan = Phim::with('danhmuc','theloai','quocgia')->where('status',1)->orderBy(DB::raw('RAND()'))
            ->whereNotIn('slug',[$slug])->get();
            $tap1 = TapPhim::with('phim')->where('phim_id',$phim->id)->orderBy('sotap','ASC')->first();
            //3 tập mới nhất
            $tapphim = TapPhim::with('phim')->where('phim_id',$phim->id)->orderBy('sotap','DESC')->take(3)->get();
            //tập/ tổng số tập
            $tong_tap = TapPhim::with('phim')->where('phim_id',$phim->id)->get();
            $so_tap= $tong_tap->count();

            //lượt xem
            $view= $phim-> views;
            $view= $phim-> views +1;
            $phim-> views = $view;
            $phim->save();
            return view('layouts.page.ctphim',compact('so_tap','tap1','tapphim','phim','phim_lienquan'));
    }
    public function chieuphim($slug,$tap)
    {


        $phim = Phim::with('danhmuc','theloai','quocgia','phim_the_loai','phim_danh_muc','tapphim')->where('slug',$slug)->first();

        $phim_lienquan = Phim::with('danhmuc','theloai','quocgia','phim_danh_muc')->where('status',1)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        if(isset($tap)){
            $ntap=$tap;
            $ntap= substr($tap,4,1);
            $xem_tap = TapPhim::where('phim_id',$phim->id)->where('sotap',$ntap)->first();
        }else{
            $ntap=1;
            $xem_tap = TapPhim::where('phim_id',$phim->id)->where('sotap',$ntap)->first();
        }



        return view('layouts.page.chieuphim',compact('ntap','xem_tap','phim_lienquan','phim'));
    }
    public function tapphim()
    {
        return view('layouts.page.tapphim');
    }
}
