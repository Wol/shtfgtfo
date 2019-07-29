<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full min-h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GuessrTrackr</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="https://kit.fontawesome.com/8ffeba3493.js"></script>

</head>
<body class="bg-gray-400 h-full min-h-full">

@hasSection('content')
    <div id='app' class="container mx-auto p-4 bg-white">
        @yield('content')
    </div>
@else
    <div id="app" class="h-full w-full bg-blue-200">
        @yield('fullscreencontent')
    </div>
@endif
</body>

<script src="{{ mix('/js/app.js') }}"></script>
</html>
