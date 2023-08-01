<div class="service-row col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="service-item">
        <div class="imge-box">
            <a href="{{ route('single_magazine' , $blog->slug) }}">
                <img src="{{ get_cropped_image($blog->image) == null ? asset('client/assets/photo/sample.jpeg') : get_cropped_image($blog->image) }}">
                <img class="gradiant"
                     src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">
            </a>
        </div>

        <h5 style="padding-top: 10px" class="service-title">{{ $blog->title }}</h5>
        <p>
            {{ strip_tags($blog->short_desc) }}
        </p>

    </div>
</div>