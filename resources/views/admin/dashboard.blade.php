<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg text-blue flex items-center justify-between">
                <div class="max-w-xl">
                    <h2 class="text-2xl font-bold">Selamat Datang di Halaman Admin!</h2>
                    <p class="mt-2 text-black-100">
                        Ini adalah pusat kendali untuk mengelola semua aspek UNESA 5 MEDICAL CARE.
                    </p>

                    <div class="mt-5 inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-3 py-1 rounded-lg w-fit shadow-sm">
                        <i class="fa-regular fa-calendar text-lg"></i>
                        <span id="tanggalHariIni"></span>
                    </div>
                </div>

                <img src="https://i.pinimg.com/736x/3d/0f/5a/3d0f5ab922631b14e3cbb942102da487.jpg" alt="Welcome" class="w-36 h-36 object-cover rounded-x2">
            </div>

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

        <!-- Total Pasien -->
        <div class="p-6 bg-white shadow-sm rounded-lg border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Total Pasien</p>
                    <h3 id="totalPasien" class="text-3xl font-bold mt-1">{{ $totalPasien }}</h3>
                </div>
                <i class="fa-solid fa-users text-3xl text-blue-500"></i>
            </div>
            <canvas id="chartPasien" height="60"></canvas>
        </div>

        <!-- Total Prodi -->
        <div class="p-6 bg-white shadow-sm rounded-lg border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Total Prodi</p>
                    <h3 id="totalProdi" class="text-3xl font-bold mt-1">{{ $totalProdi }}</h3>
                </div>
                <i class="fa-solid fa-graduation-cap text-3xl text-indigo-500"></i>
            </div>
            <canvas id="chartProdi" height="60"></canvas>
        </div>

        <!-- Kunjungan -->
        <div class="p-6 bg-white shadow-sm rounded-lg border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Kunjungan Hari Ini</p>
                    <h3 id="kunjunganHariIni" class="text-3xl font-bold mt-1">{{ $kunjunganHariIni }}</h3>
                </div>
                <i class="fa-solid fa-stethoscope text-3xl text-red-500"></i>
            </div>
            <canvas id="chartKunjunganMini" height="60"></canvas>
        </div>

        <!-- Antrian -->
        <div class="p-6 bg-white shadow-sm rounded-lg border">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Antrian Saat Ini</p>
                    <h3 id="antrianPasien" class="text-3xl font-bold mt-1">{{ $antrianPasien }}</h3>
                </div>
                <i class="fa-solid fa-clock text-3xl text-yellow-500"></i>
            </div>
            <canvas id="chartAntrian" height="60"></canvas>
        </div>
    </div>

        <!-- Grafik Kunjungan Per Hari -->
                <div class="bg-white p-6 rounded-lg shadow mt-8">
                    <h3 class="text-xl font-bold mb-4">Kunjungan 7 Hari Terakhir</h3>

                    <canvas id="weeklyChart" height="80"></canvas>
                </div>
            </div>
        </div>
    
        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const visitsPerDay = {!! json_encode($visitsPerDay ?? []) !!};
            const chartMiniData = Object.values(visitsPerDay);

            function createMiniChart(id, color) {
                new Chart(document.getElementById(id).getContext("2d"), {
                    type: "line",
                    data: {
                        labels: chartMiniData.map((_, i) => i),
                        datasets: [{
                            data: chartMiniData,
                            borderColor: color,
                            borderWidth: 2,
                            fill: false,
                            tension: 0.55,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { x: { display: false }, y: { display: false } }
                    }
                });
            }

            function createWeeklyChart() {
                const labels = Object.keys(visitsPerDay);
                const data = Object.values(visitsPerDay);

                new Chart(document.getElementById("weeklyChart").getContext("2d"), {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Kunjungan",
                            data: data,
                            borderColor: "#3b82f6",
                            backgroundColor: "rgba(59, 130, 246, 0.1)",
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } }
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", function () {
                createMiniChart("chartPasien", "#3b82f6");
                createMiniChart("chartProdi", "#6366f1");
                createMiniChart("chartKunjunganMini", "#d8201dff");
                createMiniChart("chartAntrian", "#f59e0b");
                createWeeklyChart();
            });

            async function updateRealtime() {
                try {
                    let r = await fetch("/admin/dashboard/realtime");
                    let d = await r.json();

                    document.getElementById("totalPasien").textContent = d.totalPasien;
                    document.getElementById("totalProdi").textContent = d.totalProdi;
                    document.getElementById("kunjunganHariIni").textContent = d.kunjunganHariIni;
                    document.getElementById("antrianPasien").textContent = d.antrianPasien;

                    const weeklyChart = Chart.getChart("weeklyChart");
                    if (weeklyChart) {
                        weeklyChart.data.labels = Object.keys(d.visitsPerDay);
                        weeklyChart.data.datasets[0].data = Object.values(d.visitsPerDay);
                        weeklyChart.update();
                    }
                } catch (e) {
                    console.log("Realtime gagal:", e);
                }
            }

            setInterval(updateRealtime, 5000);
        </script>

        <script>
            const hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
            const bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

            function setTanggalWelcome() {
                let d = new Date();
                document.getElementById("tanggalHariIni").innerText = `${hari[d.getDay()]}, ${d.getDate()} ${bulan[d.getMonth()]} ${d.getFullYear()}`;
            }

            setTanggalWelcome();
    </script>
</x-admin-layout>
