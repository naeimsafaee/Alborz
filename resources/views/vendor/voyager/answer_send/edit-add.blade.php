@extends('voyager::master')

@section('content')
    <div class="content" style="background: #fff">
        <div class="post">

            <form method="POST" action="{{ route('send_sms_submit') }}" style="padding-left: 40px;padding-top: 20px">
                @csrf

                <input type="hidden" value="{{ $client_id }}" name="client_id"/>
                <input type="hidden" value="{{ $exam_id }}" name="exam_id"/>

<!--                <div class="col-md-12 col-12 col-xs-12">
                    <div class="form-group gray   ">

                        <label class="control-label" for="name">متن تاییدیه</label>
                        <input type="text" class="form-control" name="message" placeholder="متن تاییدیه" value="">

                    </div>
                </div>-->

                <div class="col-md-12 col-12 col-xs-12">
                    <div class="form-group gray   ">

                        <label class="control-label" for="name">متن تاییدیه</label>
                        <textarea required="" class="form-control" name="message" rows="5"></textarea>
<!--
                        <input type="text" class="form-control" name="message" placeholder="متن تاییدیه" value="">
-->


                    </div>
                </div>

                <div class="button-group right">
                    <button type="submit" class="btn arrow add">ارسال</button>
                </div>

            </form>

        </div>
    </div>


@stop
