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
                                        <form enctype="multipart/form-data" id="main_form" action="{{ route('answer') }}" method="POST">
                                            @csrf
                                            <div class="input-row">
                                                <label>
                                                    فایل درخواستی را آپلود نمایید (ویدیو یا صدا)
                                                </label>
                                                <label for="et_pb_contact_brand_file_request_0"
                                                       class="et_pb_contact_form_label">
                                                    انتخاب فایل
                                                    <span class="file-upload">انتخاب فایل</span>
                                                </label>
                                                <input type="file" id="et_pb_contact_brand_file_request_0"
                                                       class="file-upload" name="file">
                                                @error('file')
                                                    {{ $message }}
                                                @enderror
                                                <input type="hidden" name="step" value="{{ request()->step + 1 }}"/>
                                                <input type="hidden" name="question_id" value="{{ $question->id }}"/>
                                                <input type="hidden" name="exam_id" value="{{ request()->exam_id }}"/>
                                                <input type="hidden" name="code" value="{{ $code }}"/>

                                            </div>

                                            <div class="start-row submit-row">

                                                <a onclick="(() => { $('#loader').show(); document.getElementById('main_form').submit() })()"
                                                   class="online-test ">
                                                    ادامه
                                                    <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                                </a>
                                            </div>


                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

