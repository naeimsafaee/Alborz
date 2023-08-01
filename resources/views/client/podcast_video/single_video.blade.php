@extends('client.index')
@section('content')


    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row ">
                <div class="item" style="width: 100%">
                    <h1>
                        {{$video->title}}
                    </h1>

                </div>


                <div id="center-item" class="center-item col-lg-12 col-md-12 col-sm-12">
                    <div id="column" class="border-box-item">
                        <div id="single-shop-video"  class="imge-box">
                            <div id="player"></div>
                        </div>
                        <div class="tag-row">

                            @foreach($video->service_categories as $service_category)
                                <div class="second-tag-item">
                                    {{ $service_category->title }}
                                </div>
                            @endforeach

                        </div>

                        <p style="margin-top: 0">
                            {!! $video->description !!}
                        </p>
                    </div>
                    <div class="border-box-item">
                        <div  style="width: 100%">
                            <h5>
                                توضیحات معرفی
                            </h5>
                            <p style="direction: rtl" >
                                {!! $video->Introduction !!}
                            </p>
                        </div>
                    </div>
                    <div id="start-row" class="start-row">
                        <div class="about-doctor">
                            <p class="seprate">
                                دسته بندی
                            </p>

                            @foreach($video->categories as $category)

                                <a id="tag-item" class="tag-item"
                                   href="{{ route('video_category' , $category->slug) }}">
                                    {{ $category->title }}
                                </a>

                            @endforeach

                        </div>
                        <div class="about-doctor">
                            <p class="seprate">
                                اشتراک با دوستان
                            </p>
                            <a class="social-item" href="{{ $video->twitter_link }}">
                                <img src="{{asset('client/assets/icon/black-twitter.svg')}}">
                            </a>
                            <a class="social-item" href="{{ $video->whatsapp_link }}">
                                <img src="{{asset('client/assets/icon/black-whatsapp%201.svg')}}">
                            </a>
                            <a class="social-item" href="{{ $video->telegram_link }}">
                                <img src="{{asset('client/assets/icon/black-telegram.svg')}}">
                            </a>
                        </div>

                    </div>
                    @if(count($related) > 0)
                        <div class="row third-row">
                            <div class=" margin3 col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
                                <h1>
                                    ویدیو های مرتبط
                                </h1>
                            </div>

                            @each('components.podcast_1', $related, 'podcast')

                        </div>
                    @endif
                    <div id="div-center" class="div-center col-lg-12 col-md-12 col-sm-12">
                        <form id="add_comment">
                            @csrf
                            <div class="input-row">
                                <label>
                                    دیدگاه شما
                                </label>
                                <textarea id="comment_text" class="textarea" type="text"
                                          placeholder="دیدگاه خود را بنویسید"></textarea>

                            </div>
                            <a class="online-test login" @if(auth()->guard('clients')->check()) onclick="add_comment()" @else href="{{ route('login') }}" @endif>
                                ثبت دیدگاه
                                <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                            </a>{{--
                            <a class="online-test login" onclick="add_comment()">
                                ثبت دیدگاه
                                <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                            </a>--}}
                            <span id="show_comment"></span>
                        </form>

                        <script>

                            function add_comment() {

                                document.getElementById('show_comment').style.display = "none";
                                const url = "{{ route('set_comment_video') }}";

                                const posting = $.post(url, {
                                    _token: document.getElementsByName("_token")[0].value,
                                    video_id: {{ $video->id }},
                                    text: $('#comment_text').val(),
                                });

                                posting.done((data) => {
                                    console.log(data);
                                    document.getElementById('show_comment').innerHTML = "نظر ثبت شده پس از تایید نمایش داده می شود";
                                    document.getElementById('show_comment').style.display = "block";
                                });
                                posting.fail((err) => {
                                    console.log(err);
                                    document.getElementById('show_comment').innerHTML = "ثبت کامنت با خطا مواجه شد";
                                    document.getElementById('show_comment').style.display = "block";
                                });
                            }


                        </script>

                        @foreach($video->comments as $comment)
                            <div class="massage headline-item">
                                <div class="imge-box">
                                    <img src="{{asset('client/assets/photo/doctor2.jpeg')}}">

                                </div>
                                <div class="massage-content">
                                    <h5>
                                        {{ $comment->client->name }}
                                    </h5>
                                    <p>
                                        {{ $comment->text }}
                                    </p>
                                    <p class="date">
                                        {{ $comment->shamsi_date }}
                                    </p>
                                    {{--todo @if($comment->reply_to)
                                        <div class="answer-massage">
                                            <p>
                                                پاسخ ادمین
                                            </p>
                                            <p>
                                                محصول به‌شدت مقرون به صرفه‌ای است و خرید ان را به همگان توصیه
                                                می‌کنم.امیدوارم هر
                                                چه زودتر دوباره موجود شود.
                                            </p>
                                        </div>
                                    @endif--}}

                                    <div class="line"></div>

                                </div>

                            </div>
                        @endforeach

                        @if($video->comments->count() == 0)
                            <div class="about-us-item">
                                <img src="{{ asset('client/assets/icon/comment-empty.svg') }}">
                                <h6 class="margin">
                                    اولین دیدگاه رو شما ثبت کنید
                                </h6>
                            </div>
                        @endif
                    </div>


                </div>


            </div>

        </div>

    </div>

@endsection

@section("optional_header")

    <script src="{{ asset('client/assets/js/playerjs.js') }}"></script>

    <style>

        .border-box-item p {
            width: 100%;
            direction: rtl;
        }

    </style>

@endsection

@section('optional_footer')

    <script>
        var player = new Playerjs(
            {
                id:"player",
                file:"{{ $video_path }}",
                // poster:'آدرس پوستر
            }
        );
        window.addEventListener("resize", function(){

            if (screen.width < 800) {
                let divs = document.getElementsByTagName('pjsdiv')
                for (item of divs) {
                    if (item.style.width == '20px' && item.style.left == '-8px') {
                        item.style.width = '10px'
                        item.style.height = '10px'
                        item.style.left = '-10px'
                        item.style.top = '-10px'
                        item.style.transform = ''
                        item.id = 'play_btn'
                    }
                    if (item.style.width == '44px') {
                        item.style.width = '20px'
                        item.style.height = '20px'
                        item.style.left = '-10px'
                        item.style.top = '-10px'
                        item.id = 'play_bg'
                    }
                }
            }else {
                let play_btn = document.getElementById('play_btn')
                play_btn.style.width = '20px'
                play_btn.style.height = '20px'
                play_btn.style.left = '-8px'
                play_btn.style.top = '-8px'
                play_btn.style.transform = 'scale(3)'

                let play_bg = document.getElementById('play_bg')
                play_bg.style.width = '44px'
                play_bg.style.height = '44px'
                play_bg.style.left = '-22px'
                play_bg.style.top = '-22px'

            }
        });

    </script>
@endsection
