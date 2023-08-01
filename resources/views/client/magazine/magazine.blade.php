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
                                    عناوین مقالات

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
                                            <a style="margin-right: 0px" href="{{ route('all_magazine' , $category->slug) }}">

                                                <div class="circles panel-{{ $arr[$loop->index] }}">
                                                    <div class="image-item">
                                                        <img src="{{ get_image($category->image) == null ? asset('client/assets/photo/sample.jpeg') : get_image($category->image)}}">
                                                    </div>
                                                    <h3 style="width: 100%">
                                                        {{ $category->title }}
                                                    </h3>
                                                    <a style="color: inherit"
                                                       href="{{ route('all_magazine' , $category->slug) }}">
                                                        بیشتر بدانید
                                                    </a>
                                                </div>
                                            </a>
                                            @if(in_array($loop->index , $arr_close))
                                        </div>
                                    @endif

                                @endforeach

                                <div class="small panel-7"></div>


                            </div>

                        </div>

                        @if($most_viewed_blogs->count() > 0)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1>
                                    پربیننده ترین مقالات

                                </h1>

                                <div class="row main-service-row">
                                    @each('components.blog', $most_viewed_blogs, 'blog')
                                </div>
                            </div>
                        @endif
                        @if($tags->count() > 0)
                            <div class="main-tag-row col-lg-12 col-md-12 col-sm-12">
                                <h1>
                                    برچسب های جذاب

                                </h1>
                                <div class="scroll tag-row">
                                    @each('components.tag', $tags, 'tag')

                                </div>
                            </div>
                        @endif
                        @if($newest_blogs->total()> 0)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1>
                                    تازه ترین مقالات

                                </h1>

                                <div class="row main-service-row">
                                    @each('components.blog', $newest_blogs->items(), 'blog')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{ $newest_blogs->onEachSide(3)->links('components.page_numbers') }}

            </div>
        </div>

    </div>

    </div>


@endsection


@section('optional_footer')
    <script src="{{asset('client/assets/js/scroll.js')}}"></script>
@endsection

{{--<script src="client/assets/js/master.js"></script>--}}

