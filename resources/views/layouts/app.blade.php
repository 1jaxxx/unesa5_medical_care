<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul Halaman Dinamis -->
    <title>@yield('title', 'Kampus Medical Care')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/icon/icon.png') }}?v=1">

    <!-- Memuat Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Memuat Font Inter (standar Tailwind) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Memuat Navbar PUBLIK (bukan navigasi admin) -->
    @include('partials.navbar')

    <!-- Konten Halaman Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Memuat Footer -->
    @include('partials.footer')

</body>

</html>
