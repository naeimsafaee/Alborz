@if ($paginator->hasPages())

    <div class="pagination">
        <div class=" refrence">
            صفحه {{ fa_number($paginator->currentPage()) }} از {{ fa_number(ceil($paginator->total() / $paginator->perPage())) }}
        </div>
    @foreach ($elements as $element)

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="Ellipse active">
                        {{ fa_number($page) }}
                    </a>
                @else
                    <a class="Ellipse" href="{{ request()->fullUrlWithQuery(['page' => $page]) }}">
                        {{ fa_number($page) }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    </div>
@endif

