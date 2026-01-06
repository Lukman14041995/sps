<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SPS Corporate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SPS Corporate - Indonesian holding company with diversified business portfolio">

    {{-- PAKAI app.css --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo/sps_logo.png') }}" type="image/x-icon">
</head>

<body class="flex flex-col min-h-screen antialiased">

    @include('components.header')

    <!-- Main content -->
    <main class="flex-grow pt-20"> {{-- pt-20 untuk offset header fixed --}}
        @yield('content')
    </main>

    <!-- Footer sticky -->
    @include('components.footer')

</body>

</html>