@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>

            <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>PHIM HOT</span></h3>
                     </div>
                     <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                     @foreach($phimhot as $key => $hot)
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('ct_phim',$hot->slug)}}" title="{{$hot->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('upload/phim/'.$hot->image)}}"
                                 alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                                 <span class="status">
                                    @if($hot -> resolution==0)
                                       SD
                                    @elseif($hot -> resolution==1)
                                       HD
                                    @elseif($hot -> resolution==2)
                                       HDCam
                                    @elseif($hot -> resolution==3)
                                       Cam
                                    @elseif($hot -> resolution==4)
                                       FullHD
                                    @else
                                       Trailer
                                    @endif
                                 </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($hot -> vietsub==0)
                                       Vietsub
                                    @elseif($hot -> vietsub==1)
                                       Thuyết minh
                                    @else
                                       Lòng tiếng
                                    @endif
                                    @if($hot-> season!=0)
                                       - Season {{$hot->season}}
                                    @endif
                                 </span>
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$hot->title}}</p>
                                       <p class="original_title">{{$hot->name_e}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                     @endforeach

                     </div>
                     <script>
                        jQuery(document).ready(function($) {
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel(
                           {
                              loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,
                              autoplayHoverPause: true,nav: true,navText: ['<i class="fa fa-left"></i>',
                               '<i class="fa fa-right"></i>'],responsiveClass: true,responsive:
                               {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 5}}})});
                     </script>
                  </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">

               @foreach($danhmuc_home as $key => $danhm_home)
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                    <style type="text/css">
                        .xem-them{position:absolute;right:0;font-weight:400;line-height:21px,padding:9px 25px 9px 0px 10px;}
                    </style>
                     <span class="h-text">{{$danhm_home->title}}</span>
                     <a href={{route('danh_muc',$danhm_home->slug)}} class="xem-them" title="xem thêm">
                        <span class="h-text">Xem Thêm...</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                    @foreach($phim_danhmuc as $key => $moive)
                        @foreach($moive->phim_danh_muc as $key => $phim_dm)
                            @if($phim_dm->id==$danhm_home->id)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                <a class="halim-thumb" href="{{route('ct_phim',$moive->slug)}}">
                                    <figure><img class="lazy img-responsive" src="{{asset('upload/phim/'.$moive->image)}}"
                                    title="{{$moive->title}}"></figure>
                                    <span class="status">
                                            @if($moive -> resolution==0)
                                                SD
                                            @elseif($moive -> resolution==1)
                                            HD
                                            @elseif($moive-> resolution==2)
                                            HDCam
                                            @elseif($moive -> resolution==3)
                                            Cam
                                            @elseif($moive -> resolution==4)
                                            FullHD
                                            @else
                                            Trailer
                                            @endif
                                    </span>
                                    <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if($moive -> vietsub==0)
                                            Vietsub
                                            @elseif($moive -> vietsub==1)
                                            Thuyết minh
                                            @else
                                            Lòng tiếng
                                            @endif
                                            @if($moive-> season!=0)
                                            - Season {{$moive->season}}
                                            @endif
                                    </span>
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">{{$moive->title}}</p>
                                            <p class="original_title">{{$moive->name_e}}</p>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </article>

                           @endif
                        @endforeach
                    @endforeach


                  </div>
               </section>
               <div class="clearfix"></div>
               @endforeach
            </main>
            <!--Sidebar-->
            @include('layouts.page.sidebar')
         </div>

@endsection
