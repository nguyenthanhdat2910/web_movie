<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
            <span>Phim Hot</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">

                @foreach($phimhot_sidebar as $key => $hot_phim)
                @if($hot_phim-> resolution!=5)
                <div class="item post-37176">
                    <a href="{{route('ct_phim',$hot_phim->slug)}}" title="{{route('ct_phim',$hot_phim->slug)}}">
                        <div class="item-link">
                        <img src="{{asset('upload/phim/'.$hot_phim->image)}}" class="lazy post-thumb"
                        alt="{{$hot_phim->title}}" title="{{$hot_phim->title}}" />
                        <span class="is_trailer">
                            @if($hot_phim -> resolution==0)
                                SD
                            @elseif($hot_phim -> resolution==1)
                                HD
                            @elseif($hot_phim -> resolution==2)
                                HDCam
                            @elseif($hot_phim -> resolution==3)
                                Cam
                            @elseif($hot_phim -> resolution==4)
                                FullHD
                            @else
                                Trailer
                            @endif
                        </span>
                        </div>
                        <p class="title">{{$hot_phim->title}}</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">
                        @if($hot_phim->views>0)
                            {{$hot_phim->views}} lượt xem
                        @endif
                    </div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    <!--Phim trailer-->
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
            <span>Phim Sắp Chiếu</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
                @foreach($phimhot_trailer as $key => $hot_trailer)
                <div class="item post-37176">
                    <a href="{{route('ct_phim',$hot_trailer->slug)}}" title="{{route('ct_phim',$hot_trailer->slug)}}">
                        <div class="item-link">
                        <img src="{{asset('upload/phim/'.$hot_trailer->image)}}" class="lazy post-thumb"
                        alt="{{$hot_trailer->title}}" title="{{$hot_trailer->title}}" />
                        <span class="is_trailer">
                            @if($hot_trailer -> resolution==0)
                                SD
                            @elseif($hot_trailer -> resolution==1)
                                HD
                            @elseif($hot_trailer -> resolution==2)
                                HDCam
                            @elseif($hot_trailer -> resolution==3)
                                Cam
                            @elseif($hot_trailer -> resolution==4)
                                FullHD
                            @else
                                Trailer
                            @endif
                        </span>
                        </div>
                        <p class="title">{{$hot_trailer->title}}</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">
                        @if($hot_trailer->views>0)
                            {{$hot_trailer->views}} lượt xem
                        @endif
                    </div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                        <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>

    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link filter-sidebar" id="pills-home-tab"
            data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
        </li>
        <li class="nav-item">
            <a class="nav-link filter-sidebar" id="pills-profile-tab"
            data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
        </li>
        <li class="nav-item">
            <a class="nav-link filter-sidebar" id="pills-contact-tab"
            data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
        </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
                    <div id="halim-ajax-popular-post-home" class="popular-post">
                        <span id="show_home"></span>
                    </div>
            <div class="tab-pane fade" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show0"></span>
                    </div>

            </div>

            <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show1"></span>
                    </div>
            </div>

            <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show2"></span>
                    </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
</aside>
