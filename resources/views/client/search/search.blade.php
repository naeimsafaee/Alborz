@extends('client.index')
@section('content')
    {{--<h1>search</h1>--}}

    @if(!$search)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row pages">
                    <div id="div-center" class="div-center col-lg-12 col-md-12 col-sm-12">
                        <form action="{{ route('search') }}" method="GET">
                            <div id="input-row" class="input-row">
                                <img src="client/assets/icon/search-icon.svg">
                                <input name="search" type="text" placeholder=" جستجو در سایت"
                                       value="{{ request()->search }}">
                            </div>
                        </form>
                        <div class="about-us-item">
                            <h5 class="search-title">
                                جستجو در مقالات، پادکست ها و ویدیو ها
                            </h5>
                            <div class="box">
                            <img src="client/assets/icon/search-photo.svg">
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </div>
    @elseif($search->count() == 0)
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class="row main-row pages">
                    <div id="div-center" class="div-center col-lg-12 col-md-12 col-sm-12">
                        <form action="{{ route('search') }}" method="GET">
                            <div id="input-row" class="input-row">
                                <img src="{{ asset('client/assets/icon/search-icon.svg') }}">
                                <input name="search" type="text" placeholder=" جستجو در سایت"
                                       value="{{ request()->search }}">
                            </div>
                        </form>
                        <div class="about-us-item">
                            <h5 class="search-title">
                                نتیجه از جستجوی کلمه "{{ request()->search }}" یافت نشد
                            </h5>
                            <img src="{{ asset('client/assets/icon/search-result-not-find.svg') }}">

                        </div>


                    </div>

                </div>

            </div>
        </div>
    @else
        <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div class=" row main-row pages">
                    <div id="div-center2" class="div-center col-lg-12 col-md-12 col-sm-12">
                        <form action="{{ route('search') }}" method="GET">
                            <div id="input-row" class="input-row">
                                <img src="{{ asset('client/assets/icon/search-icon.svg') }}">
                                <input name="search" type="text" placeholder=" جستجو در سایت"
                                       value="{{ request()->search }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row main-row pages">
                    <div class="d col-lg-12 col-md-12 col-sm-12">
                        <p>
                            نتیجه {{ $search->total()}} از جستجو کلمه "{{ request()->search }}"
                        </p>

                        @each('components.search', $search->items(), 'search')

                        <div class="pagination">
                            {{ $search->onEachSide(3)->links('components.page_numbers') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endif

@endsection

