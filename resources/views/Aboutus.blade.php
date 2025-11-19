@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#4EB9FA] to-[#2E9CD9] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-lg opacity-90">Mengenal lebih jauh tentang Unesa 5 Medical Care</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section 1: About the System -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Apa itu Unesa 5 Medical Care?</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-4">
                Unesa 5 Medical Care adalah sistem informasi kesehatan terpadu yang dirancang khusus untuk memberikan layanan kesehatan berkualitas bagi mahasiswa, dosen, dan staf di lingkungan Universitas Negeri Surabaya (Unesa).
            </p>
            <p class="text-gray-600 text-lg leading-relaxed">
                Sistem ini menyediakan fasilitas pemeriksaan kesehatan, manajemen data pasien, rekam medis digital, serta sistem resep obat yang terintegrasi untuk memastikan pelayanan kesehatan yang efisien dan profesional.
            </p>
        </div>

        <!-- Section 2: Mission and Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <!-- Vision -->
            <div class="bg-white p-8 rounded-lg shadow-md border-l-4 border-[#4EB9FA]">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi</h3>
                <p class="text-gray-600 text-base leading-relaxed">
                    Menjadi sistem informasi kesehatan terpercaya yang memberikan layanan kesehatan berkualitas tinggi dan mudah diakses bagi seluruh civitas akademika Unesa.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white p-8 rounded-lg shadow-md border-l-4 border-[#2E9CD9]">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi</h3>
                <ul class="text-gray-600 text-base space-y-2">
                    <li class="flex items-start gap-3">
                        <span class="text-[#4EB9FA] font-bold mt-1">•</span>
                        <span>Menyediakan layanan pemeriksaan kesehatan yang komprehensif</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[#4EB9FA] font-bold mt-1">•</span>
                        <span>Meningkatkan akses terhadap informasi kesehatan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-[#4EB9FA] font-bold mt-1">•</span>
                        <span>Mengelola data pasien dengan aman dan profesional</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Section 3: Features -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Pemeriksaan Kesehatan</h4>
                    <p class="text-gray-600">Pendaftaran dan pemeriksaan kesehatan online dengan mudah dan cepat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Rekam Medis Digital</h4>
                    <p class="text-gray-600">Simpan dan akses riwayat kesehatan Anda secara digital dan aman.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.452a6 6 0 00-3.86.454l-.612.054a6 6 0 00-2.4 10.696"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Manajemen Resep</h4>
                    <p class="text-gray-600">Dapatkan resep obat dan lacak pesanan dengan mudah.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Laporan Kesehatan</h4>
                    <p class="text-gray-600">Analisis dan laporan kesehatan untuk monitoring secara berkala.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Konsultasi Online</h4>
                    <p class="text-gray-600">Konsultasi dengan tenaga medis profesional secara online.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-[#4EB9FA] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Jadwal Terjadwal</h4>
                    <p class="text-gray-600">Atur jadwal pemeriksaan kesehatan sesuai dengan kenyamanan Anda.</p>
                </div>
            </div>
        </div>

        <!-- Section 4: Team -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Tim Kami</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-8">
                Unesa 5 Medical Care dikembangkan oleh tim profesional yang berdedikasi untuk memberikan solusi kesehatan terbaik bagi komunitas Unesa.
            </p>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h4 class="text-xl font-bold text-gray-800 mb-4">Kelompok 1 - Unesa 5 Medical Care</h4>
                <p class="text-gray-600">
                    Tim kami terdiri dari mahasiswa berpengalaman dari berbagai program studi yang bersemangat untuk menciptakan sistem informasi kesehatan yang inovatif dan user-friendly.
                </p>
            </div>
        </div>

        <!-- Section 5: Contact -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Hubungi Kami</h2>
            <div class="bg-gradient-to-r from-[#4EB9FA] to-[#2E9CD9] text-white p-8 rounded-lg">
                <p class="text-lg mb-4">
                    Memiliki pertanyaan atau saran untuk kami? Kami siap membantu!
                </p>
                <div class="space-y-3">
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Email: info@unesa5medicalcare.com</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>Telepon: (031) XXX-XXXX</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Lokasi: Universitas Negeri Surabaya</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
