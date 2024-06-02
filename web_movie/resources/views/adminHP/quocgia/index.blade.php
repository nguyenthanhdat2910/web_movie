@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table" id="Tablephim">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Quốc Gia</th>
                    <th scope="col">Đường Dẫn</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Chỉnh Sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $key => $quocgia)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$quocgia -> title}}</td>
                        <td>{{$quocgia -> slug}}</td>
                        <td>{{$quocgia -> description}}</td>
                        <td>
                            @if($quocgia -> status)
                                Hiển Thị
                            @else
                                Không Hiển Thị
                            @endif
                        </td>
                        <td>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' =>['quocgia.destroy',$quocgia->id],
                                'onsubmit'=>'return confirm("Xóa hay không?")'
                            ]) !!}
                            {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('quocgia.edit',$quocgia->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
