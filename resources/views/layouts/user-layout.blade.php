<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{ config('global.site_name') }}</title>

    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />


  </head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('includes.header')

        <?/*@include('includes.setting')*/?>

        <div class="app-main">
                @include('includes.sidebar')

                @yield('mainSection')
        </div>
    </div>
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script type="text/javascript" src="{{ asset('scripts/main.js') }}"></script></body>
</html>
