@extends('client.index')
@section('content')
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row ">
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="item">
                                    <h1>
                                        {{ setting('aboutus.title') }}
                                    </h1>
                                    <p>
                                        {!! \App\Models\AboutUs::query()->find(1)->value !!}
                                    </p>

                                </div>

                                <div class="start-row">
                                    <a class="online-test"  data-toggle="modal" data-target="#myModal">
                                        <img src="{{asset('client/assets/icon/white-video.svg')}}">
                                        مشاهده ویدیو معرفی
                                    </a>
                                </div>

                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div id="about-us-item" class="imge-box">
                                    <img src="{{get_image(setting('aboutus.image'))}}">

                                </div>



                            </div>


                        </div>


                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="title-row">
                            <div>
                                <h1>

                                    گالری تصاویر مرکز گفتاردرمانی البرز آترا
                                </h1>
                            </div>
                        </div>




                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="owl-carousel3" class="owl-carousel owl-theme">
                @foreach($images as $image)
                <div class="item" >
                    <div class="imge-box">
                        <img src="{{get_cropped_image($image->image)}}">

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div class="text-center div-center col-lg-12 col-md-12 col-sm-12">

                        <h1 >
                            {{ setting('aboutus.title2') }}

                        </h1>
                        <br/>
                        <p>
                            {!! setting('aboutus.desc2') !!}
                        </p>
                        <br/>
                        <br/>



                    </div>
                    <div class="  col-lg-12 col-md-12 col-sm-12">
                        <dv class="row">
                            @foreach($galleries as $gallery)
                            <div class="  col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                <div class="about-us-item">
                                    <div class="imge-box">
                                        <a href="{{$gallery->link}}">
                                        <img src="{{get_cropped_image($gallery->image)}}" />


                                        </a>

                                    </div>
                                    <h1>
                                        {{$gallery->title}}
                                    </h1>
                                    <p>
                                        {{$gallery->description}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </dv>
                    </div>

                </div>

            </div>

        </div>

@endsection

@section('optional_footer')

<script>
    $('#owl-carousel3').owlCarousel({
        margin:20,
        loop:true,
        autoWidth:true,
        dots:false,
        center: true,
        items:3.5
    })
</script>

<script>
        $('#myModal').on('shown.bs.modal', function () {
            player.api("play");
        })
        $('#myModal').on('hidden.bs.modal', function () {
            player.api("pause");
        })


        var player = new Playerjs(
            {
                id:"player",
                file:"{{ setting('aboutus.video') }}",
                // poster:'آدرس پوستر
            }
        );
    </script>
@endsection
@section('modal')

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="player"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
