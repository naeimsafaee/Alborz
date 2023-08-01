@extends('client.index')
@section('content')
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div id="div-center" class="text-center div-center col-lg-12 col-md-12 col-sm-12">
                        <div id="about-doctor" class="about-us-item">
                            <div class="imge-box">
                                <img src="{{get_image($doctor->image)}}">
                            </div>
                            <h1>
                                {{$doctor->full_name}}
                            </h1>
                        </div>
                        <h1 >
                            درباره درمانگر
                        </h1>
                        <br/>
                        <p>
                            {!! $doctor->description !!}
                        </p>
                        <br/>
                        <br/>



                    </div>

                </div>

            </div>

        </div>
    
@endsection
