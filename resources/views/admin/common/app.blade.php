<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MintM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Header Block -->
        @section('header')
        @show 
        <!-- ./Header Block -->

        <!-- Sidebar Block -->
        @section('sidebar')
        @show        
        <!-- ./Sidebar Block -->

        <main class="content-wrapper">
            @yield('content')
        </main>

        <!-- Footer Block -->
        @section('footer')
        @show        
        <!-- ./Footer Block -->
    </div>
</body>
</html>
