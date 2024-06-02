@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table" id="Tablephim">
            <thead>
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Danh Muc</th>
                <th scope="col">Đường dẫn</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody class="order_position">
            @foreach($list as $key => $danhm)
                <tr>
                <th scope="row">{{$key}}</th>
                <td>{{$danhm -> title}}</td>
                <td>{{$danhm -> slug}}</td>
                <td>{{$danhm -> description}}</td>

                <td>
                    @if($danhm -> status)
                        Hiển Thị
                    @else
                        Không Hiển Thị
                    @endif
                </td>
                <td>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'route' =>['danhmuc.destroy',$danhm->id],
                        'onsubmit'=>'return confirm("Xóa hay không?")'
                    ]) !!}
                    {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <a href="{{route('danhmuc.edit',$danhm->id)}}" class="btn btn-warning">Sửa</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>


@endsection
