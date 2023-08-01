@extends('client.index')
@section('content')

    <div class="login_form-row col-lg-12 col-md-12 col-sm-12">
        <div class="container2">
            <div id="main-row" class="row main-row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br/>
                    <br/>
                    <br/>
                    <div id="vertical-tabs" class=" vertical-tabs">
                        <div class="row">
                            <div class="nav-pills-row col-lg-3 col-md-3 col-sm-4">
                                <div class="scroll nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-one-tab" data-toggle="pill"
                                       href="#v-pills-one" role="tab" aria-controls="v-pills-one" aria-selected="true">
                                        <div class="profile-row">
                                            <div class="profile-item">
                                                <div class="profile-inner-item">
                                                    <img src="{{ asset('client/assets/icon/basket2.svg') }}">

                                                </div>

                                            </div>
                                            <p>
                                                خرید های من
                                            </p>
                                        </div>
                                    </a>
                                    <a class="nav-link" id="v-pills-two-tab" data-toggle="pill" href="#v-pills-two"
                                       role="tab" aria-controls="v-pills-two" aria-selected="false">
                                        <div class="profile-row">
                                            <div class="profile-item">
                                                <div class="profile-inner-item">
                                                    <img src="{{ asset('client/assets/icon/setting.svg') }}">

                                                </div>

                                            </div>
                                            <p>
                                                اطلاعات حساب
                                            </p>
                                        </div>

                                    </a>
                                    <a class="nav-link" id="v-pills-three-tab" data-toggle="pill" href="#v-pills-three"
                                       role="tab" aria-controls="v-pills-three" aria-selected="false">
                                        <div class="profile-row">
                                            <div class="profile-item">
                                                <div class="profile-inner-item">
                                                    <img src="{{ asset('client/assets/icon/test.svg') }}">

                                                </div>

                                            </div>
                                            <p>
                                                ارزیابی و پرسش و پاسخ ها

                                            </p>
                                        </div>

                                    </a>

                                    <a class="nav-link" id="v-pills-four-tab" data-toggle="pill" href="#v-pills-four"
                                       role="tab" aria-controls="v-pills-four" aria-selected="false">
                                        <div class="profile-row">
                                            <div class="profile-item">
                                                <div class="profile-inner-item">
                                                    <img src="{{ asset('client/assets/icon/mic.svg') }}">

                                                </div>

                                            </div>
                                            <p>
                                                تست های صدا

                                            </p>
                                        </div>
                                    </a>

                                    <a class="nav-link" id="v-pills-five-tab" data-toggle="pill" href="#v-pills-five"
                                       role="tab" aria-controls="v-pills-five" aria-selected="false">
                                        <div class="profile-row">
                                            <div class="profile-item">
                                                <div class="profile-inner-item">
                                                    <img src="{{ asset('client/assets/icon/support.svg') }}">

                                                </div>

                                            </div>
                                            <p>
                                                پشتیبانی

                                            </p>
                                        </div>

                                    </a>
                                    <a class="nav-link " href="{{route('logout')}}">
                                        <div class="profile-row">
                                            <img class="log-out" src="{{asset('client/assets/icon/log-out.svg')}}">
                                        </div>

                                    </a>

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @if($client->products->count() > 0)
                                        <div class="tab-pane fade show active" id="v-pills-one" role="tabpanel"
                                             aria-labelledby="v-pills-one-tab">
                                            <h1 class="title">
                                                خرید های من
                                            </h1>
                                            <table>
                                                <thead>
                                                <th>کد</th>
                                                <th class="text-center">
                                                    نام محصول
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="text-center">
                                                    تاریخ
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>

                                                <th class="text-center">
                                                    پرداخت
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="text-center">
                                                    مبلغ
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="Score-item"></th>
                                                </thead>
                                                <tbody>

                                                @foreach($client->products as $product)
                                                    <tr>
                                                        <td class="text-center" aria-label="کد">
                                                            {{ $loop->index + 1 }}
                                                        </td>
                                                        <td class="text-center" aria-label="نام محصول">
                                                            {{ $product->name }}
                                                        </td>
                                                        <td class="date text-center"
                                                            aria-label="تاریخ">{{ $product->shamsi_date_1 }}</td>
                                                        <td class=" text-center pay" aria-label="پرداخت">آنلاین</td>
                                                        <td class=" text-center"
                                                            aria-label="مبلغ">{{ fa_number(number_format($product->price)) }}</td>
                                                        <td class=" see-details">
                                                            <a href="#" class="edit">
                                                                <img src="{{ asset('client/assets/icon/eye.svg') }}">
                                                                مشاهده
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    @else
                                        <div class="tab-pane fade show active" id="v-pills-one" role="tabpanel"
                                             aria-labelledby="v-pills-one-tab">
                                            <h1 class="title">
                                                خرید های من
                                            </h1>
                                            <div class="about-us-item">
                                                <img src="{{ asset('client/assets/icon/shop-empty.svg') }}">
                                                <p class="shop-empty">
                                                    شما هنوز خریدی انجام ندادی
                                                </p>
                                                <a href="{{ route('all_products') }}" class="see-shop">
                                                    <img src="{{ asset('client/assets/icon/basket2.svg') }}">

                                                    مشاهده فروشگاه
                                                </a>
                                            </div>

                                        </div>
                                    @endif

                                    <div class="tab-pane fade" id="v-pills-two" role="tabpanel"
                                         aria-labelledby="v-pills-two-tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
                                                <h1 class="title">
                                                    اطلاعات حساب
                                                </h1>
                                                <form method="POST" action="{{route('profile_edit')}}">
                                                    @csrf
                                                    <div class="input-row">
                                                        <label>
                                                            نام
                                                        </label>
                                                        <input type="text" placeholder="نام" name="name"
                                                               value="{{$client->name}}">
                                                    </div>
                                                    <div class="input-row">
                                                        <label>
                                                            آدرس
                                                        </label>
                                                        <input type="text" placeholder="آدرس " name="address"
                                                               value="{{$client->address}}">
                                                    </div>
                                                    <div class="input-row">
                                                        <label>
                                                            شماره موبایل تایید شده
                                                        </label>
                                                        <div class="submit-number">
                                                            {{$client->phone}}
                                                            <div class="key-item">
                                                                غیر قابل ویرایش
                                                                <img src="{{asset('client/assets/icon/key.svg')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="login online-test" type="submit">
                                                        تایید تغییرات
                                                        <img src="{{asset('client/assets/icon/tick.svg')}}">
                                                    </button>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    @if($client->exams->count() > 0)
                                        <div class="tab-pane fade" id="v-pills-three" role="tabpanel"
                                             aria-labelledby="v-pills-three-tab">
                                            <h1 class="title">
                                                ارزیابی ها
                                            </h1>
                                            <table>
                                                <thead>
                                                <th>کد</th>
                                                <th class="text-center">
                                                    نام سرویس
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="text-center">
                                                    تاریخ
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>

                                                <th class="text-center">
                                                    پرداخت
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="text-center">
                                                    مبلغ
                                                    <img src="{{ asset('client/assets/icon/table-arrow.svg') }}">
                                                </th>
                                                <th class="Score-item"></th>
                                                </thead>
                                                <tbody>


                                                @foreach($exams as $exam)
                                                    <tr>
                                                        <td class="text-center" aria-label="کد">
                                                            {{ $loop->index + 1 }}
                                                        </td>
                                                        <td class="text-center" aria-label=" نام سرویس">
                                                            {{ $exam["title"] }}
                                                        </td>
                                                        <td class="date text-center"
                                                            aria-label="تاریخ">{{ $exam["shamsi_date1"] }}</td>
                                                        <td class=" text-center pay" aria-label="پرداخت">آنلاین</td>
                                                        <td class=" text-center"
                                                            aria-label="مبلغ">{{ fa_number(number_format($exam["price"])) }}</td>
                                                        <td class=" see-details">
                                                            <a href="{{ route('show_answer' , $exam["id"]) }}"
                                                               class="edit" style="color: #fff !important;">
                                                                <img src="{{ asset('client/assets/icon/eye.svg') }}">
                                                                مشاهده
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="v-pills-three" role="tabpanel"
                                             aria-labelledby="v-pills-three-tab">
                                            <h1 class="title">
                                                ارزیابی های من
                                            </h1>
                                            <div class="about-us-item">
                                                <img src="{{ asset('client/assets/icon/shop-empty.svg') }}">
                                                <p class="shop-empty">
                                                    شما هنوز در هیچ ارزیابی شرکت نکردی
                                                </p>

                                            </div>

                                        </div>
                                    @endif

                                    @if($client->voices->count() > 0)
                                        <div class="tab-pane fade" id="v-pills-four" role="tabpanel"
                                             aria-labelledby="v-pills-four-tab">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
                                                    <h1 class="title">
                                                        تست های ارزیابی صدا
                                                    </h1>

                                                    <table>
                                                        <thead>
                                                        <th>کد</th>
                                                        <th class="text-center">
                                                            تاریخ
                                                        </th>
                                                        <th class="text-center">
                                                            وضعیت
                                                        </th>
                                                        <th class="Score-item"></th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($client->voices as $voice)
                                                            <tr>
                                                                <td class="text-center" aria-label="کد">
                                                                    {{ $loop->index + 1 }}
                                                                </td>
                                                                <td class="date text-center"
                                                                    aria-label="تاریخ">{{ $voice->prettyDate() }}</td>
                                                                <td class="text-center {{ $voice->status_class() }}"
                                                                    aria-label="وضعیت ">{{ $voice->status() }}</td>

                                                                @if($voice->response != null && $voice->response != '')
                                                                    <td class=" see-details">
                                                                        <a href="{{ route('voice_result' , $voice->id) }}"
                                                                           class="edit" style="color: #fff !important;">
                                                                            <img src="{{ asset('client/assets/icon/eye.svg') }}">
                                                                            مشاهده
                                                                        </a>
                                                                    </td>
                                                                @endif

                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="v-pills-four" role="tabpanel"
                                             aria-labelledby="v-pills-four-tab">
                                            <h1 class="title">
                                                تست های ارزیابی صدا
                                            </h1>
                                            <div class="about-us-item">
                                                <img src="{{ asset('client/assets/icon/shop-empty.svg') }}">
                                                <p class="shop-empty">
                                                    هیچ تست صدایی داده نشده است
                                                </p>

                                            </div>

                                        </div>
                                    @endif

                                    <div class="tab-pane fade" id="v-pills-five" role="tabpanel"
                                         aria-labelledby="v-pills-five-tab">
                                        <h1 class="title">
                                            درخواست پشتیبانی
                                        </h1>
                                        <div class="input-row details-row">
                                            <form method="POST" action="{{ route('support_user') }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <label>
                                                    درخواست شما
                                                </label>
                                                <textarea name="text" placeholder="متن توضیح "></textarea>
                                                @error('text')
                                                <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <div class="button-row">
                                                    <button type="submit" class="login online-test">
                                                        ارسال پاسخ
                                                        <img src="{{ asset('client/assets/icon/tick.svg') }}">
                                                    </button>

                                                    <a class="login online-test send-file">
                                                        <input name="file" style="border: none;padding: unset;"
                                                               placeholder="ارسال فایل" type="file"/>
                                                        <img src="{{ asset('client/assets/icon/send-file.svg') }}">
                                                    </a>
                                                    @error('file')
                                                    <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </form>

                                        </div>
                                        @if($support->count() > 0)
                                            <ul class="massage-row">
                                                @foreach($support as $sp)

                                                    @if($sp->is_admin)
                                                        <li class="answer-row">
                                                            <label>
                                                                پیام مشاور
                                                            </label>
                                                            <div class="answer">
                                                                {{ $sp->text }}
                                                            </div>
                                                            <div class="date-items">
                                                                {{ $sp->created_at->diffForHumans() }}
                                                            </div>
                                                           {{-- @if($sp->file)
                                                                <a class="show-items ">
                                                                    نمایش تصویر
                                                                    <img src="{{ asset('client/assets/icon/picture.svg') }}">
                                                                </a>
                                                            @endif--}}
                                                        </li>
                                                    @else
                                                        <li>
                                                            <label>
                                                                پیام شما
                                                            </label>
                                                            <div class="question">
                                                                {{ $sp->text }}
                                                            </div>
                                                            <div class="date-items">
                                                                {{ $sp->created_at->diffForHumans() }}
                                                            </div>
                                                            @if($sp->file)
                                                                <a class="show-items " href="{{ Voyager::image($sp->file) }}" target="_blank">
                                                                    نمایش تصویر
                                                                    <img src="{{ asset('client/assets/icon/picture.svg') }}">
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif

                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="tab-pane fade" id="v-pills-five" role="tabpanel"
                                                 aria-labelledby="v-pills-five-tab">
                                                <h1 class="title">
                                                    درخواست های پشتیبانی
                                                </h1>
                                                <div class="about-us-item">
                                                    <img src="{{ asset('client/assets/icon/shop-empty.svg') }}">
                                                    <p class="shop-empty">
                                                        هیچ درخواست صدایی ندارید
                                                    </p>

                                                </div>

                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

    <script src="{{asset('client/assets/js/scroll.js')}}"></script>

@endsection
