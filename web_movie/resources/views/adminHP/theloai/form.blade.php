@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Thể Loại</div>
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

                    @if(!isset($theloai))
                    {!! Form::open(['route' =>'theloai.store','method'=>'POST']) !!}
                    @else
                    {!! Form::open(['route' =>['theloai.update',$theloai->id],'method'=>'PUT']) !!}
                    @endif
                        <style>
                            .text-mess{color:red;}
                        </style>
                        <?php
                            $mess = Session::get('mess');
                            if($mess){
                                echo '<h4 class="text-mess">'.$mess.'</h4>';
                                Session::put('mess',null);
                            }
                        ?>
                        <div class="form-group">
                            {!! Form::label('title','Tên Thể Loại',[]) !!}
                            {!! Form::text('title',isset($theloai) ? $theloai->title:'',['class'=>'form-control','placeholder'=>' ','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug','Đường Dẫn',[]) !!}
                            {!! Form::text('slug',isset($theloai) ? $theloai->slug:'',['class'=>'form-control','placeholder'=>' ','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','Mô Tả',[]) !!}
                            {!! Form::textarea('description',isset($theloai) ? $theloai->description:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>' ','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active','Trạng Thái',[]) !!}
                            {!! Form::select('status',['1'=>'Hiển Thị ','0'=>'Không'], isset($theloai) ? $theloai->status:'',['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($theloai))
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
