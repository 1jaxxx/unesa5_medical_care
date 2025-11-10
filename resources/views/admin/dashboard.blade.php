<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-2xl font-bold text-gray-900">Selamat Datang di Halaman Admin!</h2>
                    <p class="mt-2 text-gray-600">Ini adalah pusat kendali untuk mengelola semua aspek UNESA 5 MEDICAL CARE.
                    </p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-users text-3xl text-blue-500"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Pasien</dt>
                                <dd class="text-3xl font-bold text-gray-900">1,234</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-graduation-cap text-3xl text-green-500"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Prodi</dt>
                                <dd class="text-3xl font-bold text-gray-900">12</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-stethoscope text-3xl text-red-500"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Kunjungan Hari Ini</dt>
                                <dd class="text-3xl font-bold text-gray-900">56</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
