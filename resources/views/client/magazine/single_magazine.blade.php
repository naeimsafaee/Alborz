@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row ">
                <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div class="fag-image imge-box">
                        <img src="{{get_cropped_image($blog->image , "single")}}">
                        <img class="{{asset('gradiant" src="client/assets/icon/Rectangle%201308.svg')}}">
                    </div>

                </div>
                <div id="center-item" class="center-item col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="item">
                                <h1>
                                    {{$blog->title}}
                                </h1>
                                <p>
                                    {!!  $blog->description!!}
                                </p>

                            </div>
                            {{--                            <h1>--}}
                            {{--                                ویدیو یا پادکست های بین مقاله این عنوان از ادمین مدیریت میشود--}}
                            {{--                            </h1>--}}
                            {{--                            <div class="headline-item blu-bg">--}}
                            {{--                                <div class="arrow-item">--}}
                            {{--                                    <img src="{{ asset('client/assets/icon/left-arrow-white.svg') }}">--}}

                            {{--                                </div>--}}
                            {{--                                <div class="content-item">--}}
                            {{--                                    <h5>--}}
                            {{--                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده--}}
                            {{--                                    </h5>--}}

                            {{--                                </div>--}}

                            {{--                            </div>--}}
                            {{--                            <div class="headline-item blu-bg">--}}
                            {{--                                <div class="arrow-item">--}}
                            {{--                                    <img src="{{ asset('client/assets/icon/left-arrow-white.svg') }}">--}}

                            {{--                                </div>--}}
                            {{--                                <div class="content-item">--}}
                            {{--                                    <h5>--}}
                            {{--                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده--}}
                            {{--                                    </h5>--}}

                            {{--                                </div>--}}

                            {{--                            </div>--}}
                            {{--                            </br>--}}
                            {{--                            <p>--}}
                            {{--                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.--}}
                            {{--                                </br>--}}
                            {{--                                </br>--}}
                            {{--                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
                            {{--                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
                            {{--                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.--}}
                            {{--                            </p>--}}
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="fag-item">
                                <div class="right-fag-tag-item">
                                    <div class="about-doctor">
                                        <a href="{{route('about_dr' , $blog->doctor->slug)}}">
                                            <div class="imge-box">
                                                <img src="{{get_image($blog->doctor->image)}}">
                                            </div>
                                        </a>

                                    </div>
                                    <h5>
                                        {{$blog->doctor->full_name}}
                                    </h5>
                                </div>
                                <div class="fag-tag-item">

                                    <h5 class="margin">
                                        هشتک های مرتبط
                                    </h5>
                                    @each('components.tag', $blog->tags, 'tag')
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="line">

                            </div>
                            <div id="start-row" class="start-row">
                                <div class="about-doctor">
                                    <p class="seprate">
                                        دسته بندی مقالات
                                    </p>
                                    @foreach($blog->categories as $category)
                                        <a id="tag-item" class="tag-item">
                                            {{$category->title}}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="about-doctor">
                                    <p class="seprate">
                                        اشتراک با دوستان
                                    </p>
                                    <a class="social-item" href="{{ $blog->twitter_link }}">
                                        <img src="{{asset('client/assets/icon/black-twitter.svg')}}">
                                    </a>
                                    <a class="social-item" href="{{ $blog->whatsapp_link }}">
                                        <img src="{{asset('client/assets/icon/black-whatsapp%201.svg')}}">
                                    </a>
                                    <a class="social-item" href="{{ $blog->telegram_link }}">
                                        <img src="{{asset('client/assets/icon/black-telegram.svg')}}">
                                    </a>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>
    {{--    <div class="col-lg-12 col-md-12 col-sm-12">--}}
    {{--        <div class="container2">--}}
    {{--            <div  class="row main-row ">--}}
    {{--                <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12  " >--}}
    {{--                    <h1>--}}
    {{--                        محصولات مرتبط--}}
    {{--                    </h1>--}}
    {{--                </div>--}}

    {{--                <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12  " >--}}
    {{--                    <div class="service-item">--}}
    {{--                        <div class="imge-box">--}}
    {{--                            <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">--}}

    {{--                            <img src="{{ asset('client/assets/photo/sample.jpeg') }}">--}}
    {{--                        </div>--}}
    {{--                        <p class="text">--}}
    {{--                            لکنت--}}
    {{--                        </p>--}}
    {{--                        <h5 class="service-title">درمان لکنت بزرگسالان</h5>--}}
    {{--                        <div class="title-row">--}}
    {{--                            <div>--}}
    {{--                                <h5>--}}
    {{--                                    ۲۰۰۰٫۰۰۰ تومان--}}
    {{--                                </h5>--}}
    {{--                                <p>--}}
    {{--                                    تومان--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <a class="service-icon">--}}
    {{--                                <img src="{{ asset('client/assets/icon/basket.svg') }}">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}


    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12  " >--}}
    {{--                    <div class="service-item">--}}
    {{--                        <div class="imge-box">--}}
    {{--                            <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">--}}

    {{--                            <img src="{{ asset('client/assets/photo/sample.jpeg') }}">--}}
    {{--                        </div>--}}
    {{--                        <p class="text">--}}
    {{--                            لکنت--}}
    {{--                        </p>--}}
    {{--                        <h5 class="service-title">درمان لکنت بزرگسالان</h5>--}}
    {{--                        <div class="title-row">--}}
    {{--                            <div>--}}
    {{--                                <h5>--}}
    {{--                                    ۲۰۰۰٫۰۰۰ تومان--}}
    {{--                                </h5>--}}
    {{--                                <p>--}}
    {{--                                    تومان--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <a class="service-icon">--}}
    {{--                                <img src="{{ asset('client/assets/icon/basket.svg') }}">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}


    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12  " >--}}
    {{--                    <div class="service-item">--}}
    {{--                        <div class="imge-box">--}}
    {{--                            <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">--}}

    {{--                            <img src="{{ asset('client/assets/photo/sample.jpeg') }}">--}}
    {{--                        </div>--}}
    {{--                        <p class="text">--}}
    {{--                            لکنت--}}
    {{--                        </p>--}}
    {{--                        <h5 class="service-title">درمان لکنت بزرگسالان</h5>--}}
    {{--                        <div class="title-row">--}}
    {{--                            <div>--}}
    {{--                                <h5>--}}
    {{--                                    ۲۰۰۰٫۰۰۰ تومان--}}
    {{--                                </h5>--}}
    {{--                                <p>--}}
    {{--                                    تومان--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <a class="service-icon">--}}
    {{--                                <img src="{{ asset('client/assets/icon/basket.svg') }}">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}


    {{--                    </div>--}}

    {{--                </div>--}}

    {{--            </div>--}}

    {{--        </div>--}}

    {{--    </div>--}}

        <div class="div-center col-lg-12 col-md-12 col-sm-12">
            <form id="add_comment">
                @csrf
                <div class="input-row">
                    <label>
                        دیدگاه شما
                    </label>
                    <textarea id="comment_text" class="textarea" type="text"
                              placeholder="دیدگاه خود را بنویسید"></textarea>

                </div>
                <a class="online-test login" @if(auth()->guard('clients')->check()) onclick="add_comment()" @else href="{{ route('login') }}" @endif>
                    ثبت دیدگاه
                    <img src="{{asset('client/assets/icon/left-arrow-white.svg')}}">
                </a>
                <span id="show_comment"></span>
            </form>

            <script>

                function add_comment() {

                    document.getElementById('show_comment').style.display = "none";
                    const url = "{{ route('set_comment_blog') }}";

                    const posting = $.post(url, {
                        _token: document.getElementsByName("_token")[0].value,
                        blog_id: {{ $blog->id }},
                        text: $('#comment_text').val(),
                    });

                    posting.done((data) => {
                        console.log(data);
                        document.getElementById('show_comment').innerHTML = "نظر ثبت شده پس از تایید نمایش داده می شود";
                        document.getElementById('show_comment').style.display = "block";
                    });
                    posting.fail((err) => {
                        console.log(err);
                        document.getElementById('show_comment').innerHTML = "ثبت کامنت با خطا مواجه شد";
                        document.getElementById('show_comment').style.display = "block";
                    });
                }
            </script>



            @foreach($blog->comments as $comment)
                <div class="massage headline-item">
                    <div class="imge-box">
                        <img src="{{asset('client/assets/photo/doctor2.jpeg')}}">

                    </div>
                    <div class="massage-content">
                        <h5>
                            {{ $comment->client->name }}
                        </h5>
                        <p>
                            {{ $comment->text }}
                        </p>
                        <p class="date">
                            {{ $comment->shamsi_date }}
                        </p>
                        {{--todo @if($comment->reply_to)
                            <div class="answer-massage">
                                <p>
                                    پاسخ ادمین
                                </p>
                                <p>
                                    محصول به‌شدت مقرون به صرفه‌ای است و خرید ان را به همگان توصیه
                                    می‌کنم.امیدوارم هر
                                    چه زودتر دوباره موجود شود.
                                </p>
                            </div>
                        @endif--}}

                        <div class="line"></div>

                    </div>

                </div>
            @endforeach

            @if($blog->comments->count() == 0)
                <div class="about-us-item">
                    <img src="{{ asset('client/assets/icon/comment-empty.svg') }}">
                    <h6 class="margin">
                        اولین دیدگاه رو شما ثبت کنید
                    </h6>
                </div>
            @endif
        </div>

@endsection
@section('optional_footer')
    <script>
        window.onload = function () {
            let content = $('#center-item')
            let htmlString = content.html();
            htmlString = htmlString.replaceAll('{', '<div class="headline-item blu-bg"><div class="arrow-item"><img src="assets/icon/left-arrow-white.svg"></div><div class="content-item"><h5>');
            htmlString = htmlString.replaceAll('}', '</h5></div></div>');
            content.html(htmlString);
        }
    </script>
@endsection