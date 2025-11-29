<!-- Hero Section -->
<section id="hero" class="bg-blue-50 relative py-16 md:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">

            <!-- Konten Kiri (Teks dan Tombol) -->
            <div class="text-center lg:text-left mb-12 lg:mb-0">
                <h1 class="hero-animate text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                    UNESA KAMPUS 5 <br class="hidden md:block"> MEDICAL CARE
                </h1>
                <p class="hero-animate text-lg md:text-xl font-light text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
                    Layanan kesehatan terpercaya untuk seluruh civitas akademika Kampus 5.
                </p>
                <div
                    class="hero-animate flex flex-col sm:flex-row justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#services"
                        class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-full text-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
                        Lihat Layanan Kami
                    </a>
                    <a href="#contact"
                        class="bg-white border border-blue-600 text-blue-600 font-semibold px-8 py-3 rounded-full text-lg hover:bg-blue-50 transition duration-300 shadow-md transform hover:scale-105">
                        Jadwalkan Temu
                    </a>
                </div>
            </div>

            <!-- Konten Kanan (Ilustrasi Dokter) -->
            <div class="flex justify-center lg:justify-end relative">
                <div class="absolute inset-0 flex items-center justify-center -z-10">
                    <div
                        class="parallax bg-blue-100 rounded-full w-[400px] h-[400px] md:w-[500px] md:h-[500px] lg:w-[600px] lg:h-[600px] opacity-70" data-speed="0.3">
                    </div>
                </div>
                {{-- Ilustrasi Dokter --}}
                <img src="assets/img/herosection.png" alt="Dokter Medical Care"
                    class="hero-image w-80 md:w-96 lg:w-[450px] relative z-10">
            </div>

        </div>

        <!-- Statistik di bawah Hero -->
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-10 mt-16 max-w-5xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8 text-center border border-gray-100" data-animate="fadeInUp">

            <div class="flex flex-col items-center" data-animate="scaleIn">
                <span class="text-blue-600 text-4xl md:text-5xl font-extrabold">5+</span>
                <span class="text-gray-600 text-lg md:text-xl mt-1">Dosen</span>
            </div>

            <div class="flex flex-col items-center" data-animate="scaleIn">
                <span class="text-blue-600 text-4xl md:text-5xl font-extrabold">2000+</span>
                <span class="text-gray-600 text-lg md:text-xl mt-1">Total Mahasiswa</span>
            </div>

            <div class="flex flex-col items-center" data-animate="scaleIn">
                <span class="text-blue-600 text-4xl md:text-5xl font-extrabold">50+</span>
                <span class="text-gray-600 text-lg md:text-xl mt-1">Staff Akademika</span>
            </div>

            <div class="flex flex-col items-center" data-animate="scaleIn">
                <span class="text-blue-600 text-4xl md:text-5xl font-extrabold">100+</span>
                <span class="text-gray-600 text-lg md:text-xl mt-1">Total Staff Kesehatan</span>
            </div>

        </div>
    </div>
</section>

