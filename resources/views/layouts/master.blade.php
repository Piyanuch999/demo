<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
    <script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
    <title>@yield('title' , 'BookShop | ร้านขายหนังสือออนไลน์')</title>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="" class="navbar-brand">
                    <strong>6206021621082 | นายกิตติศักดิ์ ปานเหลือ</strong>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse pull-right">
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::to('home')}}">หน้าแรก</a></li>
                    <li><a href="{{URL::to('books')}}">รายการหนังสือ</a></li>
                    <li><a href="{{URL::to('typebooks')}}">ประเภทหนังสือ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @if (session('msg'))
        @if (session('ok'))
            <script>toastr.success("{{session('msg')}}")</script>
        @else
            <script>toastr.error("{{session('msg')}}")</script>
        @endif
    @endif
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>    
</body>
</html>