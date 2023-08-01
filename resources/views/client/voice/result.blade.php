@extends('client.index')
@section('content')


    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row pages">
                <div class="div-center col-lg-12 col-md-12 col-sm-12">
                    <div class="voice-item row">
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <h1 class="service-title">
                                {{'پاسخ ارزیابی ' . $voice->prettyDate()}}
                            </h1>
                        </div>
                        <div class=" col-lg-12 col-md-12 col-sm-12">
                            <p>
                               {{$voice->response}}
                            </p>
                        </div>
                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection
