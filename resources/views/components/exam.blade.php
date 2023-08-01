<div class="massage-box">
    <img src="{{ asset('client/assets/icon/massage.svg') }}">
</div>
<h5>
    {{ $exam["title"] }}
    <br/>
    @if($exam["category_title"] != '-')
     {{ $exam["category_title"] == null ? " در این دسته" :  "در " . $exam["category_title"] }}
    @endif
</h5>
<a href="{{ route('exam' , $exam["slug"]) }}" class="start">
    شروع
    <span>
        <img src="{{ asset('client/assets/icon/little-arrow.svg') }}">
    </span>
</a>
