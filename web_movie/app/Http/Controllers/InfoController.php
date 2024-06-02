<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Info::all();

        return view('adminHp.thongtin.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'title' => 'required|unique:danhmuc|max:255',
                'mota' => 'required',
            ],
            [
                'title.required' => 'Bạn Bỏ Trống Tên Danh Muc',
                'title.unique' => 'Tên Danh Muc Dã Tồn Tại',
                'mota.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
            ]
        );
        $info=new Info();
        $info->title = $data['title'];
        $info->mota = $data['mota'];

        $get_image = $request->file('logo');


        //thuc hien them hinh anh
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/logo/',$new_image);
            $info->logo= $new_image;

        }


        $info->save();
        toastr()->success('Thành Công!', 'Thêm Thành Công');
        return redirect()->back();
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
        $info = Info::find($id);
        $list = Info::all();
        return view('adminHp.thongtin.form',compact('list','info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $info = Info ::find($id);
        $info->title = $data['title'];
        $info->mota = $data['mota'];

        $get_image = $request->file('logo');


        //thuc hien them hinh anh
        if($get_image){
            if(file_exists('upload/logo/'.$info->logo)){
                unlink('upload/logo/'.$info->logo);
            }else{
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('upload/logo/',$new_image);
                $info->logo= $new_image;
            }

        }


        $info->save();
        toastr()->success('Thành Công!', 'Thêm Thành Công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info = Info ::find($id);
        if(file_exists('upload/logo/'.$info->logo)){
            unlink('upload/logo/'.$info->logo);
        }

        $info->delete();
        return redirect()->back();
    }
}
