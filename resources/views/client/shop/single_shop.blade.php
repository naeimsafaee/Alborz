@extends('client.index')
@section('content')
    <div class="container2">
        <div class="row main-row">
            <h1>{{$heading->title}}</h1>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="center-item">
                    <div class="row main-row2">


                        @if($heading->show_doctor)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="border-box-item">
                                    <div class="imge-box">
                                        <img class="gradiant"
                                             src="{{asset('client/assets/icon/Rectangle%201308.svg')}}">
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
                                            {{$product->doctor->description}}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endif


                        @if($heading->video && $heading->video != '')
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="column" class="border-box-item">
                                    <div id="single-shop-video" class="imge-box">
                                        <div id="player"></div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($heading->voice && $heading->voice != '')
                            <div class="border-box-item" style="direction: ltr !important;">

                                <div id="right-item2" class="right-item" style="direction: ltr !important;">

                                    <div class="audio-item" style="direction: ltr !important;">
                                        <div onClick="togglePlay()" class="togglePlay audio-play-pause">
                                            <img class="play-audio" src="{{asset('client/assets/icon/play2.svg')}}">
                                            <img class="pause-audio" src="{{asset('client/assets/icon/pause.svg')}}">
                                            پخش

                                        </div>
                                        <div class="seekbar" style="direction: ltr !important;">
                                            <div class="audio-time" style="direction: ltr !important;">
                                                <p id="player_current_duration">
                                                    00:00
                                                </p>
                                                <p id="player_total_duration">
                                                    00:00
                                                </p>

                                            </div>
                                            <input type="range" value="0"/>
                                            <div class="seekbar-progress" style="direction: ltr !important;">

                                                <div class="progress" id="progress" role="progressbar" aria-valuemin="0"
                                                     aria-valuemax="100" aria-valuenow="0" style="width: 0%;">

                                                </div>
                                                <span class="progress-circle"></span>
                                            </div>
                                        </div>

                                        <audio id="audio" src="{{ $heading->voice }}"></audio>
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if($heading->pdf && $heading->pdf != '')
                            <div class="border-box-item">
                                <a href="{{ $heading->pdf }}" class="online-test ">
                                    دانلود فایل
                                </a>
                            </div>
                        @endif


                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="border-box-item" class="border-box-item">

                                <div id="right-item" class="right-item ">

                                    <p style="direction: rtl">
                                        {{ $heading->description }}
                                    </p>

                                    @if(count($product->headings) >0)

                                        <h1>
                                            دیگر قسمت های این دوره
                                        </h1>
                                        @foreach($product->headings as $headings)
                                            <div class="headline-item blu-bg">
                                                <div class="arrow-item">
                                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">

                                                </div>
                                                <div class="content-item">
                                                    <a href="{{route('single_shop' , [$product->id ,$headings->id])}}">

                                                        <h5>
                                                            {{$headings->title}}
                                                        </h5>
                                                    </a>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif

                                </div>

                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('optional_footer')
    <script>
        var player = new Playerjs({id: "player", file: "{{  $video_path }}"});

        function PlayerjsEvents(event, id, data) {
            if (event == "init") {
                player.api("volume", 1);
            }
        }
    </script>




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
