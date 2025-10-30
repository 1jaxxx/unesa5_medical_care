<!--
MODIFIKASI:
Section "Contact" diubah total dari form menjadi tampilan informasi statis
sesuai gambar:
- Latar belakang diubah menjadi 'bg-blue-50'.
- Menambahkan logo dan judul "Contact Info".
- Menggunakan grid 3 kolom untuk "Alamat", "No Telfon", dan "E-mail".
- Form kontak sebelumnya telah dihapus.
-->

<!-- Section: Contact Info -->
<section id="contact" class="bg-blue-50 py-20 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header: Logo dan Judul -->
        <div class="mb-12">
            <!-- Logo dan Nama Brand -->
            <div class="flex items-center space-x-3 mb-4">
                <!-- Icon Logo (Heart + Cross) -->
                <img src="/assets/icon/icon.png" alt="KampusCare Logo" class=" w-20" />
                <img src="/assets/icon/logo.png" alt="KampusCare Logo" class=" w-36" />
            </div>

            <!-- Judul Section -->
            <h2 class="text-4xl font-extrabold text-gray-900">
                Contact Info
            </h2>
        </div>

        <!-- Grid Informasi Kontak -->
        <div class="grid grid-cols-1 text-center md:grid-cols-3 gap-12 ">

            <!-- Kolom Alamat -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    Alamat
                </h3>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Jl. Maospati - Bar. No.358-360, Kleco, Maospati, Kec. Maospati, Kabupaten Magetan, Jawa Timur 63392
                </p>
            </div>

            <!-- Kolom No Telfon -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    No Telfon
                </h3>
                <p class="text-lg text-gray-700">
                    0802-3456-7890 (Tim A)
                </p>
                <p class="text-lg text-gray-700">
                    0802-3456-7890 (Tim B)
                </p>
            </div>

            <!-- Kolom E-mail -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    E-mail
                </h3>
                <p class="text-lg text-gray-700">
                    Fadilifois@gmail.com
                </p>
                <p class="text-lg text-gray-700">
                    Manda@gmail.com
                </p>
            </div>

        </div>
    </div>
</section>
