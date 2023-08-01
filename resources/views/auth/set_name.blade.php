@extends('client.index')
@section('content')

    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="login_form">
            <div class="details">
                <h1>
                    پروفایل شما ایجاد شد
                </h1>
                <form action="{{ route('set_name') }}" method="post">
                    <div class="input-row">
                        <label>
                            نام خود را وارد نمایید
                        </label>
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="نام شما">
                    </div>

                    <button type="submit" class="online-test login">
                        ادامه برای ورود
                        <img src="{{ asset('client/assets/icon/left-arrow-white.svg') }}">

                    </button>
                </form>


            </div>
            <div class="details-two">
                <img src="{{ asset('client/assets/icon/regusre2.svg') }}">
            </div>

        </div>


    </div>

@endsection