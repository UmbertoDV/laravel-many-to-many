<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="d-flex">
        @include('layouts.partials.navbar')
        <main class="container p-0">
            <div class="d-flex justify-content-between align-items-start my-5">
                <h1 class="my-5">@yield('title')</h1>

                @yield('actions')

            </div>

            @if (session('message_content'))
                <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success' }}">
                    {{ session('message_content') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @yield('modals')
    
    @yield('scripts')
</body>

</html>
