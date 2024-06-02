@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('tapphim.create')}}" class="btn btn-primary">Thêm Tập Phim</a>
            <table class="table" id="Tablephim">
                <thead>
                    <tr>
                    <th scope="col">#</th>
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
                    <th scope="row">{{$key}}</th>
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
