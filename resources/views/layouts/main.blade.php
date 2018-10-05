<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Poker Tracker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <meta name="csrf-token" value="{{csrf_token()}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('styles')
</head>
<body>

<div class="container">
    @yield('content')
</div>

@yield('scripts')
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
