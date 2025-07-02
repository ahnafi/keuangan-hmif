<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Keuangan HMIF UNSOED</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include("components.navbar")
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
            @yield('content')
        </div>
    </div>
</body>

</html>