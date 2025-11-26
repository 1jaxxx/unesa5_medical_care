<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'admin') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ sidebarOpen: false, showSuccess: {{ session('success') ? 'true' : 'false' }}, showError: {{ session('error') ? 'true' : 'false' }} }" class="font-sans antialiased">
    <div class="flex bg-gray-100 min-h-screen">
        @include('admin.layouts.navigation')

        <div :class="{'md:ml-60': sidebarOpen}" class="flex-1 transition-all duration-300">
            <header class="sticky top-0 z-40 w-full bg-blue-200 text-white shadow-md">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-white focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>

                    <div class="flex-1 text-center md:text-left font-semibold text-xl">
                        {{ $header }}
                    </div>
                </div>
            </header>

            <main class="p-6 relative">

                @if (session('success'))
                    <div x-show="showSuccess"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-10"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-300 transform"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 translate-x-10"
                         class="relative rounded-lg border border-green-300 bg-green-50 p-4 shadow-lg"
                         role="alert">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-green-500">
                                <i class="fa-solid fa-check-circle fa-lg"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-green-800">Sukses</p>
                                <p class="mt-1 text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button @click="showSuccess = false"
                                        class="inline-flex rounded-md bg-green-50 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                    <span class="sr-only">Tutup</span>
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div x-show="showError"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-x-10"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-300 transform"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 translate-x-10"
                         class="relative rounded-lg border border-red-300 bg-red-50 p-4 shadow-lg"
                         role="alert">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 text-red-500">
                                <i class="fa-solid fa-circle-exclamation fa-lg"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-red-800">Error</p>
                                <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button @click="showError = false"
                                        class="inline-flex rounded-md bg-red-50 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                                    <span class="sr-only">Tutup</span>
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    @stack('scripts')
</body>
</html>