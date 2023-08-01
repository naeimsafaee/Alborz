@extends('voyager::master')

@section('content')
@if (session('status'))
    <div class="alert dashboardalert @if(session('success')==true) success @else error @endif">
        {{ session('status') }}
    </div>
@endif

@php
    $c = \App\Models\Appointment::query()->where('seen' , '=' , 'false')->get()->count();
    $b = \App\Models\ContactUs::query()->where('seen' , '=' , 'false')->get()->count();
@endphp

@if($c > 0 || $b > 0)
    <div class="alert dashboardalert success">
        شما تعداد {{ $c }} درخواست نوبت و {{ $b }} درخواست مشاوره دارید.
    </div>
@endif


@if (App\Models\Sms::first()->stock<=30)
    <div class="alert dashboardalert">
        {{__('hotdesk.lowsms')}}
    </div>
@endif
  <div class="dashboard">
    @if(Auth::user()->unreadsupport()->exists())
    <div class="notifications">
      <h3>{{__('hotdesk.notifications')}}</h3>
      <a href="{{route('voyager.supports.index')}}" title="" class="messages">{{Auth::user()->unreadsupport()->count()}} {{__('hotdesk.notifications_unreadmessage')}}</a>
    </div>
    @endif
    <div class="chart">
      <h3>{{__('hotdesk.chart')}}</h3>
      <div class="box">
        <ul>
          <li class="active" data-id="users" data-info="{{Auth::user()->locale=='fa' ? fa_number(App\User::count()) : App\User::count()}} {{__('hotdesk.user')}}">{{__('hotdesk.users')}}</li>
          <li data-id="orders" data-info="{{Auth::user()->locale=='fa' ? fa_number(App\Models\Transaction::where([['product_id','!=','0'],['status','=','success']])->count()) : App\Models\Transaction::where([['product_id','!=','0'],['status','=','success']])->count()}} {{__('hotdesk.sells')}}">{{__('hotdesk.sells')}}</li>
        </ul>
        <span>{{Auth::user()->locale=='fa' ? fa_number(App\User::count()) : App\User::count()}} {{__('hotdesk.user')}}</span>
        <canvas id="userchart" width="100%" height="160px"></canvas>
      </div>
    </div>
    <div class="clear"></div>
    <div class="tools">
      @include('vendor.voyager.dashboard.smspack')
      @include('vendor.voyager.dashboard.personalizemenus')
  </div>
  </div>
@stop
