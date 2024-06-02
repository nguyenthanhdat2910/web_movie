@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Thông Tin WebSite</div>
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

                     @if(!isset($info))
                    {!! Form::open(['route' =>'info.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' =>['info.update',$info->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                        <div class="form-group" id="title">

                            {!! Form::label('title','Tên Thông Tin',[]) !!}

                            {!! Form::text('title',isset($info) ? $info->title:'',['class'=>'form-control','placeholder'=>' ',]) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('mota','Mô tả',[]) !!}
                            {!! Form::textarea('mota',isset($info) ? $info->mota:'',['style'=>'resize:none','class'=>'form-control','placeholder'=>' ',]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('logo','Hình Ảnh',[]) !!}
                            {!! Form::file('logo',['class'=>'form-control-file']) !!}
                            @if(isset($info))
                            <img width="50%" src="{{asset('upload/logo/'.$info -> logo)}}">
                            @endif
                        </div>
                    @if(!isset($info))
                        {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập Nhật',['class'=>'btn btn-success']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
            <table class="table" id="Tablephim">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Danh Muc</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody class="order_position">
                @foreach($list as $key => $inf)
                    <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$inf -> title}}</td>
                    <td>
                        <img width="25%" class="img" src="{{asset('upload/logo/'.$inf -> logo)}}">
                    </td>


                    <td>{{$inf -> mota}}</td>


                    <td>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' =>['info.destroy',$inf->id],
                            'onsubmit'=>'return confirm("Xóa hay không?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('info.edit',$inf->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
