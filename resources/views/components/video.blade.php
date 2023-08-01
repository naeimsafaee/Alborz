<a href="{{ route('single_video' , $video->slug) }}">
    <div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="service-item">
            <div class="imge-box">
                <a href="{{ route('single_video' , $video->slug) }}">
                    <img src="{{ get_image($video->image) == null ? asset('client/assets/photo/sample.jpeg') : get_image($video->image) }}">
                    <img class="gradiant"
                         src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">
                </a>
            </div>

            <h5 class="service-title">{{ $video->title }}</h5>
            <p>
                {{ $video->description }}
            </p>

        </div>
    </div>
</a>