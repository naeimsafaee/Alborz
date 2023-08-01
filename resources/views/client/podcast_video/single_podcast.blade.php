@extends('client.index')
@section('content')


    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row ">
                <div class="item" style="width: 100%">
                    <h1>
                        {{$podcast->title}}
                    </h1>
                </div>
                <div id="center-item" class="center-item col-lg-12 col-md-12 col-sm-12">

                    <div class="border-box-item">
                        <div class="imge-box">
                            <img class="gradiant" src="{{asset('client/assets/icon/Rectangle%201308.svg')}}">

                            <img src="{{get_image($podcast->image)}}">
                            <div class="details-item">
                                <img src="{{asset('client/assets/icon/padcast.svg')}}">
                                پادکست
                            </div>
                        </div>

                        <div id="right-item2" class="right-item">
                            <div class="tag-row">
                                @foreach($podcast->service_categories as $category)

                                    <div class="second-tag-item">
                                        <a href="{{ route('services_category' , $category->slug) }}">
                                        {{ $category->title }}
                                        </a>
                                    </div>

                                @endforeach
                            </div>
                            <p style="direction: rtl">
                                {!! $podcast->description !!}
                            </p>
                            <div class="audio-item">
                                <div onClick="togglePlay()" class="togglePlay audio-play-pause">
                                    <img class="play-audio" src="{{asset('client/assets/icon/play2.svg')}}">
                                    <img class="pause-audio" src="{{asset('client/assets/icon/pause.svg')}}">
                                    پخش

                                </div>
                                <div class="seekbar ">
                                    <div class="audio-time">
                                        <p id="player_current_duration">
                                            00:00
                                        </p>
                                        <p id="player_total_duration">
                                            00:00
                                        </p>

                                    </div>
                                    <input type="range" value="0"/>
                                    <div class="seekbar-progress">

                                        <div class="progress" id="progress" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" style="width: 0%;">

                                        </div>
                                        <span class="progress-circle"></span>
                                    </div>
                                </div>

                                <audio id="audio" src="{{ $audio_path }}"></audio>
                            </div>

                        </div>

                    </div>
                    <div class="border-box-item">
                        <div style="width: 100%">
                            <h5>
                                توضیحات معرفی
                            </h5>
                            <p style="direction: rtl">
                                {!! $podcast->Introduction !!}

                            </p>
                        </div>
                    </div>
                    <div id="start-row" class="start-row">
                        <div class="about-doctor">
                            <p class="seprate">
                                دسته بندی
                            </p>
                            @foreach($podcast->categories as $category)
                                <a id="tag-item" class="tag-item"
                                   href="{{ route('podcast_category' , $category->slug) }}">
                                    {{ $category->title }}
                                </a>
                            @endforeach

                        </div>
                        <div class="about-doctor">
                            <p class="seprate">
                                اشتراک با دوستان
                            </p>
                            <a class="social-item" href="{{ $podcast->twitter_link }}">
                                <img src="{{asset('client/assets/icon/black-twitter.svg')}}">
                            </a>
                            <a class="social-item" href="{{ $podcast->whatsapp_link }}">
                                <img src="{{asset('client/assets/icon/black-whatsapp%201.svg')}}">
                            </a>
                            <a class="social-item" href="{{ $podcast->telegram_link }}">
                                <img src="{{asset('client/assets/icon/black-telegram.svg')}}">
                            </a>


                        </div>

                    </div>
                    @if(count($related) > 0)
                        <div class="row third-row">
                            <div class=" margin3 col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
                                <h1>
                                    پادکست های مرتبط
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
                            </a>
                            <span id="show_comment"></span>
                        </form>

                        <script>

                            function add_comment() {

                                document.getElementById('show_comment').style.display = "none";
                                const url = "{{ route('set_comment_podcast') }}";

                                const posting = $.post(url, {
                                    _token: document.getElementsByName("_token")[0].value,
                                    podcast_id: {{ $podcast->id }},
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

                        @foreach($podcast->comments as $comment)
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

                        @if($podcast->comments->count() == 0)
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
@section('optional_footer')
    <script>
        var timer;
        var percent = 0;
        var audio = document.getElementById("audio");
        audio.addEventListener("playing", function (_event) {
            var duration = _event.target.duration;
            document.getElementById('player_total_duration').innerHTML = formatSeconds(duration)
            advance(duration, audio);
        });
        audio.addEventListener("pause", function (_event) {
            clearTimeout(timer);
        });
        let player_current_duration = document.getElementById('player_current_duration')
        var advance = function (duration, element) {
            var progress = document.getElementById("progress");
            increment = 10 / duration
            percent = Math.min(increment * element.currentTime * 10, 100);
            player_current_duration.innerHTML = formatSeconds(element.currentTime)

            progress.style.width = percent + '%'
            startTimer(duration, element);
        }
        var startTimer = function (duration, element) {
            if (percent < 100) {
                timer = setTimeout(function () {
                    advance(duration, element)
                }, 100);
            }
        }

        function formatSeconds(seconds) {
            var date = new Date(1970, 0, 1);
            date.setSeconds(seconds);
            return date.toTimeString().replace(/.*(\d{2}:\d{2}).*/, "$1");
        }

        function togglePlay(e) {
            e = e || window.event;
            var btn = e.target;
            if (!audio.paused) {
                btn.classList.remove('active');
                audio.pause();
                isPlaying = false;
            } else {
                btn.classList.add('active');
                audio.play();
                isPlaying = true;
            }
        }

    </script>
    <script>
        let handle = document.querySelector('.seekbar input[type="range"]');
        let progressbar = document.querySelector('.seekbar div[role="progressbar"]');

        handle.addEventListener('input', function () {
            console.log(this.value)
            progressbar.style.width = (this.value) + '%';
            audio.currentTime = this.value;
            progressbar.setAttribute('aria-valuenow', this.value);
        });
    </script>

@endsection

