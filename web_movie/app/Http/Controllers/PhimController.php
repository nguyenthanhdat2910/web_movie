<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\DanhMuc;
use App\Models\TheLoai;
use App\Models\QuocGia;
use App\Models\Phim_TheLoai;
use App\Models\Phim_DanhMuc;
use App\Models\TapPhim;
use Carbon\Carbon;
use File;


class PhimController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function thay_resolution(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->resolution = $data['resolution'];
        $phim->save();

    }
    public function update_new_image(Request $request){
        $get_image = $request->file('file');
        $movie_id = $request->movie_id;
        if($get_image){
            //xóa ảnh củ
                $phim = Phim::find($movie_id);
                unlink('upload/phim/'.$phim->image);
            //thêm ảnh mới
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('upload/phim/',$new_image);
                $phim->image= $new_image;
                $phim->save();

        }


    }
    public function thay_danhmuc(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->danh_muc_id = $data['danhmuc_id'];
        $phim->save();

    }
    public function thay_quocgia(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->quoc_gia_id = $data['quocgia_id'];
        $phim->save();

    }
    public function thay_hot(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->hot = $data['hot'];
        $phim->save();

    }
    public function thay_vietsub(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->vietsub = $data['vietsub'];
        $phim->save();

    }
    public function thay_status(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->status = $data['status'];
        $phim->save();

    }
    public function thay_phimle(Request $request){
        $data = $request->all();
        $phim = Phim::find($data['phim_id']);
        $phim->phim_le = $data['le_bo'];
        $phim->save();

    }
    public function sort_phim(){
        $phim_sort = Phim::with('phim_danh_muc')->orderBy('position','ASC')->get();
        $danhmuc = DanhMuc::orderBy('position','ASC')->get();
        $danhmuc_menu = DanhMuc::with(['phim'=>function($q)
        {
            $q->withCount('tapphim')->where('status',1);
        }])->orderBy ('position','ASC')->get();

        return view('adminHP.phim.sort_phim',compact('danhmuc','danhmuc_menu','phim_sort'));
    }
    public function nav_resorting(Request $request){
        $data = $request->all();
        foreach($data['ar_id'] as $key => $value  ){
            $danhmuc = DanhMuc::find($value);
            $danhmuc -> position = $key;
            $danhmuc->save();
        }
    }
    public function phim_resorting(Request $request){
        $data = $request->all();
        foreach($data['phim_id'] as $key => $value ){
            $phim = Phim::find($value);
            $phim -> position = $key;
            $phim->save();
        }
    }

    public function index()
    {
        $list = Phim::with('danhmuc','quocgia','phim_the_loai','phim_danh_muc','theloai')->withCount('tapphim')->orderBy('id','DESC')->get();

        $danhmuc = DanhMuc::pluck('title','id');
        $quocgia = QuocGia::pluck('title','id');
        $path= public_path()."/json/";

        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'phim.json',json_encode($list));

        return view('adminHP.phim.index',compact('list','danhmuc','quocgia'));
    }
    public function update_year(Request $request)
    {
        $data=$request->all();
        $phim = Phim::find($data['id_phim']);
        $phim->year = $data['year'];
        $phim->save();
    }
    public function update_topview(Request $request)
    {
        $data=$request->all();
        $phim = Phim::find($data['id_phim']);
        $phim->topview = $data['topview'];
        $phim->save();
    }

    public function filter_topview(Request $request)
    {
        $data=$request->all();
        $phim = Phim::where('topview',$data['value'])->orderBy('views','DESC')->take(10)->get();
        $output='';
        foreach($phim as $key => $pm){

            if($pm -> resolution==0)
                            $text = 'SD';
                        elseif($pm -> resolution==1)
                            $text = 'HD';
                        elseif($pm -> resolution==2)
                            $text = 'HDCam';
                        elseif($pm -> resolution==3)
                            $text = 'Cam';
                        elseif($pm -> resolution==4)
                            $text = 'FullHD';
                        else
                            $text = 'Trailer';
            $output.='
                    <div class="item">
                        <a href="'.url('ctphim/'.$pm->slug).'" title="'.$pm->title.'">
                            <div class="item-link">
                            <img src="'.url('upload/phim/'.$pm->image).'"class="lazy post-thumb" alt="'.$pm->title.'" title="'.$pm->title.'" />
                            <span class="is_trailer">'.$text.'</span>
                            </div>
                            <p class="title">'.$pm->title.'</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">

                                    '.$pm->views.' lượt xem

                        </div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                            <span style="width: 0%"></span>
                            </span>
                        </div>
                        </div>
                    </div>';

        }
        echo $output;
    }
    public function filter_topview_ready(Request $request)
    {
        $data=$request->all();
        $phim = Phim::where('topview',0)->orderBy('views','DESC')->take(10)->get();
        $output='';
        foreach($phim as $key => $pm){

            if($pm -> resolution==0)
                            $text = 'SD';
                        elseif($pm -> resolution==1)
                            $text = 'HD';
                        elseif($pm -> resolution==2)
                            $text = 'HDCam';
                        elseif($pm -> resolution==3)
                            $text = 'Cam';
                        elseif($pm -> resolution==4)
                            $text = 'FullHD';
                        else
                            $text = 'Trailer';
            $output.='
                    <div class="item">
                        <a href="'.url('ctphim/'.$pm->slug).'" title="'.$pm->title.'">
                            <div class="item-link">
                            <img src="'.url('upload/phim/'.$pm->image).'"class="lazy post-thumb" alt="'.$pm->title.'" title="'.$pm->title.'" />
                            <span class="is_trailer">'.$text.'</span>
                            </div>
                            <p class="title">'.$pm->title.'</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">
                                '.$pm->views.' lượt xem
                        </div>
                        <div style="float: left;">
                            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                            <span style="width: 0%"></span>
                            </span>
                        </div>
                        </div>
                    </div>';

        }
        echo $output;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhmuc= DanhMuc::pluck('title','id');
        $quocgia= QuocGia::pluck('title','id');
        $theloai= TheLoai::pluck('title','id');
        $list_theloai= TheLoai::all();
        $list_danhmuc= DanhMuc::all();

        return view('adminHP.phim.form',compact('quocgia','theloai','danhmuc','list_theloai','list_danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:phim|max:255',
            'name_e' => 'required|unique:phim|max:255',
            'description' => 'required',
            'image' => 'required',
            'time_phim' => 'required',
            'trailer' => 'required',
            'hot'=> 'required',
            'phim_le'=> 'required',
            'tags'=> 'required',
            'vietsub'=> 'required',
            'resolution'=> 'required',
            'slug'=> 'required',
            'status'=> 'required',
            'danh_muc'=> 'required',
            'quoc_gia_id'=> 'required',
            'the_loai'=> 'required',
            'tap_phim'=> 'required',

        ],
        [
            'title.required' => 'Bạn Bỏ Trống Tên Phim',
            'title.unique' => 'Tên Phim Bị Trùng',
            'title.max' => 'Tên Phim Quá Dài',
            'name_e.required' => 'Bạn Bỏ Trống Tên Phim',
            'name_e.unique' => 'Tên Phim Bị Trùng',
            'name_e.max' => 'Tên Phim Quá Dài',
            'description.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
            'image.required' => 'Bạn Chưa Có Hình Ảnh Phim',
            'time_phim.required' => 'Bạn Chưa Có Thời Gian Phim',
            'trailer.required' => 'Bạn Chưa Có Trailer Phim',
            'the_loai.required' => 'Bạn Chưa Chọn Thể Loại Cho Phim',
            'tap_phim.required' => 'Bạn Chưa Thêm Tập Cho Phim',
        ]
    );
        $phim = new Phim();
        $phim->title = $data['title'];
        $phim->trailer = $data['trailer'];
        $phim->time_phim = $data['time_phim'];
        $phim->hot = $data['hot'];
        $phim->phim_le = $data['phim_le'];
        if($phim->phim_le==1){
            $phim->tap_phim = 1;
        }else{
            $phim->tap_phim = $data['tap_phim'];
        }
        $phim->tags = $data['tags'];
        $phim->vietsub = $data['vietsub'];
        $phim->resolution = $data['resolution'];
        $phim->description = $data['description'];
        $phim->slug = $data['slug'];
        $phim->name_e = $data['name_e'];
        $phim->status = $data['status'];
        $phim->quoc_gia_id = $data['quoc_gia_id'];
        $phim->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $phim->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $phim->views= rand(50,999);

        foreach($data['the_loai'] as $key => $thel){
            $phim -> the_loai_id = $thel[0];
        }
        foreach($data['danh_muc'] as $key => $dm){
            $phim -> danh_muc_id = $dm[0];
        }
        //them hinh anh cho phim

        $get_image = $request->file('image');


        //thuc hien them hinh anh
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/phim/',$new_image);
            $phim->image= $new_image;

        }
        if($get_image==null){
            return redirect()->back();
        }

        $phim->save();
        $phim->phim_the_loai()->attach($data['the_loai']);
        $phim->phim_danh_muc()->attach($data['danh_muc']);
        return redirect()->route('phim.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quocgia= QuocGia::pluck('title','id');
        $theloai= TheLoai::pluck('title','id');
        $danhmuc= DanhMuc::pluck('title','id');
        $list_theloai= TheLoai::all();
        $list_danhmuc= DanhMuc::all();

        $phim = Phim ::find($id);
        $phim_the_loai = $phim -> phim_the_loai;
        $phim_danhmuc = $phim -> phim_danh_muc;
        return view('adminHP.phim.form',compact('quocgia','theloai','danhmuc','phim','list_theloai','list_danhmuc','phim_the_loai','phim_danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->all();
        $phim = Phim ::find($id);
        $phim->title = $data['title'];
        $phim->trailer = $data['trailer'];
        $phim->time_phim = $data['time_phim'];
        $phim->hot = $data['hot'];
        $phim->phim_le = $data['phim_le'];
        $phim->tap_phim = $data['tap_phim'];
        $phim->tags = $data['tags'];
        $phim->vietsub = $data['vietsub'];
        $phim->resolution = $data['resolution'];
        $phim->description = $data['description'];
        $phim->slug = $data['slug'];
        $phim->name_e = $data['name_e'];
        $phim->status = $data['status'];
        $phim->quoc_gia_id = $data['quoc_gia_id'];


        $phim->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['the_loai'] as $key => $thel){
            $phim -> the_loai_id = $thel[0];
        }
        foreach($data['danh_muc'] as $key => $dm){
            $phim -> danh_muc_id = $dm[0];
        }
        //them hinh anh cho phim
        $get_image = $request->file('image');


        //thuc hien them hinh anh
        if($get_image){
            if(file_exists('upload/phim/'.$phim->image)){
                unlink('upload/phim/'.$phim->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('upload/phim/',$new_image);
                $phim->image= $new_image;
            }

        }
        $phim->save();
        $phim->phim_the_loai()->sync($data['the_loai']);
        $phim->phim_danh_muc()->sync($data['danh_muc']);
        return redirect()->route('phim.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phim = Phim ::find($id);
        if(file_exists('upload/phim/'.$phim->image)){
            unlink('upload/phim/'.$phim->image);
        }
        Phim_TheLoai::whereIn('phim_id',[$phim->id])->delete();
        Phim_DanhMuc::whereIn('phim_id',[$phim->id])->delete();
        TapPhim::whereIn('phim_id',[$phim->id])->delete();
        $phim->delete();
        return redirect()->back();
    }
}
