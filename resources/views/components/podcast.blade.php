<div
        class="service-item  {{ $podcast["need_parallex"][0] }}"
        data-initial-margin-top="{{ $podcast["need_parallex"][1] }}"
        data-speed="{{ $podcast["need_parallex"][2] }}">
    <a href="{{ $podcast->is_video ? route('single_video' , $podcast->slug) : route('single_podcast' , $podcast->slug) }}">

        <div class="imge-box">
            <img src="{{ get_image($podcast->image) }}">
            <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">
            <div class="details-item">
                @if($podcast->is_video)
                    <img src="{{ asset('client/assets/icon/video2.svg') }}">
                    ویدیو
                @else
                    <img src="{{ asset('client/assets/icon/padcast.svg') }}">
                    پادکست
                @endif
            </div>
        </div>

        <h5 class="service-title">{{ $podcast->title }}</h5>
        <p>
            {{ strip_tags($podcast->short_desc) }}
        </p>
    </a>
</div>
