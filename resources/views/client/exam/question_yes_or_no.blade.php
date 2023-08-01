@extends('client.index')
@section('content')
    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="center-item">
                        <div class="row main-row2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="title-row">
                                    @if($question->need_instruction)
                                        <div>
                                            <h1>
                                                {{ $question->instruction_title }}
                                            </h1>
                                        </div>
                                    @endif
                                    <a class="answer-item">
                                        پاسخ {{ $step + 1 }} از {{ $total }}
                                    </a>
                                </div>
                                <br/>
                                @if($question->need_instruction)
                                    <p>
                                        {!! $question->instruction !!}
                                    </p>

                                @endif
                                <div class="border-box-item">

                                    <div id="right-item" class="right-item ">
                                        <h1 style="font-size: 29px;">
                                            {{ $question->title }}
                                        </h1>
                                        <p style="direction: rtl;font-size: 16px;">
                                            {!! $question->question !!}
                                        </p>

                                        @foreach($question->options as $option)
                                            <div class="question-item question-title @if($option->need_text) yes @else no @endif"
                                                 onclick="(() => { document.getElementById('option_id').value = '{{ $option->id }}'; })()">
                                                {{ $option->text }}
                                            </div>
                                        @endforeach

                                        <form enctype="multipart/form-data" action="{{ route('answer_1') }}"
                                              method="POST" id="more-item">
                                            @csrf
                                            <div class="input-row">
                                                <div id="my_text_area">
                                                    <label>
                                                        دیدگاه شما
                                                    </label>
                                                    <textarea class="textarea" name="description"
                                                              placeholder="دیدگاه خود را بنویسید"></textarea>
                                                </div>
                                                <input id="option_id" type="hidden" name="option_id">
                                                <input type="hidden" name="question_id" value="{{ $question->id }}"/>
                                                <input type="hidden" name="exam_id" value="{{ request()->exam_id }}"/>
                                                <input type="hidden" name="step" value="{{ request()->step + 1 }}"/>
                                                <input type="hidden" name="code" value="{{ $code }}"/>

                                            </div>
                                        </form>
                                    </div>

                                    <script>
                                        $('#more-item').fadeIn();
                                        $('#my_text_area').hide();

                                        $('#right-item .question-item ').on('click', function () {
                                            $('#right-item .question-item').removeClass('active');
                                            $(this).addClass('active');
                                        });
                                        $('.yes').on('click', function () {
                                            $('#my_text_area').fadeIn();
                                        });
                                        $('.no').on('click', function () {
                                            $('#my_text_area').fadeOut(100);
                                        });
                                    </script>

                                </div>
                                <div class="start-row submit-row">
                                    <a onclick="(() => { if(!document.getElementById('option_id').value) return; document.getElementById('more-item').submit() })()"
                                       class="online-test ">
                                        ادامه
                                        <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>
@endsection

