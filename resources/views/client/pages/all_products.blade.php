
@extends('client.index')
@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div  class="row main-row2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row third-row ">

                        @if($product->total()> 0)
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h1>
                                    تازه ترین محصولات
                                </h1>

                                <div class="row main-service-row">
                                    @each('components.product_1', $product->items(), 'product')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{ $product->onEachSide(3)->links('components.page_numbers') }}

            </div>

        </div>

    </div>

@endsection