@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div class="row main-row ">
                <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div class="fag-image imge-box">
                        <img src="{{get_image($page->image)}}">
                        <img class="{{asset('gradiant" src="client/assets/icon/Rectangle%201308.svg')}}">
                    </div>

                </div>
                <div id="center-item" class="center-item col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="item">
                                <h1>
                                    {{$page->title}}
                                </h1>
                                <p>
                                    {!!  $page->content!!}
                                </p>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


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