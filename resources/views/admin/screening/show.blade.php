    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-200">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-full p-3 mr-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Screening</h2>
                    <p class="text-sm text-gray-500">Hasil pemeriksaan kesehatan lengkap</p>
                </div>
            </div>
            <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Patient Info Card -->
        <div class="mb-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-5 text-white shadow-lg">
            <div class="flex items-center mb-3">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h3 class="text-lg font-bold">Informasi Pasien</h3>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white bg-opacity-20 rounded p-3 backdrop-blur-sm">
                    <p class="text-xs text-blue-100 mb-1">Nama Pasien</p>
                    <p class="font-bold text-sm">{{ $screening->pasien->nama ?? 'N/A' }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded p-3 backdrop-blur-sm">
                    <p class="text-xs text-blue-100 mb-1">Tipe Pasien</p>
                    <p class="font-bold text-sm">{{ ucfirst($screening->type_pasien ?? 'N/A') }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded p-3 backdrop-blur-sm">
                    <p class="text-xs text-blue-100 mb-1">Tanggal Screening</p>
                    <p class="font-bold text-sm">{{ \Carbon\Carbon::parse($screening->tgl_screening)->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Vital Signs -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                Tanda Vital
            </h3>
            <div class="grid grid-cols-3 gap-4">
                <!-- Blood Pressure -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <div class="bg-red-500 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-red-700">Tekanan Darah</p>
                    </div>
                    <p class="text-xl font-bold text-red-900">{{ $screening->tekanan_darah }}</p>
                    <p class="text-xs text-red-600">mmHg</p>
                </div>

                <!-- Weight -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <div class="bg-green-500 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-green-700">Berat Badan</p>
                    </div>
                    <p class="text-xl font-bold text-green-900">{{ $screening->berat_badan }}</p>
                    <p class="text-xs text-green-600">kg</p>
                </div>

                <!-- Height -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 border-l-4 border-purple-500 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <div class="bg-purple-500 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-purple-700">Tinggi Badan</p>
                    </div>
                    <p class="text-xl font-bold text-purple-900">{{ $screening->tinggi_badan }}</p>
                    <p class="text-xs text-purple-600">cm</p>
                </div>
            </div>
        </div>

        <!-- BMI & Nutrition -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Status Gizi & IMT
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <!-- IMT -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 border-l-4 border-orange-500 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-orange-500 rounded-full p-2 mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-orange-700">IMT</p>
                            <p class="text-2xl font-bold text-orange-900">{{ $screening->imt }}</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-50 rounded p-2">
                        <div class="flex items-center">
                            <div class="flex-1 bg-orange-200 rounded-full h-2 mr-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: {{ min(($screening->imt / 40) * 100, 100) }}%"></div>
                            </div>
                            <span class="text-xs font-semibold text-orange-800">{{ number_format($screening->imt, 1) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Nutrition Status -->
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 border-l-4 border-teal-500 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-teal-500 rounded-full p-2 mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-teal-700">Status Gizi</p>
                            <p class="text-2xl font-bold text-teal-900">{{ $screening->status_gizi }}</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-50 rounded p-2">
                        <p class="text-xs text-teal-700">Berdasarkan IMT</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Physical Examination -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Pemeriksaan Fisik
            </h3>
            <div class="grid grid-cols-2 gap-3">
                <!-- Vision -->
                <div class="bg-white border-2 border-indigo-200 rounded-lg p-3">
                    <div class="flex items-center mb-2">
                        <div class="bg-indigo-100 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Penglihatan</p>
                    </div>
                    <p class="text-base font-bold text-indigo-900">{{ $screening->penglihatan }}</p>
                </div>

                <!-- Hearing -->
                <div class="bg-white border-2 border-pink-200 rounded-lg p-3">
                    <div class="flex items-center mb-2">
                        <div class="bg-pink-100 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m2.828-9.9a9 9 0 012.828 2.828"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Pendengaran</p>
                    </div>
                    <p class="text-base font-bold text-pink-900">{{ $screening->pendengaran }}</p>
                </div>

                <!-- Disability -->
                <div class="bg-white border-2 border-yellow-200 rounded-lg p-3">
                    <div class="flex items-center mb-2">
                        <div class="bg-yellow-100 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Kecacatan</p>
                    </div>
                    <p class="text-base font-bold text-yellow-900">{{ $screening->kecacatan }}</p>
                </div>

                <!-- Fitness -->
                <div class="bg-white border-2 border-cyan-200 rounded-lg p-3">
                    <div class="flex items-center mb-2">
                        <div class="bg-cyan-100 rounded-full p-2 mr-2">
                            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">Kebugaran</p>
                    </div>
                    <p class="text-base font-bold text-cyan-900">{{ ucfirst($screening->kebugaran) }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t-2 border-gray-200">
            <button x-on:click="$dispatch('close')" class="inline-flex items-center px-5 py-2.5 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Tutup
            </button>
            <a href="{{ route('admin.screening.edit', $screening->id_screening) }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-150 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Data
            </a>
        </div>
    </div>
