<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Data Screening') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informasi Pasien</h3>
                            <dl class="mt-4 space-y-2">
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Nama Pasien</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->pasien->nama ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Tipe Pasien</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ ucfirst($screening->type_pasien ?? 'N/A') }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Tanggal Visit</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($screening->visit->tgl_visit)->format('d M Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Detail Screening</h3>
                            <dl class="mt-4 space-y-2">
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Tanggal Screening</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($screening->tgl_screening)->format('d M Y') }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Berat Badan</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->berat_badan }} kg</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Tinggi Badan</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->tinggi_badan }} cm</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">IMT</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->imt }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Pendengaran</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->pendengaran }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Penglihatan</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->penglihatan }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Tekanan Darah</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->tekanan_darah }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Status Gizi</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->status_gizi }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Kecacatan</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ $screening->kecacatan }}</dd>
                                </div>
                                <div class="flex">
                                    <dt class="w-1/3 text-sm font-medium text-gray-500">Kebugaran</dt>
                                    <dd class="w-2/3 text-sm text-gray-900">{{ ucfirst($screening->kebugaran) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.screening.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Kembali
                        </a>
                        <a href="{{ route('admin.screening.edit', $screening->id_screening) }}" class="ml-3 inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
