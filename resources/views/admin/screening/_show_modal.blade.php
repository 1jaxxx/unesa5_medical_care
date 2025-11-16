<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Screening</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-2">Informasi Pasien</h3>
            <div class="space-y-2 text-sm">
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Nama:</strong> {{ $screening->pasien->nama ?? 'N/A' }}</p>
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Tipe:</strong> {{ ucfirst($screening->type_pasien ?? 'N/A') }}</p>
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Tgl Kunjungan:</strong> {{ \Carbon\Carbon::parse($screening->visit->tgl_kunjungan)->format('d M Y') }}</p>
            </div>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-2">Hasil Screening</h3>
            <div class="space-y-2 text-sm">
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Tgl Screening:</strong> {{ \Carbon\Carbon::parse($screening->tgl_screening)->format('d M Y') }}</p>
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Berat Badan:</strong> {{ $screening->berat_badan }} kg</p>
                <p><strong class="font-medium text-gray-600 w-28 inline-block">Tinggi Badan:</strong> {{ $screening->tinggi_badan }} cm</p>
                <p><strong class="font-medium text-gray-600 w-28 inline-block">IMT:</strong> <span class="font-bold">{{ $screening->imt }}</span></p>
            </div>
        </div>
    </div>

    <div class="space-y-4 text-sm">
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-2">Pemeriksaan Lanjutan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Pendengaran:</strong> {{ $screening->pendengaran }}</p>
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Penglihatan:</strong> {{ $screening->penglihatan }}</p>
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Tekanan Darah:</strong> {{ $screening->tekanan_darah }}</p>
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Status Gizi:</strong> {{ $screening->status_gizi }}</p>
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Kecacatan:</strong> {{ $screening->kecacatan }}</p>
            <p><strong class="font-medium text-gray-600 w-32 inline-block">Kebugaran:</strong> <span class="px-2 py-1 rounded-full text-xs font-medium {{ $screening->kebugaran === 'bugar' ? 'bg-green-100 text-green-800' : ($screening->kebugaran === 'cukup' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">{{ ucfirst($screening->kebugaran) }}</span></p>
        </div>
    </div>


    <div class="mt-8 flex justify-end gap-3">
        <x-secondary-button x-on:click="$dispatch('close')">
            Tutup
        </x-secondary-button>
        <a href="{{ route('admin.screening.edit', $screening->id_screening) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Edit
        </a>
    </div>
</div>
