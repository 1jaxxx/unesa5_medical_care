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
                                <dd class="text-3xl font-bold text-gray-900" id="totalPasien">{{ $totalPasien }}</dd>
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
                                <dd class="text-3xl font-bold text-gray-900" id="totalProdi">{{ $totalProdi }}</dd>
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
                                <dd class="text-3xl font-bold text-gray-900" id="kunjunganHariIni">{{ $kunjunganHariIni }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Kunjungan Per Hari -->
            <div class="mt-8 p-6 bg-white shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kunjungan Per Hari (7 Hari Terakhir)</h3>
                <canvas id="visitsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let visitsChart;

        function initChart(labels, data) {
            const ctx = document.getElementById('visitsChart').getContext('2d');
            visitsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Kunjungan',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateChart(labels, data) {
            visitsChart.data.labels = labels;
            visitsChart.data.datasets[0].data = data;
            visitsChart.update();
        }

        function updateDashboard() {
            fetch("{{ route('admin.dashboard.data') }}", {
                credentials: 'same-origin'
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalPasien').textContent = data.totalPasien;
                    document.getElementById('totalProdi').textContent = data.totalProdi;
                    document.getElementById('kunjunganHariIni').textContent = data.kunjunganHariIni;
                    const labels = Object.keys(data.visitsPerDay);
                    const values = Object.values(data.visitsPerDay);
                    if (visitsChart) {
                        updateChart(labels, values);
                    } else {
                        initChart(labels, values);
                    }
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            const initialLabels = @json(array_keys($visitsPerDay));
            const initialData = @json(array_values($visitsPerDay));
            initChart(initialLabels, initialData);

            // Update every 5 seconds
            setInterval(updateDashboard, 5000);
        });
    </script>
</x-admin-layout>
