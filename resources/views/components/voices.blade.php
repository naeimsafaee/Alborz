@if($comments->count() > 0)
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2 client-item-row">
            <div class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="title-row">
                        <div>
                            <p class="text">
                                {{ setting('home.comments_above') }}
                            </p>
                            <h1>
                                {{ setting('home.comments') }}
                            </h1>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">

                    @if($comments->count() > 0)
                        <div class="client-item active comments-item" id="client_item_1">
                            <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                            <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                            <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                            <div id="ppbutton1"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(0)->first()->link }}">
                            </div>

                        </div>
                    @endif

                    @if($comments->count() > 1)
                        <div class="client-item comments-item2" id="client_item_2">
                            <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                            <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                            <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                            <div id="ppbutton2"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(1)->first()->link }}">
                            </div>

                        </div>
                    @endif

                    @if($comments->count() > 2)
                        <div class="client-item comments-item3" id="client_item_3">
                            <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                            <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                            <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                            <div id="ppbutton3"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(2)->first()->link }}">
                            </div>

                        </div>
                    @endif


                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div id="owl-carousel2" class="owl-carousel owl-theme">
                        @foreach($comments as $comment)
                            <div class="item">
                                <h3>
                                    {{$comment->name}}
                                </h3>
                                <p>
                                    {{$comment->comment}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="btns">
                        <div class="customNextBtn"><img src="{{ asset('client/assets/icon/right-arrow.svg') }}"></div>
                        <div class="customPreviousBtn"><img src="{{ asset('client/assets/icon/left-arrow.svg') }}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">

                            @if($comments->count() > 3)

                                <div class="client-item left-comment1 comments-item2" id="client_item_4">
                                    <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                                    <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                                    <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                                    <div id="ppbutton4"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(3)->first()->link }}">
                                    </div>

                                </div>
                            @endif

                            @if($comments->count() > 4)

                                <div class="client-item comments-item2" id="client_item_5">
                                    <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                                    <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                                    <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                                    <div id="ppbutton5"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(4)->first()->link }}">
                                    </div>

                                </div>
                            @endif
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            @if($comments->count() > 5)

                                <div class="client-item comments-item3 left-comment1" id="client_item_6">
                                    <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                                    <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                                    <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                                    <div id="ppbutton6"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(5)->first()->link }}">

                                    </div>

                                </div>
                            @endif
                            @if($comments->count() > 6)

                                <div class="client-item comments-item3 left-comment2" id="client_item_7">
                                    <img class="black-man" src="{{ asset('client/assets/icon/black-man.svg') }}">
                                    <img class="dash" src="{{ asset('client/assets/icon/bluedash.svg') }}">
                                    <img class="white-fade" src="{{ asset('client/assets/icon/fade.svg') }}">

                                    <div id="ppbutton7"  class="play-item ppbutton fa fa-play" data-src="{{ $comments->skip(6)->first()->link }}">
                                    </div>

                                </div>
                            @endif
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

@endif