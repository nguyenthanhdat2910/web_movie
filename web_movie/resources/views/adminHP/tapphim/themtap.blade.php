@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Tập Phim   </div>
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
                                {!! Form::label('phim_title','Chon Phim',[]) !!}
                                {!! Form::text('phim_title',isset($phim) ? $phim->title:'',['class'=>'form-control', 'readonly']) !!}
                                {!! Form::hidden('phim_id',isset($phim) ? $phim->id:'') !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('link','Link Phim',[]) !!}
                                {!! Form::text('link', isset($phim) ? $phim->link:'',['class'=>'form-control']) !!}
                            </div>


                            <div class="form-group">
                                {!! Form::label('tap','Tap Phim',[]) !!}
                                @if(!isset($tapphim))
                                {!! Form::selectRange('sotap',1,$phim->tap_phim,$phim->sotap,['class'=>'form-control']) !!}
                                @else

                                {!! Form::text('sotap', isset($tapphim) ? $tapphim->sotap:'',['class'=>'form-control','placeholder'=>'...','readonly']) !!}

                                @endif

                            </div>

                            {!! Form::submit('Thêm Tập Phim',['class'=>'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
            </div>

        </div>

        <div class="col-md-12">

            <table class="table" id="Tablephim">
                <thead>
                    <tr>

                    <th scope="col">Tên Phim</th>
                    <th scope="col">Tập Phim</th>
                    <th scope="col">Hinh Anh</th>
                    <th scope="col">Link Phim</th>
                    <th scope="col">Chỉnh Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_tap as $key => $tap)

                    <tr>
                    <td>{{$tap ->phim-> title}}</td>
                    <td>{{$tap -> sotap}}</td>
                    <td><img width="100%" src="{{asset('upload/phim/'.$tap->phim -> image)}}"></td>
                    <td>{{$tap -> link}}</td>


                    <td>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' =>['tapphim.destroy',$tap->id],
                            'onsubmit'=>'return confirm("Xóa hay không?")'
                        ]) !!}
                        {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('tapphim.edit',$tap->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
