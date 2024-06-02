@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="Tablephim">
                        <thead>
                            <tr>
                            <th scope="col">Tên Phim</th>
                            <th scope="col">Thời Lượng</th>
                            <th scope="col">Số Tập Phim</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tags Phim</th>
                            <th scope="col">Định Dạng</th>
                            <th scope="col">Loại Phim</th>
                            <th scope="col">Phim Hot</th>
                            <th scope="col">Vietsub</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Quốc Gia</th>
                            <th scope="col">Thể Loại</th>
                            <th scope="col">Top View</th>
                            <th scope="col">Năm</th>
                                <th scope="col">Ngày Tạo</th>
                            <th scope="col">Ngày Cập Nhất</th>
                            <th scope="col">Chỉnh sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $key => $phim)
                            <tr>
                                <td>{{$phim -> title}}</td>
                                <td>{{$phim -> time_phim}}</td>
                                <td>
                                    @if($phim -> phim_le==1)
                                        @if($phim->tapphim_count==0)
                                            <a href="{{route('add-ep',[$phim->id])}}" class="btn btn-danger">Chưa Có Phim</a>
                                        @else
                                           <a href="{{route('add-ep',[$phim->id])}}" class="btn btn-primary">Phim Lẻ</a>
                                        @endif

                                    @else
                                        <a class="form-control" >{{$phim->tapphim_count}}/{{$phim -> tap_phim}} Tập</a>
                                        <a href="{{route('add-ep',[$phim->id])}}" class="btn btn-primary">Thêm Tập</a>
                                    @endif
                                </td>
                                <td>

                                        <img width="50%"  src="{{asset('upload/phim/'.$phim -> image)}}">
                                        <input type="file"  data-movie_id="{{$phim->id}}" id="file-{{$phim->id}}" class=" file_image" accpet="image/*">


                                </td>
                                    <td>@if($phim->tags!=NULL)
                                        {{substr($phim -> tags,0,30)}}...
                                    @else

                                    @endif
                                </td>
                                <td>
                                    @php
                                        $options = array('0'=>'SD','1'=>'HD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer');
                                    @endphp

                                    <select id="{{$phim->id}}" class="thay-resolution">
                                        @foreach($options as $key => $re)
                                            <option {{$phim->resolution==$key ? 'selected' :''}} value="{{$key}}">{{$re}}</option>
                                        @endforeach
                                    </select>

                                </td>

                                <td>
                                    <select id="{{$phim->id}}" class="thay-phim-le">
                                        @if($phim -> phim_le==0)
                                            <option value="1">Phim Lẻ</option>
                                            <option selected value="0">Phim Bộ</option>
                                        @else
                                            <option selected value="1">Phim Lẻ</option>
                                            <option  value="0">Phim Bộ</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select id="{{$phim->id}}" class="thay-hot">
                                        @if($phim -> hot==0)
                                            <option value="1">Hot</option>
                                            <option selected value="0">Không</option>
                                        @else
                                                <option selected value="1">Hot</option>
                                            <option  value="0">Không</option>
                                        @endif
                                    </select>

                                </td>
                                <td>
                                    <select id="{{$phim->id}}" class="thay-vietsub">
                                        @if($phim -> vietsub==0)
                                            <option selected value="0">Vietsub</option>
                                            <option  value="1">Thuyết Minh</option>
                                            <option  value="2">Lòng Tiếng</option>
                                        @elseif($phim -> vietsub==1)
                                            <option  value="0">Vietsub</option>
                                            <option  selected value="1">Thuyết Minh</option>
                                            <option  value="2">Lòng Tiếng</option>
                                        @else
                                            <option  value="0">Vietsub</option>
                                            <option  value="1">Thuyết Minh</option>
                                            <option  selected value="2">Lòng Tiếng</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select id="{{$phim->id}}" class="thay-status">
                                        @if($phim -> status==0)
                                            <option value="1">Hiểu Thị</option>
                                            <option selected value="0">Không Hiển Thị</option>
                                        @else
                                            <option selected value="1">Hiển Thị</option>
                                            <option  value="0">Không Hiển Thị</option>
                                        @endif
                                    </select>

                                </td>
                                <td>
                                    @foreach($phim->phim_danh_muc as $danhm)
                                        <span class="badge badge-dark">{{$danhm->title}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {!! Form::select('quoc_gia_id',$quocgia, isset($phim) ? $phim->quocgia->id:'',['class'=>'thay-doi-quocgia','id'=>$phim->id]) !!}
                                </td>

                                <td>
                                    @foreach($phim->phim_the_loai as $theloai)
                                        <span class="badge badge-dark">{{$theloai->title}}</span>
                                    @endforeach
                                </td>


                                <td>
                                    {!! Form::select('topview',['0'=>'ngày','1'=>'tuần','2'=>'tháng'], isset($phim->topview) ? $phim->topview:'',['class'=>'select-topview','placeholder'=>'-- Views --','id'=>$phim->id]) !!}
                                </td>
                                <td>
                                    {!! Form::selectYear('year',1995,2030,isset($phim->year)? $phim->year:'',['class'=>'select-year','placeholder'=>'-- Năm Phim --','id'=>$phim->id]) !!}
                                </td>
                                <td>{{$phim -> ngaytao}}</td>
                                <td>{{$phim -> ngaycapnhat}}</td>
                                <td>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'route' =>['phim.destroy',$phim->id],
                                        'onsubmit'=>'return confirm("Xóa hay không?")'
                                    ]) !!}
                                    {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{route('phim.edit',$phim->id)}}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
