@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table" id="Tablephim">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Thể Loại</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Chỉnh Sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $key => $theloai)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$theloai -> title}}</td>
                        <td>{{$theloai -> description}}</td>
                        <td>
                            @if($theloai -> status)
                                Hiển Thị
                            @else
                                Không Hiển Thị
                            @endif
                        </td>
                        <td>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' =>['theloai.destroy',$theloai->id],
                                'onsubmit'=>'return confirm("Xóa hay không?")'
                            ]) !!}
                            {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('theloai.edit',$theloai->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
