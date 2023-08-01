<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>رسید پرداخت</title>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #100E1D;
            /*color: #39CAAE;*/
            font-family: 'yekan', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            padding: 5%;
            text-align: center;
        }

    </style>

    <script src="{{url('assets/js/jquery.min.js')}}"></script>

</head>
<body>


<div class="container" style="background-color: #231D3B; padding: 5%;">
    <div
        style="width: 30%;
            height: 20%;
            margin:0 auto;
            display: inline-block;
        @if($success ?? '') background-color: #37D1B1; @else background-color: #FD447B; @endif
            border-radius: .25rem;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;">
        <p style="margin: 10px 10px; color: #301233">پرداخت  @if(!$success ?? '') نا@endifموفق</p>
    </div>
    <a href="#" style="text-decoration:none; "><h3 style="color: honeydew;">برای بازگشت به اپلیکیشن اینجا کلیک کنید</h3></a>

</div>
</body>


<script>
    $(document).ready(function(){
        window.location.href = "studio.karo.winner://{{$success}}";
    });
</script>

</html>
