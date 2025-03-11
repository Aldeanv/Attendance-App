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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 text-gray-900" style="background: url('/img/background.jpg') no-repeat center center; background-size: cover;">
    <div class="flex flex-col items-center justify-center min-h-screen px-6 py-12">
        <div class="bg-white shadow-lg rounded-lg p-10 text-center max-w-lg w-full">
            <h1 class="text-5xl font-extrabold text-blue-600">Selamat Datang di AbsensiApp</h1>
            <p class="mt-4 text-lg text-gray-700">Aplikasi absensi digital untuk memudahkan pencatatan kehadiran.</p>
            <div class="mt-6 flex flex-col space-y-4">
                <a href="/login" class="px-6 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition">Masuk</a>
                @if(!Auth::check())
                    <a href="/register" class="px-8 py-4 text-blue-600 border border-blue-600 rounded-xl hover:bg-blue-100 transition-transform transform hover:scale-105">Daftar</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
