<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuocGia;
use Session;
session_start();
class QuocGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = QuocGia::all();
        return view('adminHp.quocgia.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminHp.quocgia.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:quocgia|max:255',
            'description' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ],
        [
            'title.required' => 'Bạn Bỏ Trống Tên Quốc Gia',
            'title.unique' => 'Tên Quốc Gia Dã Tồn Tại',
            'title.max' => 'Tên Không Tồn Tại Quốc Gia Này',
            'description.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
            'slug.required' => 'Bạn Bỏ Đường Dẫn',
            'status.required' => 'Bạn Chưa Chọn Hiển Thị Hay Không',
        ]
    );
        $quocgia=new QuocGia();
        $quocgia->title = $data['title'];
        $quocgia->slug = $data['slug'];
        $quocgia->description = $data['description'];
        $quocgia->status = $data['status'];

        $quocgia->save();
        toastr()->success('Thành Công!', 'Thêm Quốc Gia Thành Công');
        return redirect()->route('quocgia.index');



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
        $quocgia = QuocGia::find($id);
        $list = QuocGia::all();
        return view('adminHp.quocgia.form',compact('list','quocgia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $quocgia= QuocGia::find($id);
        $quocgia->title = $data['title'];
        $quocgia->slug = $data['slug'];
        $quocgia->description = $data['description'];
        $quocgia->status = $data['status'];
        $quocgia->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        QuocGia ::find($id)->delete();
        return redirect()->back();
    }
}
