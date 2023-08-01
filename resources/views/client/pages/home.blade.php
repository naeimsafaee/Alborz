@extends('client.index')

@section('content')
    <div style="position: relative" class="col-lg-12 col-md-12 col-sm-12">

        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img class="red-circle" src="client/assets/icon/Ellipse 3.2.svg">
                    <div id="owl-carousel1" class="owl-carousel owl-theme">
                        @foreach($slides as $slide)
                            <a href="{{$slide ->link}}">
                                <div class="item">
                                    <p class="text">
                                        {{$slide->subtitle}}
                                    </p>
                                    <h1>
                                        {{$slide->title}}

                                    </h1>
                                    <p>
                                        {{$slide->description}}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="start-row">
                        <a class="online-test" href="{{ route('contact_us') }}">
                            <img src="client/assets/icon/test-list-pen-edit%201.svg">
                            مشاوره
                        </a>
                        <a class="about-us" data-toggle="modal" data-target="#myModal">
                            <div class="video-button">
                                <img class="video" src="client/assets/icon/video.svg">
                                <img class="black-dash" src="client/assets/icon/black-dash.svg">
                            </div>

                            درباره ما
                        </a>

                    </div>

                </div>
                <div class="ellipse-row col-lg-7 col-md-6 col-sm-12">
                    <img class="ellipse" src="client/assets/icon/Ellipse%203.svg">
                    <img class="ellipse2" src="client/assets/icon/Ellipse%204.svg">
                    <img class="ellipse3" src="client/assets/icon/Ellipse%202.svg">
                    <img class="ellipse4" src="client/assets/icon/Ellipse%203.2-1.svg">
                    <img class="ellipse5" src="client/assets/icon/Ellipse%203.3.svg">
                    <div class="image-1">
                        <img src="{{ get_image(setting('mainpic.slider1')) }}">

                    </div>
                    <div class="image-2">
                        <img src="{{ get_image(setting('mainpic.slider2')) }}">

                    </div>
                    <div class="image-3">
                        <img src="{{ get_image(setting('mainpic.slider3')) }}">

                    </div>
                    <div class="image-4">
                        <img src="client/assets/icon/recorder.svg">

                    </div>
                    <div class="social-icon">
                        <a href="{{setting('social.facebook')}}">
                            <img src="client/assets/icon/facebook.svg">
                        </a>
                        <a href="{{ setting('social.insta') }}">
                            <img src="client/assets/icon/instagram.svg">

                        </a>
                        <a href="{{setting('social.youtube')}}">
                            <img src="client/assets/icon/youtube.svg">

                        </a>
                        <a href="{{ setting('social.tweeter') }}">
                            <img src="client/assets/icon/twitter.svg">

                        </a>


                    </div>


                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="bg-1">
            <img src="client/assets/photo/Group%201221.png">
            <img class="Ellipse6" src="client/assets/icon/Ellipse%203.2-2.svg">

        </div>

        <div class="container2">
            <div class="row bubble-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="text">
                        {{ setting('home.services_text_one') }}
                    </p>
                    <h1>
                        {{ setting('home.services_text') }}
                    </h1>

                    <div class="circle-row" id="khadamat">

                        @php
                            $arr_open = [0 , 2 , 3 , 5];
                            $arr_close = [1 , 2 , 4 , 5];
                            $arr = [1 , 3 , 2 , 4 , 5 , 6];
                        @endphp
                        @foreach($services as $service)

                            @if(in_array($loop->index , $arr_open))
                                <div class="small">
                                    @endif
                                    <a style="margin-right: 0px" href="{{ route('services' , $service->slug) }}">
                                        <div class="circles panel-{{ $arr[$loop->index] }}">
                                            <div class="image-item">
                                                <img src="{{ get_image($service->image) == null ? asset('client/assets/photo/sample.jpeg') : get_image($service->image)}}">
                                            </div>
                                            <h3 style="width: 100%">
                                                {{ $service->title }}
                                            </h3>
                                            <a style="color: inherit" href="{{ route('services' , $service->slug) }}">
                                                بیشتر بدانید
                                            </a>
                                        </div>
                                    </a>
                                    @if(in_array($loop->index , $arr_close))
                                </div>
                            @endif

                        @endforeach

                        <div class="small panel-7"></div>

                    </div>


                </div>

            </div>

        </div>

        <div class="bg-1">
            <img src="client/assets/photo/Group%201533.png">

        </div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div id="main-row" class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="text">
                        {{ setting('home.facilities_above_text') }}
                    </p>
                    <h1>
                        {{ setting('home.facilities_text') }}
                    </h1>
                    <div class=" vertical-tabs">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-5">
                                <div class="nav scroll flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">

                                    @php
                                        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                    @endphp

                                    @foreach($facilities as $facility)

                                        <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                           id="v-pills-{{ $f->format($loop->index + 1) }}-tab" data-toggle="pill"
                                           href="#v-pills-{{ $f->format($loop->index + 1) }}" role="tab"
                                           aria-controls="v-pills-{{ $f->format($loop->index + 1) }}"
                                           aria-selected="true">
                                            <span></span>
                                            {{ $facility->title }}
                                        </a>

                                    @endforeach

                                </div>
                            </div>
                            {{--                            <div class="col-lg-8 col-md-6 offset-md-1 col-sm-6">--}}
                            <div class="col-lg-9 col-md-8  col-sm-7">
                                <div class="tab-content" id="v-pills-tabContent">

                                    @foreach($facilities as $facility)

                                        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                                             id="v-pills-{{ $f->format($loop->index + 1) }}" role="tabpanel"
                                             aria-labelledby="v-pills-{{ $f->format($loop->index + 1) }}-tab">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">

                                                    <a href="{{ $facility->link }}">
                                                        <div class=" imge-box">
                                                            <img style="cursor: pointer"
                                                                 src="{{ get_cropped_image($facility->image) }}">

                                                        </div>
                                                    </a>

                                                </div>
                                                <div class="tab-pane-text col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                                    <a href="{{ $facility->link }}">
                                                        <h2 style="cursor: pointer">
                                                            {{ $facility->title }}
                                                        </h2>
                                                    </a>
                                                    <p>
                                                        {!! $facility->description !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="title-row">
                        <div>
                            <p class="text">
                                {{ setting('home.product_above_text') }}
                            </p>
                            <h1>
                                {{ setting('home.product_text') }}
                            </h1>
                        </div>
                        <a href="{{ route('all_products') }}" class="see-more">
                            نمایش همه محصولات
                        </a>
                    </div>
                    <div class="row second-row">

                        <div class="service-row col-lg-5 col-md-4 col-sm-12">
                            <div class="imge-box">
                                <img class="gradiant" src="client/assets/icon/Rectangle%201308.svg">

                                <img src="{{get_image(setting('mainpic.shop'))}}">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 col-sm-12">
                            <div class="row">

                                @php

                                    $arr = [['shollex margin' , 45 , 30] , ['' , '' ,''] , ['shollex margin2' , 90 ,60] ,  ['' , '' ,'']]

                                @endphp

                                @foreach($last_products as $product)

                                    @php
                                        $product->need_parallex = $arr[$loop->index];
                                    @endphp

                                    @if($loop->index % 2 == 0)
                                        <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                            @endif

                                            @each('components.product', [$product], 'product')

                                            @if($loop->index % 2 == 1)
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

    @include('components.voices')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="title-row">
                        <div>
                            <p class="text">
                                {{ setting('home.podcast_above') }}
                            </p>
                            <h1>
                                {{ setting('home.podcast') }}
                            </h1>
                        </div>
                        <a href="{{ route('podcast_video') }}" class="see-more">
                            نمایش همه پادکست ها و ویدیو ها
                        </a>
                    </div>
                    <div class="row third-row ">
                        <div class="service-row col-lg-5 col-md-4 col-sm-12">
                            <div class="imge-box">
                                <img src="{{get_image(setting('mainpic.podcastvideo'))}}">
                                <img class="gradiant" src="client/assets/icon/Rectangle%201308.svg">

                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 col-sm-12">
                            <div class="row">
                                @foreach($last_podcasts as $podcast)

                                    @php
                                        $podcast->need_parallex = $arr[$loop->index];
                                    @endphp

                                    @if($loop->index % 2 == 0)
                                        <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                            @endif

                                            @each('components.podcast', [$podcast], 'podcast')

                                            @if($loop->index % 2 == 1)
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

@endsection

@section('optional_footer')
    <script src="{{ asset('client/assets/js/owl.js?x=12') }}"></script>

    <script>
        $('#myModal').on('shown.bs.modal', function () {
            player.api("play");
        })
        $('#myModal').on('hidden.bs.modal', function () {
            player.api("pause");
        })


        var player = new Playerjs(
            {
                id: "player",
                file: "{{ setting('aboutus.video') }}",
                // poster:'آدرس پوستر
            }
        );
    </script>

@endsection

@section('modal')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="player"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

