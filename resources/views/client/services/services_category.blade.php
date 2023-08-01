@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row  main-row">
                <div class="services-row col-lg-12 col-md-12 col-sm-12">
                    <div class="item">
                        <img class="Ellipse7" src=" {{ asset('client/assets/icon/about-Ellipse.svg') }}">
                        <img class="Ellipse8" src="{{ asset('client/assets/icon/about-Ellipse2.svg') }}">
                        <img class="Ellipse9" src="{{ asset('client/assets/icon/about-Ellipse3.svg') }}">

                        <h1>
                            {{ $service->title }}
                        </h1>
                        <p>
                            {!! $service->description !!}
                        </p>

                    </div>

                    <div id="start-row" class="start-row">
                        <a class="about-doctor" href="{{ route('about_dr', $service->doctor->slug)}}">
                            <div class="imge-box">
                                <img src="{{ get_image($service->doctor->image)}}">

                            </div>
                            درباره درمانگر بیشتر بدانید
                        </a>
                        <a id="online-test" data-toggle="modal" data-target=".bs-example-modal-new" class="online-test">
                            <img src="{{ asset('client/assets/icon/test-list-pen-edit%201.svg') }}">
                            نوبت گیری
                        </a>

                    </div>
                    @if(session()->has('flag'))
                        <div style="float: left;" class="alert alert-success">پیام شما با موفقیت ثبت شد</div>
                    @endif

                </div>

            </div>

        </div>

    </div>

    @if(count($service->podcasts_and_videos) > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>
                                <h1>
                                    تازه ترین پادکست ها و ویدیو ها {{ $service->title }}
                                </h1>
                            </div>
                            <a class="see-more" href="{{ route('podcast_category' , $service->service->slug) }}">
                                نمایش همه
                            </a>
                        </div>
                        <div class="row third-row ">
                            <div class="service-row col-lg-5 col-md-4 col-sm-12">
                                <div class="imge-box">
                                    <img src="{{ get_image($service->video_image) }}">
                                    <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-12">
                                <div class="row">
                                    @php
                                        $arr = [['shollex margin' , 45 , 30] , ['' , '' ,''] , ['shollex margin2' , 90 ,60] ,  ['' , '' ,'']]
                                    @endphp

                                    @foreach($service->podcasts_and_videos as $podcast)

                                        @php
                                            $podcast->need_parallex = $arr[$loop->index % 4];
                                        @endphp


                                        @if($loop->index % 2 == 0)
                                            <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                @endif

                                                @each('components.podcast', [$podcast], 'podcast')

                                                @if($loop->index % 2 == 1)
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </div>
    @endif

    @if($service->blogs->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>

                                <h1>
                                    مقالات مرتبط
                                </h1>
                            </div>
                            <a class="see-more" href="{{ route('all_magazine' , $service->slug) }}">
                                نمایش همه
                            </a>
                        </div>
                        <div class="row third-row ">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">

                                    @each('components.blog', $service->blogs, 'blog')

                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </div>
    @endif

    @if($service->exams->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>

                                <h1>
                                    {{ setting('site.exams_title') }}
                                </h1>
                            </div>

                        </div>
                        <div class="row third-row ">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">

                                    @php
                                        $arr = [
                                                    ['Assessment-item' , '' , ''],
                                                    ['Assessment-item margin shollex' , '45' , '20'] ,
                                                    ['Assessment-item margin2 shollex'  , "90" , '40']
                                                ]
                                    @endphp

                                    @foreach($service->exams as $exam)

                                        @php

                                            $exam->category_title = $service->title;

                                        @endphp

                                        <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="{{ $arr[$loop->index % 3][0] }}"
                                                 data-initial-margin-top="{{ $arr[$loop->index  % 3][1] }}"
                                                 data-speed="{{ $arr[$loop->index % 3][2] }}">

                                                @each('components.exam', [$exam] , 'exam')

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

    @if($service->products->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>
                                <h1>
                                    تازه ترین محصولات {{ $service->title }}
                                </h1>
                            </div>
                            <a class="see-more" href="{{ route('all_products') }}">
                                نمایش همه محصولات
                            </a>
                        </div>
                        <div class="row second-row">
                            <div class="service-row col-lg-5 col-md-4 col-sm-12">
                                <div class="imge-box">
                                    <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                                    <img src="{{ get_image($service->product_image) }}">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-12">
                                <div class="row">
                                    @php
                                        $arr = [['shollex margin' , 45 , 30] , ['' , '' ,''] , ['shollex margin2' , 90 ,60] ,  ['' , '' ,'']]
                                    @endphp

                                    @foreach($service->products->take(4) as $product)

                                        @php
                                            $product->need_parallex = $arr[$loop->index];
                                        @endphp

                                        @if($loop->index % 2 == 0)
                                            <div class="service-row col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

                                                @endif

                                                @each('components.product', [$product], 'product')

                                                @if($loop->index % 2 == 1)
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </div>
    @endif

@endsection

@section('optional_index')
    <div class="modal-body">
        <div class="body-message">
            <h1>
                درخواست مراجعه
            </h1>
            <p>
                {{ setting('about_us.nobat') }}
            </p>
            <form method="POST" action="{{route('appointment')}}">
                @csrf
                <div class="input-row">
                    <input type="text" name="doctor_id" value="{{$service->doctor->id}}" style="display: none">
                    <div class="input-row">
                        <label>
                            نام
                        </label>
                        <input type="text" name="name" placeholder="نام ">
                        @error('name')
                        <span style="color:#ff0000">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="input-row">
                        <label>
                            شماره موبایل
                        </label>
                        <input type="text" name="phone" placeholder=" شماره موبایل ">
                        @error('phone')
                        <span style="color:#ff0000">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="input-row">
                        <label>
                            متن پیام ارسالی
                        </label>
                        <textarea type="text" name="description" placeholder="متن پیام ارسالی"></textarea>
                        @error('description')
                        <span style="color:#ff0000">{{ $message }}</span>
                        @enderror

                    </div>
                    <button class="online-test login">
                        ثبت درخواست
                        <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                    </button>
                </div>
            </form>


        </div>
    </div>

@endsection
