@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row pages">
                <div id="div-center" class="div-center col-lg-12 col-md-12 col-sm-12">

                    <h1 >
                        {!! setting('contact-us.title') !!}

                    </h1>
                    <p>
                        {!! setting('contact-us.desc') !!}
                    </p>
                    <form method="POST" action="{{route('contact_us_save')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="input-row">
                                    <label>نام </label>
                                    <input type="text"  name="name" placeholder="نام  ">
                                    @error('name')
                                    <span style="color:#ff0000">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="input-row">
                                    <label> شماره موبایل </label>
                                    <input type="text" name="phone" placeholder=" شماره موبایل  ">
                                    @error('phone')
                                    <span style="color:#ff0000">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input-row">
                                    <label> درخواست   </label>
                                    <textarea type="text" name="description" placeholder=" توضیح  "></textarea>
                                    @error('description')
                                    <span style="color:#ff0000">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>
                        </div>
                        <button type="submit" class="online-test login">
                            ارسال پیام
                            <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                        </button>

                    </form>



                </div>

            </div>

        </div>

    </div>

@endsection