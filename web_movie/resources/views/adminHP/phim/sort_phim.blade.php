@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Xắp Xếp Phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav class="navbar navbar-inverse" >
                        <div class="container-fluid">
                            <ul class="nav navbar-nav menu-position" id="sortable-nav">

                                @foreach($danhmuc as $key => $dm)
                                    <li id="{{$dm->id}}" class="ui-state-default"><a title="{{$dm->title}}" href="">{{$dm->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                    @foreach($danhmuc_menu as $key => $dm_menu)
                        <p class="title-danhmuc">{{$dm_menu->title}}:</p>
                        <div class="row phim-position">
                            @foreach($phim_sort as $key => $phim_home)
                                @foreach($phim_home->phim_danh_muc as $key => $phim_dm)
                                    @if($phim_dm->id==$dm_menu->id)
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 box-phim" id="{{$phim_home->id}}">
                                            <img class="lazy img-responsive" src="{{asset('upload/phim/'.$phim_home->image)}}"title="{{$phim_home->title}}">
                                            <p class="entry-title">{{$phim_home->title}}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
