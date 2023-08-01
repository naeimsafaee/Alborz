@extends('client.index')
@section('content')

    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="login_form">
            <div class="details">
                <h1>
                    ورود به حساب کاربری
                </h1>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="input-row">
                        <label>
                            شماره موبایل خود را وارد نمایید
                        </label>
                        <input
                                onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )"
                                type="text" placeholder="شماره موبایل" name="phone" value="{{ old('phone') }}">

                    </div>

                    <button class="online-test login" type="submit">
                        ادامه برای ورود
                        <img src="{{ asset('client/assets/icon/left-arrow-white.svg') }}">
                    </button>
                </form>


            </div>
            <div class="details-two">
                <img src="{{ asset('client/assets/icon/logo2.svg') }}">

            </div>

        </div>


    </div>

@endsection



{{--example form--}}
{{--
<form method="post" action="{{ route('register') }}" id="main_form">
    @csrf
    <div class="input-item ">
        <div class="text-item">
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="شماره موبایل">
        </div>
        @error('phone')
        <span class="invalid-feedback" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
        @enderror
        <button class="clear" >
            <svg viewBox="0 0 24 24">
                <path class="line" d="M2 2L22 22"/>
                <path class="long" d="M9 15L20 4"/>
                <path class="arrow" d="M13 11V7"/>
                <path class="arrow" d="M17 11H13"/>
            </svg>
        </button>
    </div>
</form>

<div class="withdraw change-submit max-width" onclick="(() => { document.getElementById('main_form').submit() })()">
    <img src="client/assets/icons/continue.svg">
    ادامه
</div>
--}}

