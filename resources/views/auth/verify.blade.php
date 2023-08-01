@extends('client.index')
@section('content')

    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="login_form">
            <div class="details">
                <h1>
                    کد تایید
                </h1>
                <form action="{{ route('set_verify') }}" method="POST">
                    @csrf
                    <div class="input-row">
                        <label>کد تایید پیامک شده را وارد نمایید

                        </label>
                        <input name="code"
                                onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )"
                                type="text" placeholder="کد تایید">

                        @error('code')
                            {{ $message }}
                        @enderror

                    </div>

                    <button class="online-test login" type="submit">
                        ادامه برای ورود
                        <img src="{{ asset('client/assets/icon/left-arrow-white.svg') }}">

                    </button>


                </form>


            </div>
            <div class="details-two">
                <img src="{{ asset('client/assets/icon/register.svg') }}">

            </div>

        </div>


    </div>


@endsection



{{--example form--}}
{{--
<form id="main_form" action="{{ route('set_verify') }}" method="POST">
    @csrf
    <input class="activation-code-input w-100 " name="code" placeholder="code">

</form>

<div class="withdraw change-submit max-width" onclick="(() => { document.getElementById('main_form').submit() })()">
    <img src="client/assets/icons/continue.svg">
    ادامه
    <div class="time">
        ۰۱:۲۱
    </div>


</div>--}}

