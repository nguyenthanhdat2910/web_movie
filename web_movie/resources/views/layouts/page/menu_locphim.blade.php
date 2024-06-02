<div class="row">
                <form action="{{route('locphim')}}" method="GET" >
                    <style type="text/css">
                        .form{border:0;background:#12171b;color:#fff}
                        .btn{border:0 #b2b7bb;background:#12171b;color:#fff;padding:9px}
                    </style>
                    <div class="col-md-2">
                        <div class="form-group">

                            <select class="form-control form" name="sap_xep">
                              <option value="">--Sắp Xếp--</option>
                                <option value="ngaytao">Ngày Đăng</option>
                                <option value="year">Năm Phim</option>
                                <option value="title">Tên Phim</option>
                                <option value="topview">Lượt Xem</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <select class="form-control form" name="the_loai">
                                <option value="">-- Thể Loại --</option>
                                @foreach($theloai_h as $key => $thel  )
                                     <option {{ (isset($_GET['the_loai']) && $_GET['the_loai']==$thel->id) ? 'selected' : ''}} value="{{$thel->id}}">{{$thel->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <select class="form-control form" name="quoc_gia">

                                 <option value="">-- Quốc Gia --</option>
                                @foreach($quocgia_h as $key => $quoc  )
                                     <option  {{ (isset($_GET['quoc_gia']) && $_GET['quoc_gia']==$quoc->id) ? 'selected' : ''}} value="{{$quoc->id}}">{{$quoc->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                                @php
                                    if(isset($_GET['year'])){
                                         $year = $_GET['year'];
                                    }else{
                                        $year=null;
                                    }
                                @endphp
                               {!! Form::selectYear('year',1995,2030,$year,['class'=>'form-control form','placeholder'=>'-- Năm Phim --']) !!}
                        </div>

                    </div>

                     <div class="col-md-1">

                         <input type="submit" value="Lọc Phim" class="btn btn-sm btn-default ">
                    </div>

                </form>
            </div>
