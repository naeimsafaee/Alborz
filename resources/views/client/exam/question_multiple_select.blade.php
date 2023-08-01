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
                                        <br/>

                                        @foreach($question->options as $option)
                                            <div class="question-title" data-value="{{ $option->id }}">
                                                <div class="check-item">
                                                    &#10003
                                                </div>
                                                <p>
                                                    {{ $option->text }}
                                                </p>
                                            </div>
                                        @endforeach

                                    </div>


                                </div>

                                <div onclick="_submit()" class="start-row submit-row">
                                    <a class="online-test ">
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

        <form method="post" action="{{ route('answer_2') }}" id="main_form" style="display: none">
            @csrf
            <input name="answers" id="sdsld" type="hidden"/>
            <input type="hidden" name="step" value="{{ request()->step + 1 }}"/>
            <input type="hidden" name="question_id" value="{{ $question->id }}"/>
            <input type="hidden" name="exam_id" value="{{ request()->exam_id }}"/>
            <input type="hidden" name="code" value="{{ $code }}"/>
        </form>

    </div>
    <script>
        $('.question-title').on('click', function () {
            $(this).toggleClass('active');
        });

        function _submit() {
            const arr = $('.question-title.active');

            console.log(arr);

            var s = "";
            for (let i = 0; i < arr.length; i++) {
                s += "-" + arr[i].getAttribute('data-value');
            }

            $('#sdsld').val(s);

            document.getElementById('main_form').submit();
        }

    </script>

@endsection

