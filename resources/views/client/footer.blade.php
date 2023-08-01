<div class="col-lg-12 col-md-12 col-sm-12">
    <footer>
        <div class="main-footer">
            <div class="footer-1">
                <div class="row">
                    <div class="col-lg-5 offset-lg-0 offset-md-1 col-md-5 col-sm-12 col-xs-12">

                        {{--                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">--}}
                        <div class="col-1-item">
                            <img src="{{ get_image(setting('site.logo')) }}">
                            <p class="copy-right">
                                © کلیه حقوق مادی و معنوی این سرویس برای این رسانه محفوظ است
                            </p>
                            <ul class="social-row">
                                <li>
                                    <a href="{{setting('social.facebook')}}">
                                        <img src="{{asset('client/assets/icon/facebook.svg')}}">

                                    </a>
                                </li>
                                <li>
                                    <a href="{{setting('social.youtube')}}">
                                        <img src="{{asset('client/assets/icon/youtube.svg')}}">

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('social.tweeter') }}">
                                        <img src="{{asset('client/assets/icon/twitter.svg')}}">

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('social.insta') }}">
                                        <img src="{{asset('client/assets/icon/instagram.svg')}}">

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('social.linkedin') }}">
                                        <img src="{{asset('client/assets/icon/linkdin.svg')}}">

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ setting('social.aparat') }}">
                                        <img src="{{asset('client/assets/icon/film%20(1).svg')}}">

                                    </a>
                                </li>
                            </ul>
                            <div class="phone-number">
                                <img src="{{asset('client/assets/icon/phone.svg')}}">
                                {{ fa_number(setting('footer.phone')) }}
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                        <h6>
                            دسترسی سریع

                        </h6>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4">
                                <ul class="col-2-item">
                                    {{ menu('footer_1') }}
                                </ul>

                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4">
                                <ul class="col-2-item">
                                    {{ menu('footer_2') }}


                                </ul>

                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4">
                                <ul class="col-2-item">
                                    {{ menu('footer_3') }}

                                </ul>

                            </div>

                        </div>


                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                        <h6>
                            مجوز ها

                        </h6>
                        <div class="footer-photo">

                            {{--<a referrerpolicy="origin" target="_blank"
                               href="https://trustseal.enamad.ir/?id=215509&amp;Code=4umCankRlBfxxy54SLEB"><img
                                        referrerpolicy="origin"
                                        src="https://Trustseal.eNamad.ir/logo.aspx?id=215509&amp;Code=1-1-810960-65-0-1"
                                        alt="" style="cursor:pointer" id="1-1-810960-65-0-1"></a>--}}
                            <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=215509&amp;Code=4umCankRlBfxxy54SLEB"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=215509&amp;Code=4umCankRlBfxxy54SLEB" alt="" style="cursor:pointer;height: 100%;" id="4umCankRlBfxxy54SLEB"></a>

                            {{--                            <img src="{{asset('client/assets/photo/image%203.png')}}">--}}
                            {{--<img src="{{asset('client/assets/photo/image%204.png')}}">--}}
                            <img id = 'nbqergvjoeukesgtsizpoeuk' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=238098&p=uiwkxlaomcsiobpdpfvlmcsi", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=238098&p=odrfqftiaqgwlymabsiyaqgw' />

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </footer>


</div>

<script src="{{asset('client/assets/js/shollex.js')}}"></script>
<script src="{{asset('client/assets/js/master.js')}}"></script>
<script>
    var elmnt = document.getElementById("khadamat");

    function scrollToTop() {
        elmnt.scrollIntoView({behavior: 'smooth', block: 'center'});
    }

</script>
