@extends('client.index')
@section('content')
        <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
            <div class="container2">
                <div  class="row main-row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="center-item">
                            <div  class="row main-row2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="border-box-item">

                                        <div id="right-item" class="right-item ">
                                            <h1>
                                                نتیجه آزمون با پاسخ نیاز به بررسی ادمین
                                            </h1>
                                            <p>
                                                {{ setting('exam.answer') }}
                                            </p>
                                            <div class="start-row">
                                                <a class="online-test " id="fkkfngnj" onclick="(() => {  $('#fkkfngnj').fadeOut(300); setTimeout(() => { $('#asddsa').fadeIn(300); } , 400)})()">
                                                    ثبت درخواست بررسی
                                                    <img  src="{{ asset('client/assets/icon/white-arrow.svg') }}">

                                                </a>

                                                <div class="start-row">
                                                <a class="submit-massage " id="asddsa" style="display: none">
                                                    درخواست ثبت شد منتظر باشید

                                                </a>

                                            </div>
                                            <br/>
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

