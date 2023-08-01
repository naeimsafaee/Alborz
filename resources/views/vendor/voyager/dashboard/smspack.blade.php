@php
  $smsdata = App\Models\Sms::first();
@endphp
<div class="smspack">
  <h3>{{__('hotdesk.smspack')}}</h3>
  <div class="box">
    <ul>
      <li>{{__('hotdesk.smspack_qu')}} <span>{{Auth::user()->locale == 'fa' ? fa_number($smsdata->stock) : $smsdata->stock}} {{__('hotdesk.smspack_sms')}}</span></li>
      <li>{{__('hotdesk.smspack_sends')}} <span>{{Auth::user()->locale == 'fa' ? fa_number($smsdata->sends) : $smsdata->sends}} {{__('hotdesk.smspack_sms')}}</span></li>
      <li>{{__('hotdesk.smspack_totalsends')}} <span>{{Auth::user()->locale == 'fa' ? fa_number($smsdata->totalsend) : $smsdata->totalsend}} {{__('hotdesk.smspack_sms')}}</span></li>
    </ul>
    <div class="actions">
      <button type="button" name="button" class="btn btn-blue" data-p="10000">
        <div class="loading"><div></div> <div></div> <div></div> <div></div></div>
        {{Auth::user()->locale == 'fa' ? '۱۰۰۰' : '1000'}}
      </button>
      <button type="button" name="button" class="btn btn-blue" data-p="50000">
        <div class="loading"><div></div> <div></div> <div></div> <div></div></div>
        {{Auth::user()->locale == 'fa' ? '۵۰۰۰' : '5000'}}</button>
      <input type="number" data-per="10" placeholder="{{__('hotdesk.smspack_manual')}}"/>
      <button type="button" name="button" class="btn btn-yellow pay">
        <div class="loading"><div></div> <div></div> <div></div> <div></div></div>
        <span>{{__('hotdesk.smspack_pay')}}</span></button>
    </div>
  </div>
</div>
