
@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            @if($videos->total()> 0)

                            <div class="item ">
                                <h1>
                                    تازه ترین ویدیو های دسته {{$slug}}

                                </h1>
                            </div>

                            <div class="row main-service-row">
                                @each('components.podcast_1', $videos, 'podcast')

                            </div>

                        </div>
                        @endif
                    </div>
                </div>
                <div class="pagination">
{{--                    {{ $videos->onEachSide(3)->links('components.page_numbers') }}--}}

                </div>

            </div>

        </div>

    </div>

@endsection