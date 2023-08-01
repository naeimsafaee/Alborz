<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image(setting('site.logo')) }}">
    <title>{{ setting('title.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    {!! meta() !!}

    <link href="{{asset('client/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/css/Owl-Carousel.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/css/Owl.css')}}" rel="stylesheet">
    <script src="{{asset('client/assets/js/JQUERY.js')}}"></script>
    <script src="{{asset('client/assets/js/ajax.js')}}"></script>
    <script src="{{asset('client/assets/js/Owl-Carousel.js')}}"></script>
    <script src="{{asset('client/assets/js/playerjs.js')}}"></script>
    <script src="{{asset('client/assets/js/tweenmax.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('client/assets/css/master.css?x=112')}}" rel="stylesheet">

    @yield('optional_header')

    <style>
        .border-box-item div {
            direction: rtl;
        }
    </style>

</head>
<body>
<div id="loader"
     style="position: fixed; top:0; left:0; width:100%; height: 100%;display: none; background: url('{{ asset('client/loading.gif') }}') center center no-repeat;z-index: 1000;"></div>

<div class="container-fluid">
    <div class="overlay"></div>

    @yield('modal')

    <ul class=" mobile-menu">
        <img class="close" src="{{asset('client/assets/icon/close.svg')}}">
        <li><a href="{{route('home')}}" class="nav-links">
                <img src="{{ get_image(setting('site.logo')) }}">
            </a></li>
        <li><a href="{{route('home')}}" class="nav-links space">صفحه اصلی</a></li>
        <li><a href="{{route('home') . '#khadamat'}}" class="nav-links" style="cursor: pointer"> خدمات </a></li>
        <li><a href="{{route('magazine')}}" class="nav-links"> مجله </a></li>
        <li><a href="{{route('podcast_video')}}" class="nav-links"> ویدئو و پادکست ها </a></li>
        <li><a href="{{route('contact_us')}}" class="nav-links"> تماس با ما </a></li>
    </ul>
    <div class="modal  bs-example-modal-new" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">

        <div class="modal-dialog">

            <!-- Modal Content: begins -->
            <div class="modal-content">

                <!-- Modal Header -->


                <!-- Modal Body -->
            @yield('optional_index')

            <!-- Modal Footer -->
                <button type="button" class="close-item" data-dismiss="modal"><img
                            src="{{asset('client/assets/icon/modalclose.svg')}}">
                </button>

            </div>
            <!-- Modal Content: ends -->

        </div>

    </div>
    <div class="row ">
        @include('client.header')
        @yield('content')
    </div>
    @include('client.footer')
</div>
<script src="{{asset('client/assets/js/BOOTSTRAP.js')}}"></script>

@yield('optional_footer')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){window.dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'GA_MEASUREMENT_ID');
</script>

</body>
</html>
