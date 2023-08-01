@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="item ">
                                <h1>
                                    دسته بندی پادکست ها
                                </h1>
                            </div>
                            <div class="circle-row" id="circle-row">

                                @php
                                    $arr_open = [0 , 2 , 3 , 5];
                                    $arr_close = [1 , 2 , 4 , 5];
                                    $arr = [1 , 3 , 2 , 4 , 5 , 6];
                                @endphp
                                @foreach($categories as $category)

                                    @if(in_array($loop->index , $arr_open))
                                        <div class="small">
                                            @endif
                                            <a style="margin-right: 0px" href="{{ route('podcast_category' , $category->slug) }}">
                                                <div class="circles panel-{{ $arr[$loop->index] }}">
                                                    <div class="image-item">
                                                        <img src="{{ get_image($category->image) == null ? asset('client/assets/photo/sample.jpeg') : get_image($category->image)}}">
                                                    </div>
                                                    <h3 style="width: 100%">
                                                        {{ $category->title }}
                                                    </h3>
                                                    <a style="color: inherit"
                                                       href="{{ route('podcast_category' , $category->slug) }}">
                                                        بیشتر بدانید
                                                    </a>
                                                </div>
                                            </a>
                                            @if(in_array($loop->index , $arr_close))
                                        </div>
                                    @endif

                                @endforeach
                                {{--
                                @if($categorys->count() > 0)
                                    <div class="small">

                                        <div class="circles panel-1">
                                            <div class="image-item">
                                                @if($categorys->skip(0)->first()->image)
                                                    <img src="{{ get_image($categorys->skip(0)->first()->image) }}">
                                                @else
                                                    <img src="{{ asset('client/assets/photo/sample.jpeg') }}">

                                                @endif
                                            </div>
                                            <h3>
                                                {{ $categorys->skip(0)->first()->title }}
                                            </h3>
                                            <a>
                                                بیشتر بدانید
                                            </a>
                                        </div>
                                        @if($categorys->count() > 1)

                                            <div class="circles panel-3">
                                                <div class="image-item">
                                                    @if($categorys->skip(1)->first()->image)
                                                        <img src="{{ get_image($categorys->skip(1)->first()->image) }}">
                                                    @else
                                                        <img src="{{ asset('client/assets/photo/sample.jpeg') }}">

                                                    @endif
                                                </div>
                                                <h3>
                                                    {{ $categorys->skip(1)->first()->title }}
                                                </h3>
                                                <a>
                                                    بیشتر بدانید
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                    @if($categorys->count() > 2)
                                        <div class="small">

                                            <div class="circles panel-2">
                                                <div class="image-item">
                                                    @if($categorys->skip(2)->first()->image)
                                                        <img src="{{ get_image($categorys->skip(2)->first()->image) }}">
                                                    @else
                                                        <img src="{{ asset('client/assets/photo/sample.jpeg') }}">
                                                    @endif
                                                </div>
                                                <h3>
                                                    {{ $categorys->skip(2)->first()->title }}
                                                </h3>
                                                <a>
                                                    بیشتر بدانید
                                                </a>
                                            </div>

                                        </div>
                                    @endif
                                    @if($categorys->count() > 3)

                                        <div class="small">

                                            <div class="circles panel-4">
                                                <div class="image-item">
                                                    @if($categorys->skip(3)->first()->image)
                                                        <img src="{{ get_image($categorys->skip(3)->first()->image) }}">
                                                    @else
                                                        <img src="{{ asset('client/assets/photo/sample.jpeg') }}">
                                                    @endif
                                                </div>
                                                <h3>
                                                    {{ $categorys->skip(3)->first()->title }}
                                                </h3>
                                                <a>
                                                    بیشتر بدانید
                                                </a>
                                            </div>

                                            <div class="circles panel-5">
                                                <div class="image-item">
                                                    @if($categorys->skip(4)->first()->image)
                                                        <img src="{{ get_image($categorys->skip(4)->first()->image) }}">
                                                    @else
                                                        <img src="{{ asset('client/assets/photo/sample.jpeg') }}">
                                                    @endif
                                                </div>
                                                <h3>
                                                    {{ $categorys->skip(4)->first()->title }}
                                                </h3>
                                                <a>
                                                    بیشتر بدانید
                                                </a>
                                            </div>

                                        </div>
                                    @endif
                                    @if($categorys->count() > 5)
                                        <div class="small">

                                            <div class="circles panel-6">
                                                <div class="image-item">
                                                    @if($categorys->skip(5)->first()->image)
                                                        <img src="{{ get_image($categorys->skip(5)->first()->image) }}">
                                                    @else
                                                        <img src="{{ asset('client/assets/photo/sample.jpeg') }}">
                                                    @endif
                                                </div>
                                                <h3>
                                                    {{ $categorys->skip(5)->first()->title }}
                                                </h3>
                                                <a>
                                                    بیشتر بدانید
                                                </a>
                                            </div>

                                        </div>
                                    @endif

                                @endif
        --}}
                                <div class="small panel-7"></div>


                            </div>
                        </div>
                        @if($newest_podcasts->total()> 0)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1>
                                    تازه ترین پادکست ها
                                </h1>

                                <div class="row main-service-row">
                                    @each('components.podcast_1', $newest_podcasts, 'podcast')

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{ $newest_podcasts->onEachSide(3)->links('components.page_numbers') }}

            </div>

        </div>

    </div>

@endsection