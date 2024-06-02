@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <a href="{{route('tapphim.index')}}" class="btn btn-primary">Danh Sách Tập Phim</a>
                <div class="card-header">Quản Lý Tập Phim   </div>
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

                    @if(!isset($tapphim))
                    {!! Form::open(['route' =>'tapphim.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' =>['tapphim.update',$tapphim->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                        <div class="form-group">
                            {!! Form::label('phim','Chọn Phim',[]) !!}
                            {!! Form::select('phim_id',['0'=>'Chon Phim','Danh Sach Phim'=>$list_phim], isset($tapphim) ?
                                 $tapphim->phim_id:'',['class'=>'form-control select-movie']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('link','Link Phim',[]) !!}
                            {!! Form::text('link', isset($tapphim) ? $tapphim->link:'',['class'=>'form-control']) !!}
                        </div>


                        <div class="form-group">
                            {!! Form::label('tap','Tập Phim',[]) !!}
                            @if(!isset($tapphim))
                                <select name="sotap" class="form-control" id="tap">

                                </select>
                            @else

                                    <div class="form-group">
                                    {!! Form::text('sotap', isset($tapphim) ? $tapphim->sotap:'',['class'=>'form-control','placeholder'=>'...','readonly']) !!}</div>
                            @endif
                        </div>


                    @if(!isset($tapphim))
                        {!! Form::submit('Thêm Tập Phim',['class'=>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập Nhật Tập Phim',['class'=>'btn btn-success']) !!}
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
