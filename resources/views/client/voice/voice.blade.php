@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row pages">
                <div class="div-center col-lg-12 col-md-12 col-sm-12">
                    <div class="voice-item row">

                        <div class="step_start">

                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <h1 class="text-center">
                                    برای تست صدا روی دکمه بالا کلیک کنید
                                    <br>
                                    و طبق دستور العمل زیر صدای خود را ضبط کنید
                                </h1>
                            </div>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <p>
                                    {{setting('voice.guide')}}
                                </p>
                            </div>
                        </div>


                        <div class=" col-lg-12 col-md-12 col-sm-12" style="margin-top: 40px">
                            <h1>
                                تست ارزیابی صدا
                            </h1>
                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <div id="recorder" class="recorder">
                                <img id="record" src="{{asset('client/assets/icon/voice-recorder.svg')}}"/>
                                <img id="arrow" src="{{asset('client/assets/icon/voicearrow.svg')}}"/>
                            </div>
                        </div>

                        <div class="step_recording text-center col-lg-12 col-md-12 col-sm-12" style="display: none;">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1 class="text-center">
                                    در حال ضبط صدا
                                </h1>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button onclick="document.getElementById('recorder').click()" class="text-center online-test login finish-recording">
                                    پایان و ادامه
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">

                                </button>
                            </div>
                        </div>


                        <div class=" step_result text-center col-lg-12 col-md-12 col-sm-12" style="display: none;">

                            <div class="text-center col-lg-12 col-md-12 col-sm-12">
                                <button onclick="document.getElementById('recorder').click()" class="online-test login recording-again">
                                    ضبط دوباره
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">

                                </button>
                            </div>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <div class="voice-details" style="height: 50px; display: flex; align-items: center; align-content: center; justify-content: space-between">
                                    <h2 id="pitch" style="width: 100px;">
                                        0 Hz
                                    </h2>
                                    <h1 id="note" style="width: 100px; margin: 0 !important;">

                                    </h1>
                                    <h2 id="detune_amt" style="width: 100px;">
                                        0cents
                                    </h2>
                                </div>
                            </div>

                            <canvas id="waveform" width=512 height=256></canvas>

                            <div id="detector" class="vague" style="display: none;">
                                <div class="pitch"><span>--</span>Hz</div>
                                <div class="note"><span >--</span></div>
                                <canvas id="output" width=300 height=42></canvas>
                                <div id="detune"><span id="detune_amt">--</span><span id="flat">cents &#9837;</span><span id="sharp">cents &#9839;</span></div>
                            </div>
<!--
                            <div class="text-center col-lg-12 col-md-12 col-sm-12">
                                <button onclick="submit()" class="online-test login" id="submit_voice_btn">
                                    ارسال برای ارزیابی
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                                </button>
                            </div>-->
                        </div>
                    </div>

                    <div class="voice-item row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <h1>
                                 تست صدای پایین
                            </h1>
                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <div id="recorderDown" class="recorder">
                                <img id="record" src="{{asset('client/assets/icon/voice-recorder.svg')}}"/>
                                <img id="arrow" src="{{asset('client/assets/icon/voicearrow.svg')}}"/>
                            </div>
                        </div>




                        <div id="" class="step_recording text-center col-lg-12 col-md-12 col-sm-12" style="display: none;">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1 class="text-center">
                                    در حال ضبط صدا
                                </h1>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button onclick="document.getElementById('recorderDown').click()" class="text-center online-test login finish-recording">
                                    پایان و ادامه
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">

                                </button>
                            </div>
                        </div>





                        <div id="" class="step_result text-center col-lg-12 col-md-12 col-sm-12" style="display: none;">

                            <div class="text-center col-lg-12 col-md-12 col-sm-12">
                                <button onclick="document.getElementById('recorderDown').click()" class="online-test login recording-again">
                                    ضبط دوباره
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">

                                </button>
                            </div>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <div class="voice-details" style="height: 50px; display: flex; align-items: center; align-content: center; justify-content: space-between">
                                    <h2 id="pitch1" style="width: 100px;">
                                        0 Hz
                                    </h2>
                                    <h1 id="note1" style="width: 100px; margin: 0 !important;">

                                    </h1>
                                    <h2 id="detune_amt1" style="width: 100px;">
                                        0cents
                                    </h2>
                                </div>
                            </div>

                            <canvas id="waveform1" width=512 height=256></canvas>

                            <div id="detector1" class="vague" style="display: none;">
                                <div class="pitch1"><span>--</span>Hz</div>
                                <div class="note1"><span >--</span></div>
                                <canvas id="output1" width=300 height=42></canvas>
                                <div id="detune1"><span id="detune_amt1">--</span><span id="flat1">cents &#9837;</span><span id="sharp1">cents &#9839;</span></div>
                            </div>

                            <div class="text-center col-lg-12 col-md-12 col-sm-12">
                                <button onclick="submit()" class="online-test login" id="submit_voice_btn">
                                    ارسال برای ارزیابی
                                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection
@section('optional_footer')
    <script src="{{asset('client/assets/js/voice-recorder.js')}}"></script>
@endsection
