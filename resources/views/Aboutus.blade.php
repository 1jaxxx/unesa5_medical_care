@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#4EB9FA] to-[#2E9CD9] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Tentang Kami</h1>
                    <p class="text-lg opacity-90">Mengenal lebih jauh tentang Unesa 5 Medical Care</p>
                </div>
            </div>
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
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Welcome our talented team</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">
                We are thrilled to introduce the newest members of our team. Each individual brings a wealth of experience, creativity, and passion to our organization.
            </p>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group text-center">
                    <div class="p-6">
                        <a href="https://github.com/julia-roberts" target="_blank" rel="noopener noreferrer" class="block mb-4">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-green-300 to-green-200 rounded-full flex items-center justify-center text-6xl font-bold text-white group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="David Mitchell" class="w-full h-full object-cover rounded-full"/>
                            </div>
                        </a>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">Julia Roberts</h4>
                        <p class="text-sm text-[#4EB9FA] font-semibold mb-3">Product Manager</p>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            Visionary leader with 15+ years in tech innovation and scaling startups.
                        </p>
                        <div class="flex gap-3 justify-center">
                            <a href="https://github.com/julia-roberts" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1f2937] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://instagram.com/julia-roberts" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E1306C] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                            </a>
                            <a href="https://linkedin.com/in/julia-roberts" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#0077B5] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group text-center">
                    <div class="p-6">
                        <a href="https://github.com/mia-thompson" target="_blank" rel="noopener noreferrer" class="block mb-4">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-gray-400 to-gray-300 rounded-full flex items-center justify-center text-6xl font-bold text-white group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="David Mitchell" class="w-full h-full object-cover rounded-full"/>
                            </div>
                        </a>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">Mia Thompson</h4>
                        <p class="text-sm text-[#4EB9FA] font-semibold mb-3">Co Founder</p>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            Expert in AI/ML and distributed systems, formerly at Google and Amazon.
                        </p>
                        <div class="flex gap-3 justify-center">
                            <a href="https://github.com/mia-thompson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1f2937] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://instagram.com/mia-thompson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E1306C] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                            </a>
                            <a href="https://linkedin.com/in/mia-thompson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#0077B5] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group text-center">
                    <div class="p-6">
                        <a href="https://github.com/noah-anderson" target="_blank" rel="noopener noreferrer" class="block mb-4">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-blue-400 to-blue-300 rounded-full flex items-center justify-center text-6xl font-bold text-white group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="David Mitchell" class="w-full h-full object-cover rounded-full"/>
                            </div>
                        </a>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">Noah Anderson</h4>
                        <p class="text-sm text-[#4EB9FA] font-semibold mb-3">CTO</p>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            Expert in AI/ML and distributed systems, formerly at Google and Amazon.
                        </p>
                        <div class="flex gap-3 justify-center">
                            <a href="https://github.com/noah-anderson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1f2937] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://instagram.com/noah-anderson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E1306C] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                            </a>
                            <a href="https://linkedin.com/in/noah-anderson" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#0077B5] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group text-center">
                    <div class="p-6">
                        <a href="https://avatars.githubusercontent.com/u/201080417?v=4" target="_blank" rel="noopener noreferrer" class="block mb-4">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-purple-400 to-purple-300 rounded-full flex items-center justify-center text-6xl font-bold text-white group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <img src="https://avatars.githubusercontent.com/u/201080417?v=4" alt="Eka Verarina" class="w-full h-full object-cover rounded-full"/>
                            </div>
                        </a>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">Eka Verarina</h4>
                        <p class="text-sm text-[#4EB9FA] font-semibold mb-3">Design UI/UX</p>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            We are dedicated to consistently improving our platform to meet the evolving needs of busy professionals.
                        </p>
                        <div class="flex gap-3 justify-center">
                            <a href="https://github.com/kaekka" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1f2937] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://instagram.com/samuel-turner" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E1306C] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                            </a>
                            <a href="https://linkedin.com/in/samuel-turner" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#0077B5] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group text-center">
                    <div class="p-6">
                        <a href="https://github.com/david-mitchell" target="_blank" rel="noopener noreferrer" class="block mb-4">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-orange-400 to-orange-300 rounded-full flex items-center justify-center text-6xl font-bold text-white group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="David Mitchell" class="w-full h-full object-cover rounded-full"/>
                            </div>
                        </a>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">David Mitchell</h4>
                        <p class="text-sm text-[#4EB9FA] font-semibold mb-3">Backend Developer</p>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            Award-winning designer crafting exceptional user experiences.
                        </p>
                        <div class="flex gap-3 justify-center">
                            <a href="https://github.com/david-mitchell" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1f2937] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="https://instagram.com/david-mitchell" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E1306C] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                            </a>
                            <a href="https://linkedin.com/in/david-mitchell" target="_blank" rel="noopener noreferrer" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#0077B5] rounded-lg transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
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

        <!-- Section 6: Location Map -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Lokasi Kami</h2>
            <div class="bg-white p-8 rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Map -->
                    <div class="h-96 lg:h-full min-h-96 rounded-lg overflow-hidden shadow-md">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.4596803093997!2d111.43548452346952!3d-7.587629292086326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7995f757421b77%3A0xa4053670888bc1a8!2sKampus%20UNESA%205%20Magetan!5e0!3m2!1sid!2sid!4v1234567890"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <!-- Info Card -->
                    <div class="flex flex-col justify-center">
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#4EB9FA] text-white">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Alamat</h3>
                                    <p class="text-gray-600 mt-1">Jl. Maospati - Bar. No.358-360, Kleco, Maospati, Kec. Maospati, Kabupaten Magetan, Jawa Timur 63392</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#4EB9FA] text-white">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Telepon</h3>
                                    <p class="text-gray-600 mt-1"><a href="tel:+6231-3013040" class="hover:text-[#4EB9FA] transition">(031) 3013040</a></p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#4EB9FA] text-white">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Email</h3>
                                    <p class="text-gray-600 mt-1"><a href="mailto:info@unesa5medicalcare.com" class="hover:text-[#4EB9FA] transition">info@unesa5medicalcare.com</a></p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-[#4EB9FA] text-white">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Jam Operasional</h3>
                                    <p class="text-gray-600 mt-1">Senin - Jumat: 08:00 - 16:00</p>
                                    <p class="text-gray-600">Sabtu - Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
