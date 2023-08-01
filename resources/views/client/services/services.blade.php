@extends('client.index')

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row ">


                        <div class="services-row col-lg-7 col-md-6 col-sm-12">
                            <div class="item">
                                <img class="Ellipse7" src="{{asset('client/assets/icon/about-Ellipse.svg')}}">
                                <img class="Ellipse8" src="{{asset('client/assets/icon/about-Ellipse2.svg')}}">
                                <img class="Ellipse9" src="{{asset('client/assets/icon/about-Ellipse3.svg')}}">

                                <h1>
                                    {{ $service->title }}

                                </h1>
                                <p>
                                    {!! $service->description !!}
                                </p>
                                @if($service->doctor)
                                    <a class="about-doctor" href="{{ route('about_dr', $service->doctor->slug)}}">
                                        <div class="imge-box">
                                            <img src="{{ get_image($service->doctor->image) }}">

                                        </div>
                                        درباره درمانگر بیشتر بدانید
                                    </a>
                                    <a data-toggle="modal" data-target=".bs-example-modal-new" id="online-test"
                                       class="online-test">
                                        <img src="{{asset('client/assets/icon/test-list-pen-edit%201.svg')}}">
                                        نوبت گیری
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="video-row col-lg-5 col-md-6 col-sm-12">
                            <img class="Rectangle" src="{{asset('client/assets/icon/Rectangle%201307.svg')}}">


                            <div id="video-box" class="imge-box">
                                <div class="gradiant">
                                    <img src="{{ get_image($service->circle_image) }}">

                                </div>
                                {{--                                <video width="360" height="360" id="player" preload="auto" loop="loop">--}}
                                {{--                                    <source src="{{ get_image($service->video_image) }}" style="border-radius: 50%;">--}}

                                {{--                                    Your browser does not support the video tag.--}}
                                {{--                                </video>--}}


                            </div>


                            {{--                            <a id="play" class="tap" href="javascript:void(0);">--}}
                            <a id="play" class="tap" data-toggle="modal" data-target="#myModal">
                                <p>
                                    ویدیو معرفی
                                </p>
                                <img class="play" src="{{asset('client/assets/icon/play2.svg')}}">
                                <img class="pause" src="{{asset('client/assets/icon/pause.svg')}}">

                            </a>


                        </div>


                    </div>


                </div>

            </div>

        </div>

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">

        @if($service->categories->count() > 0)
            <div class="container2">
                <div class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row third-row ">
                            <div class="service-row col-lg-5 col-md-4 col-sm-12">
                                <div class="imge-box">
                                    <img src="{{ get_image($service->category_image) }}">
                                    <img class="gradiant" src="{{asset('client/assets/icon/Rectangle%201308.svg')}}">

                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-12">
                                <div class="row">


                                    <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12  ">
                                        <h1 class="heading">
                                            {{ $service->title }}
                                        </h1>
                                        @foreach($service->categories->take($service->categories->count() / 2) as $category)
                                            <div class="Difficulties-item">
                                                <h2>
                                                    {{$category->title}}
                                                </h2>
                                                <p>
                                                    {{$category->short_desc}}
                                                </p>
                                                <a class="more-item"
                                                   href="{{ route('services_category' , $category->slug) }}">
                                                    <img src="{{asset('client/assets/icon/arrow.svg')}}">
                                                    بیشتر بدانید
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 margin2 shollex"
                                         data-initial-margin-top="90" data-minimum-margin="70" data-speed="5">
                                        @foreach($service->categories->skip($service->categories->count() / 2)->take($service->categories->count() / 2) as $category)
                                            <div class="Difficulties-item">
                                                <h2>
                                                    {{$category->title}}
                                                </h2>
                                                <p>
                                                    {{$category->short_desc}}
                                                </p>
                                                <a class="more-item"
                                                   href="{{ route('services_category' , $category->slug) }}">
                                                    <img src="{{asset('client/assets/icon/arrow.svg')}}">
                                                    بیشتر بدانید
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

            </div>
        @endif

        @if($products->count() > 0)
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container2">
                    <div class="row main-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="title-row">
                                <div>
                                    <p class="text">
                                        {{ $service->above_text }}
                                    </p>
                                    <h1>
                                        {{ $service->title_text }}
                                    </h1>
                                </div>
                                <a href="{{ route('all_products') }}" class="see-more">
                                    نمایش همه محصولات
                                </a>
                            </div>
                            <div class="row second-row">
                                <div class="service-row col-lg-5 col-md-4 col-sm-12">
                                    <div class="imge-box">
                                        <img class="gradiant"
                                             src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                        <img src="{{ get_image($service->video_image) }}">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8 col-sm-12">
                                    <div class="row">
                                        @php

                                            $arr = [['shollex margin' , 45 , 30] , ['' , '' ,''] , ['shollex margin2' , 90 ,60] ,  ['' , '' ,'']]

                                        @endphp

                                        @foreach($products as $product)

                                            @php
                                                $product["need_parallex"] = $arr[$loop->index % 4];
                                            @endphp

                                            @if($loop->index % 2 == 0)
                                                <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                    @endif

                                                    @if($products->count() == 2)
                                                        @if($loop->index == 1)
                                                </div>

                                                @php
                                                    $product["need_parallex"] = $arr[2];
                                                @endphp
                                                <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                    @each('components.product', [$product], 'product')

                                                </div>
                                                @continue
                                            @endif
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
    @endif

    @if($exams->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>

                                <h1>
                                    {{ setting('site.exams_title') }}
                                </h1>
                            </div>

                        </div>
                        <div class="row third-row ">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    @php
                                        $arr = [
                                                    ['Assessment-item' , '' , ''],
                                                    ['Assessment-item margin shollex' , '45' , '20'] ,
                                                    ['Assessment-item margin2 shollex'  , "90" , '40']
                                                ]
                                    @endphp

                                    @foreach($exams as $exam)

                                        @php

                                            $exam["category_title"] = $service->title;

                                        @endphp

                                        <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="{{ $arr[$loop->index % 3][0] }}"
                                                 data-initial-margin-top="{{ $arr[$loop->index % 3][1] }}"
                                                 data-speed="{{ $arr[$loop->index % 3][2] }}">

                                                @each('components.exam', [$exam] , 'exam')

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
        @endif

        @include('components.voices')
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
    <script src="{{ asset('client/assets/js/owl.js?x=12') }}"></script>

    <script>
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

@section('optional_index')
    @if($service->doctor)

        <div class="modal-body">
            <div class="body-message">
                <h1>
                    درخواست مراجعه
                </h1>
                <p>
                    {{ setting('about_us.nobat') }}
                </p>

                <form method="POST" action="{{ route('appointment') }}">
                    @csrf
                    <div class="input-row">
                        <input type="text" name="doctor_id" value="{{$service->doctor->id}}" style="display: none">
                        <div class="input-row">
                            <label>
                                نام
                            </label>
                            <input type="text" name="name" placeholder="نام ">
                            @error('name')
                            <span style="color:#ff0000">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="input-row">
                            <label>
                                شماره موبایل
                            </label>
                            <input type="text" name="phone" placeholder=" شماره موبایل ">
                            @error('phone')
                            <span style="color:#ff0000">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="input-row">
                            <label>
                                متن پیام ارسالی
                            </label>
                            <textarea type="text" name="description" placeholder="متن پیام ارسالی"></textarea>
                            @error('description')
                            <span style="color:#ff0000">{{ $message }}</span>
                            @enderror

                        </div>
                        <button class="online-test login">
                            ثبت درخواست
                            <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                        </button>
                    </div>
                </form>


            </div>
        </div>
    @endif

@endsection



