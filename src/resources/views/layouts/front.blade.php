<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite('resources/sass/styles-front.scss')
</head>
<body>

    @include('front._layout.header')
    @yield('content')
    @include('front._layout.footer')

</body>
</html>
