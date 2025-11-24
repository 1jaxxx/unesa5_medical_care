<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Prodi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Data Program Studi</h3>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.prodi.export.excel') }}"
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-150 ease-in-out">
                                Export to Excel
                            </a>
                            <a href="{{ route('admin.prodi.export.pdf') }}"
                               class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-150 ease-in-out">
                                Export to PDF
                            </a>
                            <form action="{{ route('admin.prodi.import.excel') }}" method="POST" enctype="multipart/form-data" id="import-form">
                                @csrf
                                <input type="file" name="file" class="hidden" id="import-excel">
                                <label for="import-excel" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-800 active:bg-gray-800 transition">
                                    Import Excel
                                </label>
                            </form>
                            <a href="{{ route('admin.prodi.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-md transition duration-150 ease-in-out">
                                + Tambah Prodi
                            </a>
                        </div>
                    </div>
<script>
    document.getElementById('import-excel').addEventListener('change', function() {
        document.getElementById('import-form').submit();
    });
</script>

                    {{-- Pesan Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="w-24 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="w-3/5 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama Program Studi
                                    </th>
                                    <th class="w-1/5 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($prodi as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-800 text-left">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item->nama_prodi }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-medium">
                                            <div class="flex justify-center items-center space-x-4">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.prodi.edit', $item) }}"
                                                   class="text-yellow-600 hover:text-yellow-800" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('admin.prodi.destroy', $item) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Belum ada data prodi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
