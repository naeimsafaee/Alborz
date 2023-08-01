
@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            @if($blogs->total()> 0)

                                <div class="item ">
                                    <h1>
                                        تازه ترین مقالات دسته {{$slug}}

                                    </h1>
                                </div>

                                @if($blogs->total()> 0)
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row main-service-row">
                                            @foreach($blogs as$blog)
                                            <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="service-item">
                                                    <div class="imge-box">
                                                        <a href="{{ route('single_magazine' , $blog->slug) }}">
                                                            <img src="{{ get_image($blog->image) == null ? asset('client/assets/photo/sample.jpeg') : get_image($blog->image) }}">
                                                            <img class="gradiant"
                                                                 src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">
                                                        </a>
                                                    </div>

                                                    <h5 class="service-title">{{ $blog->title }}</h5>
                                                    <p>
                                                        {!! $blog->short_desc !!}
                                                    </p>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                        </div>
                        @endif
                    </div>
                </div>
                <div class="pagination">
                    {{ $blogs->onEachSide(3)->links('components.page_numbers') }}

                </div>

            </div>

        </div>

    </div>

@endsection