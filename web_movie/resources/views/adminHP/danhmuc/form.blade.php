@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Danh Mục</div>
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

                    @if(!isset($danhmuc))
                    {!! Form::open(['route' =>'danhmuc.store','method'=>'POST']) !!}
                    @else
                    {!! Form::open(['route' =>['danhmuc.update',$danhmuc->id],'method'=>'PUT']) !!}
                    @endif

                        <div class="form-group" id="title">

                            {!! Form::label('title','Tên Danh Mục',[]) !!}

                            {!! Form::text('title',isset($danhmuc) ? $danhmuc->title:'',['class'=>'form-control','placeholder'=>' ','id'=>'slug','onkeyup'=>'ChangeToSlug()',]) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('slug','Đường dẫn',[]) !!}
                            {!! Form::text('slug',isset($danhmuc) ? $danhmuc->slug:'',['class'=>'form-control','placeholder'=>' ','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','Mô tả',[]) !!}
                            {!! Form::textarea('description',isset($danhmuc) ? $danhmuc->description:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>' ','id'=>'description',]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active','Trạng Thái',[]) !!}
                            {!! Form::select('status',['1'=>'Hiển Thị ','0'=>'Không'], isset($danhmuc) ? $danhmuc->status:'',['class'=>'form-control']) !!}
                        </div>
                    @if(!isset($danhmuc))
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
