@extends('client.index')
@section('content')
    <div class="container2">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row ">
                    <div class=" col-lg-7 col-md-6 col-sm-12">
                        <div class="item">
                            <h1 class="margin2">
                                {{$product->name}}
                            </h1>
                            <p>
                                {!! $product->description !!}
                            </p>

                            <img class="single-shop-ellipse2" src="{{asset('client/assets/icon/middle-ellipse.svg')}}">
                            <img class="single-shop-ellipse" src="{{asset('client/assets/icon/about-Ellipse2.svg')}}">


                        </div>


                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <img class="Rectangle" src="{{asset('client/assets/icon/Rectangle%201307.svg')}}">
                        <div id="video-box" class="imge-box">
                            <div class="gradiant">

                                {{ $product->circle_image }}

                            </div>
                        </div>


                        @if($video_path != '')
                            <a id="play" class="tap" data-toggle="modal" data-target="#myModal">
                                <p>
                                    ویدیو معرفی
                                </p>
                                <img class="play" src="{{asset('client/assets/icon/play2.svg')}}">
                                <img class="pause" src="{{asset('client/assets/icon/pause.svg')}}">

                            </a>
                        @endif


                    </div>


                </div>


            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="center-item">
                    <div class="row main-row2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="border-box-item">

                                <div id="right-item" class="right-item ">
                                    <h1>
                                        آنچه در این دوره میاموزید
                                    </h1>
                                    <p>
                                        {!! $product->description2 !!}
                                    </p>
                                    <br/>
                                    @if(count($product->headings) > 0)
                                        <h1 style="margin-bottom: 40px;">
                                            سرفصل های دوره
                                        </h1>
                                        @foreach($product->headings as $heading)
                                            <div class="headline-item">
                                                <div class="arrow-item">
                                                    <img src="{{asset('client/assets/icon/black-left-arrow.svg')}}">
                                                </div>
                                                <div class="content-item">
                                                    @if($is_buy == true)
                                                        <h5>
                                                            <a href="{{route('single_shop' , [$product->id ,$heading->id])}}">
                                                                {{$heading->title}}
                                                            </a>
                                                        </h5>
                                                    @else
                                                        <h5>
                                                            {{$heading->title}}
                                                        </h5>
                                                        <p>
                                                            {!! $heading->description !!}
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif

                                </div>

                            </div>
                        </div>
                        

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="border-box-item">

                                <img class="examine-image" src="{{ asset('client/assets/icon/single-shop.svg') }}">
                                <div class="right-item">

                                    <h5>
                                        {{$product->name}}

                                    </h5>
                                    <p>
                                        {!! $product->description3 !!}

                                    </p>

                                    @if(count($product->prerequisites) == 0)
                                        <div class="start-row" style="direction: ltr;">
                                            @if($is_buy == true)
                                                شمااین محصول را خریداری کرده اید
                                            @elseif($product->price != 0)
                                                <a href="{{ route('buy_product' , $product->id) }}" class="online-test">
                                                    خرید این پکیج
                                                    <img src="{{ asset('client/assets/icon/shopping.svg') }}">
                                                </a>
                                            @endif
                                            <div>
                                                @if($product->price == 0 && !$is_buy)
                                                    <h5>رایگان</h5>
                                                @elseif(!$is_buy)
                                                    <h5>
                                                        {{ fa_number(number_format($product->price)) }}
                                                    </h5>
                                                    <p>
                                                        تومان
                                                    </p>
                                                @endif
                                            </div>

                                        </div>
                                    @elseif(count($product->prerequisites) > 0)
                                        <div class="start-row" style="direction: ltr;">
                                            <div>
                                                <h5>این پکیج پیش نیاز دارد</h5>
                                                <p>
                                                    پس از گذراندن ارزیابی ها لینک خرید پکیج برایتان ارسال میشود
                                                </p>
                                            </div>
                                        </div>

                                    @endif
                                </div>

                            </div>
                        </div>

                        @if(count($product->prerequisites) > 0)
                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
                                <h1>پیش نیاز این پکیج</h1>
                                <div class="row">

                                    @foreach($product->prerequisites as $exam)
                                        @php
                                            $exam["category_title"] = '-';
                                        @endphp
                                        <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="Assessment-item">

                                                @include('components.exam', $exam)

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="border-box-item">
                                <div class="imge-box">
                                    <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                    <img src="{{ get_image($product->doctor->image) }}">
                                </div>

                                <div class="right-item">
                                    <p class="text">
                                        درباره درمانگر
                                    </p>
                                    <h5>
                                        {{$product->doctor->full_name}}

                                    </h5>
                                    <p>
                                        {!! $product->doctor->description !!}

                                    </p>
                                </div>

                            </div>
                            <br/>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
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

@section('optional_footer')
    <script>
        $('.headline-item ').on('click', function () {
            // $('.headline-item').removeClass('active');
            $(this).toggleClass('active');
        });
        // video
        $(document).ready(function () {
            var playing = false;

            $('#play').click(function () {
                if (playing == false) {
                    document.getElementById('player').play();
                    playing = true;
                    $(".play").hide();
                    $(".pause").show();


                } else {
                    document.getElementById('player').pause();
                    playing = false;
                    $(".play").show();
                    $(".pause").hide();
                }
            });
        });
    </script>
    <script src="client/assets/js/master.js"></script>

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
                file: "{{ $video_path }}",
                // poster:'آدرس پوستر
            }
        );
    </script>

@endsection
