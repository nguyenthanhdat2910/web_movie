<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use Faker\Provider\ar_EG\Text;
class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = DanhMuc::all();

        return view('adminHp.danhmuc.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminHp.danhmuc.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'title' => 'required|unique:danhmuc|max:255',
                'description' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Bạn Bỏ Trống Tên Danh Muc',
                'title.unique' => 'Tên Danh Muc Đã Tồn Tại',
                'description.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
                'slug.required' => 'Bạn Bỏ Trống slug',
                'status.required' => 'Chưa kích hoạt',
            ]
        );
        $danhmuc=new DanhMuc();
        $danhmuc->title = $data['title'];
        $danhmuc->slug = $data['slug'];
        $danhmuc->description = $data['description'];
        $danhmuc->status = $data['status'];

        $danhmuc->save();
        toastr()->success('Thành Công!', 'Thêm Danh Mục Thành Công');
        return redirect()->route('danhmuc.index');



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
        $danhmuc = DanhMuc::find($id);
        $list = DanhMuc::all();
        return view('adminHp.danhmuc.form',compact('list','danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'slug' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Bạn Bỏ Trống Tên Danh Muc',
                'description.required' => 'Bạn Bỏ Trống Thông Tin Mô Tả',
                'slug.required' => 'Bạn Bỏ Trống slug',
                'status.required' => 'Chưa kích hoạt',
            ]
        );
        $danhmuc= DanhMuc::find($id);
        $danhmuc->title = $data['title'];
        $danhmuc->slug = $data['slug'];
        $danhmuc->description = $data['description'];
        $danhmuc->status = $data['status'];
        $danhmuc->save();
        return redirect()->route('danhmuc.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DanhMuc ::find($id)->delete();
        toastr()->warning('Thành Công!', 'Xóa Danh Mục Thành Công');

        return redirect()->back();
    }

}
