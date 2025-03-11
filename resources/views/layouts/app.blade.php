<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    </head>
<body class="bg-gray-50 text-gray-900">
    <div class="flex flex-col h-screen">
        <!-- Navigation Bar -->
        {{-- @include('layouts.navigation') --}}
    
        <!-- Main Content -->

        @include('layouts.sidebar')
        
        {{ $slot }}
    </div>
</body>
</html>
