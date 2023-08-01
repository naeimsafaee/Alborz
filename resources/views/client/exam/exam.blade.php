@extends('client.index')
@section('content')
    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="center-item">
                        <div class="row main-row2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="border-box-item">

                                    <img class="examine-image" src="{{ asset('client/assets/icon/examine%20.svg') }}">
                                    <div class="right-item">
                                        <h1>
                                            {{ $exam->title }}
                                        </h1>
                                        <p>
                                            {!! $exam->description !!}
                                        </p>

                                        @if(!$has_bought)
                                            <div class="start-row">
                                                <a href="{{ route('buy_exam' , $exam->id) }}"
                                                   class="online-test green-bg">
                                                    خرید این ارزیابی
                                                    <img src="{{ asset('client/assets/icon/shopping.svg') }}">

                                                </a>
                                                <div>
                                                    @if($exam->price > 0)
                                                        <h5>
                                                            {{ fa_number(number_format($exam->price)) }}
                                                        </h5>
                                                        <p>
                                                            تومان
                                                        </p>
                                                    @else
                                                        <h5>رایگان</h5>
                                                    @endif

                                                </div>

                                            </div>
                                        @else
                                            <div class="start-row">
                                                <a class="online-test "
                                                   href="{{ route('questions' , [$exam->id , 0]) }}" style="color:#FFFFFF!important">
                                                    ورود به ارزیابی
                                                    <img src="{{ asset('client/assets/icon/white-arrow.svg') }}">
                                                </a>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                @if(count($related) > 0)
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <h1>
                            {{ setting('site.exams_title') }}
                        </h1>

                        <div class="row  ">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    {{--<div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="Assessment-item">
                                            <div class="massage-box">
                                                <img src="client/assets/icon/massage.svg">
                                            </div>
                                            <h5>
                                                نام موضوعی ارزیابی
                                                <br/>
                                                در این دسته
                                            </h5>
                                            <a class="start">
                                                شروع
                                                <span>
                                                    <img src="client/assets/icon/little-arrow.svg">
                                                </span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                                        <div class="Assessment-item   " >
                                            <div class="massage-box">
                                                <img src="client/assets/icon/massage.svg">
                                            </div>
                                            <h5>
                                                نام موضوعی ارزیابی
                                                <br/>
                                                در این دسته
                                            </h5>
                                            <a class="start">
                                                شروع
                                                <span>
                                                    <img src="client/assets/icon/little-arrow.svg">
                                                </span>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12 " >
                                        <div class="Assessment-item   " >
                                            <div class="massage-box">
                                                <img src="client/assets/icon/massage.svg">
                                            </div>
                                            <h5>
                                                نام موضوعی ارزیابی
                                                <br/>
                                                در این دسته
                                            </h5>
                                            <a class="start">
                                                شروع
                                                <span>
                                                    <img src="client/assets/icon/little-arrow.svg">
                                                </span>
                                            </a>

                                        </div>
                                    </div>
    --}}
                                    @php
                                        $arr = [
                                                    ['Assessment-item' , '' , ''],
                                                    ['Assessment-item margin shollex' , '45' , '20'] ,
                                                    ['Assessment-item margin2 shollex'  , "90" , '40']
                                                ]
                                    @endphp

                                    @foreach($related as $exam)

                                        @php
                                            $exam["category_title"] = "";
                                        @endphp

                                        <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="{{ $arr[$loop->index][0] }}"
                                                 data-initial-margin-top="{{ $arr[$loop->index][1] }}"
                                                 data-speed="{{ $arr[$loop->index][2] }}">

                                                @each('components.exam', [$exam] , 'exam')

                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                @endif

                @if($last_blogs && count($last_blogs) > 0)
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="center-item">
                            <div class="row main-row2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="">
                                        <div>

                                            <h1>
                                                محصولات مرتبط
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row main-service-row">
                                                @foreach($last_blogs as $blog)

                                                    <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="service-item">
                                                            <div class="imge-box">
                                                                <a href="{{ route('shop' , $blog["slug"] )}}">
                                                                    <img class="gradiant"
                                                                         src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                                                    <img src="{{ get_image($blog["main_image"]) }}">
                                                                </a>
                                                            </div>
                                                            <p class="text">
                                                                {{--        {{ $service-> }}--}}
                                                            </p>

                                                            <h5 class="service-title">{{ $blog["name"] }}</h5>
                                                            <div class="title-row">
                                                                <div>
                                                                    @if($blog["price"] == 0)
                                                                        <h5>رایگان</h5>
                                                                    @else
                                                                        <h5>
                                                                            {{ fa_number(number_format($blog["price"])) }}
                                                                        </h5>
                                                                        <p>
                                                                            تومان
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <a class="service-icon">
                                                                    <img src="{{ asset('client/assets/icon/basket.svg') }}">
                                                                </a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection



