<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="nav-container">

        @if(\App\Models\Banner::query()->where('is_active' , '=' , true)->count() > 0)

            <a href="#" class="top-header">
                <span>
                   {{ \App\Models\Banner::query()->where('is_active' , '=' , true)->firstOrFail()->text }}
                </span>
                <span class="v-line"></span>
                <span>بیشتر بدانید</span>
                <a href="{{ \App\Models\Banner::query()->where('is_active' , '=' , true)->firstOrFail()->url }}">
                    <span>
                    <img src="{{asset('client/assets/icon/header-arrow.svg')}}">
                    </span>
                </a>
            </a>

        @endif
        <nav class="navbar">
            <div href="#" id="left-nav">
                <a class="account-button" href="{{route('profile')}}">
                    <img src="{{asset('client/assets/icon/accont.svg')}}">
                    حساب کاربری
                </a>
                <a href="{{route('search')}}">
                    <img class="search" src="{{asset('client/assets/icon/search.svg')}}">
                </a>

            </div>
            <div class="menu-toggle" id="mobile-menu">
                <img src="{{asset('client/assets/icon/menu.svg')}}">
            </div>
            <ul class="nav-menu">
                <li class="logo"><a href="{{route('home')}}" class="nav-links ">
                        <img src="{{ get_image(setting('site.logo')) }}">
                    </a></li>
                <li>
                    <a href="{{route('home')}}" class="nav-links">
                        <span></span>

                        صفحه اصلی
                    </a>
                </li>
                <li>
                    <a href="{{route('home') . '#khadamat'}}" class="nav-links" style="cursor: pointer">
                        <span></span>
                        خدمات
                    </a>
                </li>
                <li>
                    <a href="{{route('magazine')}}" class="nav-links"> مجله
                        <span></span>

                    </a>
                </li>
                <li><a href="{{route('podcast_video')}}" class="nav-links"> ویدئو و پادکست ها
                        <span></span>

                    </a></li>
                {{--                <li><a href="{{route('exam')}}" class="nav-links">--}}
                {{--                        <span></span>--}}

                {{--                        ارزیابی آنلاین </a></li>--}}
                <li><a href="{{route('contact_us')}}" class="nav-links"> تماس با ما
                        <span></span>

                    </a></li>
            </ul>
        </nav>

    </div>

</div>
