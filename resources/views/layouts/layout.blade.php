<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])

    @yield('extra-tags')
</head>
<body class="@yield('body-class', '')">
<div id="app">
    @include('partials.nav')
    @yield('content')
    @include('partials.footer')
</div>
@yield('extra-scripts')
@vite(['resources/js/app.js'])
</body>
</html>
