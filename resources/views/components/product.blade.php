<div class="service-item {{ $product["need_parallex"][0] }}"
     data-initial-margin-top="{{ $product["need_parallex"][1] }}"
     data-speed="{{ $product["need_parallex"][1] }}">
    <a href="{{ route('shop' , $product["slug"] )}}">

        <div class="imge-box">
            <a href="{{ route('shop' , $product["slug"] )}}">
                <img class="gradiant" src="{{ asset('client/assets/icon/Rectangle%201308.svg') }}">

                <img src="{{ get_image($product["main_image"]) }}">
            </a>
        </div>
        <p class="text">
            {{--        {{ $service-> }}--}}
        </p>
        <h5 class="service-title">{{ $product["name"] }}</h5>
        <div class="title-row">
            <div>
                @if(count($product->prerequisites) == 0)

                    @if($product["price"] == 0)
                        <h5>رایگان</h5>
                    @else
                        <h5>
                            {{ fa_number(number_format($product["price"])) }}
                        </h5>
                        <p>
                            تومان
                        </p>
                    @endif

                @endif

            </div>
            <a class="service-icon">
                <img src="{{ asset('client/assets/icon/basket.svg') }}">
            </a>
        </div>
    </a>
</div>
