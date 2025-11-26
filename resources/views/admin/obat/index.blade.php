<x-admin-layout>
    <x-slot name="header">
        <div class="custom-header">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="font-semibold text-xl leading-tight text-blue-900">
                    {{ __('Obat') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-xl font-semibold text-gray-800">Data Obat</h1>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.obat.export.excel') }}"
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition">
                                Export Excel
                            </a>

                            <a href="{{ route('admin.obat.export.pdf') }}"
                               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition">
                                Export PDF
                            </a>

                            <form action="{{ route('admin.obat.import.excel') }}" method="POST" enctype="multipart/form-data" id="import-form">
                                @csrf
                                <input type="file" id="import-excel" name="file" class="hidden">
                                <label for="import-excel"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md cursor-pointer hover:bg-gray-700 transition">
                                    Import Excel
                                </label>
                            </form>

                            <a href="{{ route('admin.obat.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition">
                                + Tambah Obat
                            </a>
                        </div>
                    </div>

                    {{-- Auto Submit Import --}}
                    <script>
                        document.getElementById('import-excel').addEventListener('change', () => {
                            document.getElementById('import-form').submit();
                        });
                    </script>

                    {{-- Success --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded border border-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama Obat
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jenis Obat
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Kadaluarsa
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Stok
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($obat as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150">
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->nama_obat }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->jenis_obat }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->tgl_kadaluarsa }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $item->stok }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                            <div class="flex justify-center items-center gap-3">

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.obat.edit', $item->id_obat) }}"
                                                   title="Edit"
                                                   class="text-yellow-600 hover:text-yellow-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.obat.destroy', $item->id_obat) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus"
                                                            class="text-red-600 hover:text-red-800">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data obat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $obat->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
