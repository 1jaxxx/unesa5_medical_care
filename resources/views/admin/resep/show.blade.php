<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Resep') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Detail Resep</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Obat</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->obat->nama_obat }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Visit ID</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->id_visit }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Dosis</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->dosis }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Jumlah</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->jumlah }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Tanggal Diberikan</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->tgl_diberikan }}</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-sm text-gray-700">Catatan</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $resep->catatan }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('admin.resep.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
