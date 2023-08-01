<a href="@if($search->is_podcast)
{{ route('single_podcast' , $search->slug) }}
@elseif(isset($search->is_video) && $search->is_video)
{{ route('single_video' , $search->slug) }}
@elseif($search->name)

@else
{{ route('single_magazine' , $search->slug) }}
@endif">
    <div
            class="search-result-item">
        <h5>
            {{ $search->title }}
        </h5>
        <p>
            {{ strip_tags($search->short_desc) }}
        </p>

    </div>
</a>