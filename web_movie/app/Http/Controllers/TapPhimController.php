<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\TapPhim;
use Carbon\Carbon;
class TapPhimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_tap = TapPhim::with('phim')->orderBy('phim_id','DESC')->get();
        $list_phim = Phim :: orderBy('id','DESC')->pluck('title','id');
        return view('adminHP.tapphim.index',compact('list_tap','list_phim'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function select_phim ()
    {
        $id = $_GET['id'];
        $phim = Phim ::find($id);
        $output=' <option>---Chọn Tập Phim---</option>';
        echo $output;
        for($tap=1;$tap <= $phim->tap_phim;$tap++){
            $output=' <option value="'.$tap.'">'.$tap.'</option>';
            echo $output;
        }


    }
    public function create()
    {
        $list_phim = Phim :: orderBy('id','DESC')->pluck('title','id');
        $tap =new TapPhim();
        return view('adminHP.tapphim.form',compact('list_phim','tap'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $old_tap = TapPhim::where('sotap',$data['sotap'])->where('phim_id', $data['phim_id'])->count();
        if($old_tap>0){
            return redirect()->route('tapphim.index');
        }else{
            $tap =new TapPhim();
            $tap->phim_id = $data['phim_id'];
            $tap->link = $data['link'];
            $tap->sotap = $data['sotap'];
            $tap->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
            $tap->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
            $tap->save();
            return redirect()->route('phim.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function Add_ep($id)
    {
        $list_tap = TapPhim::with('phim')->where('phim_id',$id)->orderBy('sotap','DESC')->get();
        $phim = Phim::find($id);
        return view('adminHP.tapphim.themtap',compact('list_tap','phim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_phim = Phim :: orderBy('id','DESC')->pluck('title','id');
        $tapphim = TapPhim::find($id);
        return view('adminHP.tapphim.form',compact('tapphim','list_phim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $tap =TapPhim::find($id);
        $phim = Phim ::all();
        $tap->phim_id = $data['phim_id'];
        $tap->sotap = $data['sotap'];
        $tap->link = $data['link'];
        $tap->sotap = $data['sotap'];
        $tap->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $tap->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tapphim = TapPhim ::find($id)->delete();
        return redirect()->route('phim.index');
    }

}
