<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Inventario - Advanced' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net"><script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <link rel="stylesheet" href="../../select2/dist/css/select2.min.css">
    <script src="../../select2/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/select2/dist/css/select2.min.css','resources/select2/dist/js/select2.min.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <livewire:layout.navigation />

        <!-- Page Content -->
        <main>
            <div class="pt-12 flex justify-center  min-h-screen">
                <div class="w-full lg:w-11/12 p-6 pt-4 bg-white">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
