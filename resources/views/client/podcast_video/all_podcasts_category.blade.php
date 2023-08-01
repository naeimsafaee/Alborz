
@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            @if($podcasts->total()> 0)

                                <div class="item ">
                                    <h1>
                                        تازه ترین پادکست ها دسته {{$slug}}

                                    </h1>
                                </div>

                                @if($podcasts->total()> 0)
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="row main-service-row">
                                            @each('components.podcast_1', $podcasts, 'podcast')

                                        </div>
                                    </div>
                                @endif

                        </div>
                        @endif
                    </div>
                </div>
                <div class="pagination">
                                        {{ $podcasts->onEachSide(3)->links('components.page_numbers') }}

                </div>

            </div>

        </div>

    </div>

@endsection