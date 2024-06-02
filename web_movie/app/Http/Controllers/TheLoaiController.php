<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use Session;
session_start();
class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = TheLoai::all();

        return view('adminHp.theloai.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('adminHp.theloai.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'title' => 'required|unique:theloai|max:255',
                'description' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Bạn Bỏ Trống Tên Thể Loại',
                'title.unique' => 'Tên Thể Loại Đã Tồn Tại',
                'description.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
                'slug.required' => 'Bạn Bỏ Trống slug',
                'status.required' => 'Chưa kích hoạt',
            ]
        );
        $theloai=new Theloai();
        $theloai->title = $data['title'];
        $theloai->slug = $data['slug'];
        $theloai->description = $data['description'];
        $theloai->status = $data['status'];
        $theloai->save();
        toastr()->success('Thành Công!', 'Thêm Thể Loại Thành Công');
        return redirect()->route('theloai.index');

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
        $theloai = TheLoai::find($id);
        $list = TheLoai::all();
        return view('adminHp.theloai.form',compact('list','theloai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $theloai= TheLoai::find($id);
        $theloai->title = $data['title'];
        $theloai->slug = $data['slug'];
        $theloai->description = $data['description'];
        $theloai->status = $data['status'];
        $theloai->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Theloai ::find($id)->delete();
        return redirect()->back();
    }
}
