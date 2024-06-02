@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{$quocgia_slug->title}}</a> » <span class="breadcrumb_last" aria-current="page">2023</span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
             <h1 class="section-title"><span>{{$quocgia_slug->title}}</span></h1>
          </div>
          <div class="section-bar clearfix">
                 @include('layouts.page.menu_locphim')

          </div>
          <div class="halim_box">
            @foreach($phim as $key => $pm)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('ct_phim',$pm->slug)}}">
                        <figure><img class="lazy img-responsive" src="{{asset('upload/phim/'.$pm->image)}}"
                           title="{{$pm->title}}"></figure>
                        <span class="status">
                           @if($pm -> resolution==0)
                              SD
                           @elseif($pm -> resolution==1)
                              HD
                           @elseif($pm -> resolution==2)
                              HDCam
                           @elseif($pm -> resolution==3)
                              Cam
                           @elseif($pm -> resolution==4)
                              FullHD
                           @else
                              Trailer
                           @endif
                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if($pm -> vietsub==0)
                              Vietsub
                           @elseif($pm -> vietsub==1)
                              Thuyết minh
                           @else
                              Lòng tiếng
                           @endif
                           @if($pm-> season!=0)
                              - Season {{$pm->season}}
                           @endif
                        </span>
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$pm->title}}</p>
                              <p class="original_title">{{$pm->name_e}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
            @endforeach
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {!! $phim->links("pagination::bootstrap-4")!!}
          </div>
       </section>
    </main>
    @include('layouts.page.sidebar')
 </div>

 @endsection
