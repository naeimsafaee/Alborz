@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="item ">
                                <h1>
                                    مقالات هشتگ {{$tag->title}}

                                </h1>
                            </div>
                            <div class="tag-row">
                                @each('components.tag', $tags, 'tag')
                            </div>


                            <div class="row main-service-row">
                                @each('components.blog', $blogs->items(), 'blog')

                            </div>
                        </div>
                    </div>



                </div>
                <div class="pagination">
                    {{ $blogs->onEachSide(3)->links('components.page_numbers') }}

                </div>

            </div>

        </div>

    </div>

@endsection
{{--<script src="client/assets/js/master.js"></script>--}}


