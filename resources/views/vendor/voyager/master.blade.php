<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}"/>
    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="{{ voyager_asset('images/logo-icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/js/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/chartjs/chart.min.css') }}">
    <link href="{{ asset('assets/style/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/style/persian-datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/nprogress.css') }}"/>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css"/>
    @yield('css')

    @if(!empty(config('voyager.additional_css')))<!-- Additional CSS -->
    @foreach(config('voyager.additional_css') as $css)
        <link rel="stylesheet" type="text/css" href="{{ asset($css) }}">@endforeach
    @endif

    @yield('head')
</head>

<body class="@if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif @if(__('voyager::generic.is_rtl') != 'true'){{'en'}}@endif @if(route('voyager.dashboard') == Request::url()){{'dashboard'}}@endif">

<div id="voyager-loader">
    <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
    @if($admin_loader_img == '')
        <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Voyager Loader">
    @else
        <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
    @endif
</div>

<?php
if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
    $user_avatar = Auth::user()->avatar;
} else {
    $user_avatar = Voyager::image(Auth::user()->avatar);
}
?>

<div class="layout">
    @include('voyager::dashboard.sidebar')

    <div class="main">
        <div class="inside">
            <div class="header">
                <button type="button" class="opennotes"></button>
                <a href="" title="" class="logo">HotDesk</a>
                <button type="button" class="openmenu"></button>
                @include('voyager::dashboard.navbar')
                @yield('page_header')
            </div>
            <div class="clear"></div>
            <div class="content">
                @yield('content')
                @include('vendor.voyager.dashboard.notes')
            </div>
        </div>
        <div class="itemdrag">
            <ul></ul>
        </div>
    </div>

    <!-- Javascript Libs -->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/nprogress.js') }}"></script>
    <script src="{{ Auth::user()->locale ? asset('assets/js/main_'.Auth::user()->locale.'.js') : asset('assets/js/main_'.Config::get('app.locale').'.js') }}"></script>
    <script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('assets/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('assets/js/persian-datepicker.min.js') }}"></script>
    <script src="{{asset('assets/js/medium-editor.min.js')}}"></script>

    <script>
        @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};
        helpers.displayAlerts(alerts, toastr);
        @endif

        @if(Session::has('message'))

        // TODO: change Controllers to use AlertsMessages trait... then remove this
        var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
        var alertMessage = {!! json_encode(Session::get('message')) !!};
        var alerter = toastr[alertType];

        if (alerter) {
            alerter(alertMessage);
        } else {
            toastr.error("toastr alert-type " + alertType + " is unknown");
        }
        @endif
    </script>
    @include('voyager::media.manager')
    @yield('javascript')
    @stack('javascript')
    @if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
    @foreach(config('voyager.additional_js') as $js)
        <script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

</body>
</html>
