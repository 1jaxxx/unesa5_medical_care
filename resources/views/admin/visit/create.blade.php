<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kunjungan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- <form action="{{ route('admin.visit.store') }}" method="POST"> --}}
                    <form action="{{ route('admin.visit.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="pasien" class="block text-sm font-medium text-gray-700">Pasien</label>
                                <select id="pasien" name="pasien" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Pasien</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->type }}-{{ $p->id }}">{{ $p->nama }} ({{ $p->type }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tgl_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
                                <textarea name="keluhan" id="keluhan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>

                            <div>
                                <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                <textarea name="diagnosis" id="diagnosis" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                            <a href="{{ route('admin.visit.index') }}" class="ml-4 text-gray-500 hover:text-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
