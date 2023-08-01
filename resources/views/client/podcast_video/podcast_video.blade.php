@extends('client.index')
@section('content')

    @if($podcasts->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>

                                <h1>
                                    تازه ترین پادکست ها
                                </h1>
                            </div>
                            <a class="see-more" href="{{route('all_podcasts')}}">
                                نمایش همه
                            </a>
                        </div>
                        <div class="row third-row ">
                            <div class="service-row col-lg-5 col-md-4 col-sm-12">
                                <div class="imge-box">
                                    <img src="{{ get_image(setting('mainpic.podcast')) }}">
                                    <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-12">
                                <div class="row">


                                    @php
                                        $arr = [['shollex margin' , 45 , 30] , ['' , '' ,''] , ['shollex margin2' , 90 ,60] ,  ['' , '' ,'']]
                                    @endphp

                                    @foreach($podcasts as $podcast)

                                        @php
                                            $podcast->need_parallex = $arr[$loop->index];
                                        @endphp

                                        @if($loop->index % 2 == 0)
                                            <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                @endif

                                            @if($podcasts->count() == 2)
                                                @if($loop->index == 1)
                                                </div>

                                                    @php
                                                        $podcasts->need_parallex = $arr[2];
                                                    @endphp
                                                    <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                        @each('components.podcast', [$podcast], 'podcast')

                                                    </div>
                                                    @continue
                                                @endif
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
    @endif

    @if($videos->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="title-row">
                        <div>
                            <h1>

                                تازه ترین ویدیو ها
                            </h1>
                        </div>
                        <a class="see-more" href="{{route('all_video')}}">
                            نمایش همه
                        </a>
                    </div>
                    <div class="row fourth-row third-row">
                        <div class="service-row col-lg-5 col-md-4 col-sm-12">
                            <div class="imge-box">
                                <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                <img src="{{get_image(setting('mainpic.video'))}}">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 col-sm-12">
                            <div class="row">

                                @foreach($videos as $podcast)

                                    @php
                                        $podcast->need_parallex = $arr[$loop->index];
                                    @endphp

                                    @if($loop->index % 2 == 0)
                                        <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                            @endif

                                            @if($videos->count() == 2)
                                                @if($loop->index == 1)
                                                    </div>

                                                    @php
                                                        $podcast->need_parallex = $arr[2];
                                                    @endphp
                                                    <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                        @each('components.podcast', [$podcast], 'podcast')

                                                    </div>
                                                    @continue
                                                @endif
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
    @endif


@endsection
