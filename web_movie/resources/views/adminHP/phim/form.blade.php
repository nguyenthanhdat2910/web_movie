@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Phim   </div>
                {{-- //thông báo lỗi --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $er)
                            <li>{{$er}}</li>

                        @endforeach
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($phim))
                    {!! Form::open(['route' =>'phim.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' =>['phim.update',$phim->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('title','Tên Phim',[]) !!}
                            {!! Form::text('title',isset($phim) ? $phim->title:'',['class'=>'form-control','placeholder'=>' ','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('Name','Tên Tiếng Anh ',[]) !!}
                            {!! Form::text('name_e',isset($phim) ? $phim->name_e:'',['class'=>'form-control','placeholder'=>' ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('trailer','Trailer Phim ',[]) !!}
                            {!! Form::text('trailer',isset($phim) ? $phim->trailer:'',['class'=>'form-control','placeholder'=>' ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug','Đường Dẫn',[]) !!}
                            {!! Form::text('slug',isset($phim) ? $phim->slug:'',['class'=>'form-control','placeholder'=>' ','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('time_phim','Thời Lượng',[]) !!}
                            {!! Form::text('time_phim',isset($phim) ? $phim->time_phim:'',['class'=>'form-control','placeholder'=>' ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tap_phim','Số Tập Phim',[]) !!}
                            {!! Form::text('tap_phim',isset($phim) ? $phim->tap_phim:'',['class'=>'form-control','placeholder'=>' ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','Mô tả',[]) !!}
                            {!! Form::textarea('description',isset($phim) ? $phim->description:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>' ','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags','Tags Phim',[]) !!}
                            {!! Form::textarea('tags',isset($phim) ? $phim->tags:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>' ']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status','Trạng Thái',[]) !!}
                            {!! Form::select('status',['1'=>'Hiển Thị ','0'=>'Không'], isset($phim) ? $phim->status:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('resolution','Định Dạng',[]) !!}
                            {!! Form::select('resolution',['1'=>'HD','0'=>'SD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer'], isset($phim) ? $phim->resolution:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vietsub','Vietsub',[]) !!}
                            {!! Form::select('vietsub',['1'=>'Thuyết minh','0'=>'Vietsub','2'=>'Lòng tiếng'], isset($phim) ? $phim->vietsub:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active','Active',[]) !!}
                            {!! Form::select('status',['1'=>'Hiển Thị ','0'=>'Không'], isset($phim) ? $phim->status:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('DanhMuc','Danh Mục',[]) !!}<br>
                            @foreach($list_danhmuc as $key => $phim_danhm)
                                @if(isset($phim))
                                    {!! Form::checkbox('danh_muc[]',$phim_danhm->id, isset($phim_danhmuc) && $phim_danhmuc->contains($phim_danhm->id) ? true : false ) !!}
                                @else
                                {!! Form::checkbox('danh_muc[]',$phim_danhm->id, '') !!}
                                @endif
                                {!! Form::label('danh_muc',$phim_danhm ->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('QuocGia','Quốc Gia',[]) !!}
                            {!! Form::select('quoc_gia_id',$quocgia, isset($phim) ? $phim->quoc_gia_id:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('TheLoai','Thể Loại',[]) !!}<br>

                            @foreach($list_theloai as $key => $thel)
                                <div>
                                    @if(isset($phim))
                                        {!! Form::checkbox('the_loai[]',$thel->id, isset($phim_the_loai) && $phim_the_loai->contains($thel->id) ? true : false ) !!}
                                    @else
                                    {!! Form::checkbox('the_loai[]',$thel->id, '' ) !!}
                                    @endif
                                    {!! Form::label('the_loai',$thel ->title) !!}
                                </div>

                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('phim_le','Loại Phim',[]) !!}
                            {!! Form::select('phim_le',['1'=>'Phim Lẻ','0'=>'Phim Bộ'], isset($phim) ? $phim->phim_le:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Hot','Phim hot',[]) !!}
                            {!! Form::select('hot',['1'=>'Hot','0'=>'Không'], isset($phim) ? $phim->hot:'',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Image','Hình Ảnh',[]) !!}
                            {!! Form::file('image',['class'=>'form-control-file']) !!}
                            @if(isset($phim))
                            <img width="50%" src="{{asset('upload/phim/'.$phim -> image)}}">
                            @endif
                        </div>

                    @if(!isset($phim))
                        {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập Nhật',['class'=>'btn btn-success']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
