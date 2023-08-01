@extends('client.index')
@section('content')
        <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="center-item">
                            <div  class="row main-row2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="title-row">
                                        <a class="answer-item">
                                            امتیاز شما : {{ $weight }}
                                        </a>
                                    </div>
                                    <div class="border-box-item">

                                        <div id="right-item" class="right-item ">
                                            <h1>
                                                پاسخ ادمین
                                            </h1>
                                            <p>
                                               {!! $answer !!}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
@endsection

