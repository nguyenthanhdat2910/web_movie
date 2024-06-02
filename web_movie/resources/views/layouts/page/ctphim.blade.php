@extends('layout')
@section('content')
<div class="container">
    <div class="row container" id="wrapper">
       <div class="halim-panel-filter">
          <div class="panel-heading">
             <div class="row">
                <div class="col-xs-6">
                   <div class="yoast_breadcrumb hidden-xs"><span>
                   <span>
                    @foreach($phim->phim_danh_muc as $key => $danhm)
                        <a href="{{route('danh_muc',[$danhm->slug])}}">{{$danhm->title}}</a> »
                     @endforeach
                     <a href="{{route('quoc_gia',$phim->quocgia->slug)}}">{{$phim->quocgia->title}}</a> »
                     @foreach($phim->phim_the_loai as $key => $theL)
                        <a href="{{route('the_loai_phim',[$theL->slug])}}">{{$theL->title}}</a> »
                     @endforeach

                     </span></span></span></div>
                </div>
             </div>
          </div>
          <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
             <div class="ajax"></div>
          </div>
       </div>
       <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
          <section id="content" class="test">
             <div class="clearfix wrap-content">

                <div class="halim-movie-wrapper">
                   <div class="title-block">
                      <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                         <div class="halim-pulse-ring"></div>
                      </div>
                      <div class="title-wrapper" style="font-weight: bold;">
                         Bookmark
                      </div>
                   </div>
                   <div class="movie_info col-xs-12">
                      <div class="movie-poster col-md-3">
                           <img class="movie-thumb" src="{{asset('upload/phim/'.$phim->image)}}"alt="{{$phim->title}}">

                              @if($phim->resolution!=5)
                                 @if($phim->phim_le==1)
                                    <div class="bwa-content">
                                       <div class="loader"></div>
                                       <a href="{{url('chieu_phim/'.$phim->slug.'/tap-1')}}" class="bwac-btn">
                                            <i class="fa fa-play"></i>
                                       </a>
                                    </div>
                                 @else
                                    @if($so_tap>0)
                                        <div class="bwa-content">
                                       <div class="loader"></div>
                                       <a href="{{url('chieu_phim/'.$phim->slug.'/tap-'.$tap1->sotap)}}" class="bwac-btn">
                                       <i class="fa fa-play"></i>
                                       </a>
                                    </div>
                                    @endif

                                    @endif

                              @else
                                 <a href="#trailer" style="display:block;" class="btn btn-primary">Trailer</a>
                              @endif
                      </div>
                      <div class="film-poster col-md-9">
                         <h1 class="movie-title title-1" style="
                         display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;"
                         >{{$phim->title}}</h1>
                         <h2 class="movie-title title-2" style="font-size: 12px;">{{$phim->name_e}}</h2>
                         <ul class="list-info-group">
                           <li class="list-info-group-item"><span>Trạng Thái</span> :
                           <span class="quality">
                              @if($phim -> resolution==0)
                                 SD
                              @elseif($phim -> resolution==1)
                                 HD
                              @elseif($phim -> resolution==2)
                                 HDCam
                              @elseif($phim -> resolution==3)
                                 Cam
                              @else
                                 FullHD
                              @endif
                           </span><span class="episode">
                              @if($phim -> vietsub==0)
                                 Vietsub
                              @elseif($phim -> vietsub==1)
                                 Thuyết minh
                              @else
                                 Lòng tiếng
                              @endif

                           </span></li>
                           <li class="list-info-group-item"><span>Thời lượng</span> : {{$phim->time_phim }}</li>

                           @if($phim->phim_le==1)
                              <li class="list-info-group-item"><span> Phim Lẻ</span>
                           @else
                              <li class="list-info-group-item"><span>Tập Phim</span> :
                              {{$so_tap}} /
                                 @if($so_tap==$phim->tap_phim)
                                   {{$phim->tap_phim }}
                                 @else
                                    ...
                                 @endif
                           @endif

                           </li>
                           @if($phim-> season!=0)
                              <li class="list-info-group-item"><span>Season</span> : {{$phim->season }}</li>
                           @endif
                           <li class="list-info-group-item"><span>Thể loại</span> :
                              @foreach($phim->phim_the_loai as $thel)
                                 <a href="{{route('the_loai_phim',$thel->slug)}}" rel="the loai tag">{{$thel->title}} </a>
                              @endforeach
                           </li>
                           <li class="list-info-group-item"><span>Danh mục phim</span> :
                              @foreach($phim->phim_danh_muc as $danhm)
                                 <a href="{{route('danh_muc',$danhm->slug)}}" rel="danh muc tag">{{$danhm->title}} </a>
                              @endforeach
                           </li>
                           <li class="list-info-group-item"><span>Quốc gia</span> :
                              <a href="{{route('quoc_gia',$phim->quocgia->slug)}}" rel="quoc gia tag">{{$phim->quocgia->title}}</a>
                           </li>

                           @if($phim->phim_le==1)

                           @else
                           <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                              @foreach($tapphim as $key =>$tap)
                              <a href="{{url('chieu_phim/'.$phim->slug.'/tap-'.$tap->sotap)}}" rel="tap phim tag">Tập {{$tap->sotap}}</a>
                              @endforeach
                           @endif
                           </li>



                         </ul>
                         <div class="movie-trailer hidden"></div>
                      </div>
                   </div>
                </div>
                <div class="clearfix"></div>
                <div id="halim_trailer"></div>
                <div class="clearfix"></div>
                <div class="section-bar clearfix">
                   <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                   <div class="video-item halim-entry-box">
                      <article id="post-38424" class="item-content">
                        {{$phim->description}}
                      </article>
                   </div>
                </div>
               <!--Tags Phim-->
                <div class="section-bar clearfix">
                   <h2 class="section-title"><span style="color:#ffed4d">Tags Phim</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                   <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                           @php
                              $tags = array();
                              $tags = explode(',',$phim->tags);
                           @endphp
                           @foreach($tags as $key=> $tag)
                              <a href="{{url('tag/'.$tag)}}" rel="category tag">{{$tag}}</a>
                           @endforeach
                        </article>
                   </div>
                </div>

               <!--Trailer Phim-->
               <div class="section-bar clearfix">
                  <h2 class="section-title"><span style="color:#ffed4d">Trailer Phim</span></h2>
               </div>
               @if($phim->trailer!=NULL)
               <div class="entry-content htmlwrap clearfix">
                  <div class="video-item halim-entry-box">
                        <article id="trailer" class="item-content">
                        <iframe width="75%" height="315" src="https://www.youtube.com/embed/{{$phim->trailer}}"
                           title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;
                           clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </article>
                  </div>
               </div>
               @endif
               <!--Bình Luân-->
               <div class="section-bar clearfix">
                   <h2 class="section-title"><span style="color:#ffed4d">Bình Luận</span></h2>
                </div>
                <div class="entry-content htmlwrap clearfix">
                  @php
                     $url = Request::url();
                  @endphp
                   <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                        <div class="fb-comments" data-href="{{$url}}"
                        data-width="100%" data-numposts="10"></div>
                        </article>
                   </div>

                </div>


             </div>
          </section>
          <section class="related-movies">
             <div id="halim_related_movies-2xx" class="wrap-slider">
                <div class="section-bar clearfix">
                   <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                </div>
                <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                  @foreach($phim_lienquan as $key => $phim)
                     <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('ct_phim',$phim->slug)}}" title="{{$phim->title}}">
                              <figure><img class="lazy img-responsive" src="{{asset('upload/phim/'.$phim->image)}}"
                              alt="{{$phim->title}}" title="{{$phim->title}}"></figure>
                              <span class="status">
                                 @if($phim -> resolution==0)
                                    SD
                                 @elseif($phim -> resolution==1)
                                    HD
                                 @elseif($phim -> resolution==2)
                                    HDCam
                                 @elseif($phim -> resolution==3)
                                    Cam
                                 @elseif($phim -> resolution==4)
                                    FullHD
                                 @else
                                    Trailer
                                 @endif
                              </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                 @if($phim -> vietsub==0)
                                    Vietsub
                                 @elseif($phim -> vietsub==1)
                                    Thuyết minh
                                 @else
                                    Lòng tiếng
                                 @endif
                                 @if($phim-> season!=0)
                                    - Season {{$phim->season}}
                                  @endif
                              </span>
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$phim->title}}</p>
                                    <p class="original_title">{{$phim->name_e}}</p>
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
                   owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                </script>
             </div>
          </section>
       </main>
       @include('layouts.page.sidebar')
    </div>
 </div>

@endsection
