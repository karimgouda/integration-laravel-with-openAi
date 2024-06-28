<!doctype html>
<html lang="en">
<head>
    @include('layouts.head')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<body>
@include('layouts.nav')
@yield('content')
@include('layouts.footerJs')
</body>
</html>
