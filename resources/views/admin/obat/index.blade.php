<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Control Panel -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex flex-col md:flex-row justify-between gap-4">
                            <!-- Left side: Search and Filters -->
                            <div class="flex-1 space-y-4">
                                <form method="GET" action="{{ route('admin.obat.index') }}">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>
                                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Cari nama atau jenis obat...">
                                    </div>
                                    @if(request('stock_status'))
                                        <input type="hidden" name="stock_status" value="{{ request('stock_status') }}">
                                    @endif
                                </form>

                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Status Stok:</span>
                                    @php
                                        $statuses = ['all' => 'Semua', 'in_stock' => 'Tersedia', 'out_of_stock' => 'Habis'];
                                    @endphp
                                    <div class="flex flex-wrap rounded-md -space-x-px">
                                        @foreach($statuses as $key => $label)
                                        <a href="{{ route('admin.obat.index', ['stock_status' => $key, 'search' => $search]) }}" @class([
                                            'px-3 py-1.5 text-sm font-medium border',
                                            'rounded-l-md' => $loop->first,
                                            'rounded-r-md' => $loop->last,
                                            'bg-blue-600 text-white border-blue-600 z-10' => (request('stock_status', 'all') === $key),
                                            'bg-white text-gray-600 hover:bg-gray-50 border-gray-300' => (request('stock_status', 'all') !== $key),
                                        ])>
                                            {{ $label }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Right side: Action Buttons -->
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-end gap-3 mt-2 md:mt-0">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.obat.export.excel', request()->all()) }}"
                                       class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition shadow-sm">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm7 4V6h3v2H9zm-3 4V8h3v2H6zm6 0V8h3v2h-3zm-3 4v-2h3v2H9zm-3 0v-2h3v2H6z" />
                                        </svg>
                                        Export
                                    </a>
                                     <a href="{{ route('admin.obat.export.pdf', request()->all()) }}"
                                        class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition shadow-sm">
                                         <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                           <path fill-rule="evenodd" d="M3 17a2 2 0 012-2h10a2 2 0 012 2v2H3v-2zm4-3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5zM3 6a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                                         </svg>
                                        PDF
                                     </a>
                                    <form action="{{ route('admin.obat.import.excel') }}" method="POST" enctype="multipart/form-data" id="import-form-obat">
                                        @csrf
                                        <input type="file" name="file" class="hidden" id="import-excel-obat">
                                        <label for="import-excel-obat" class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-800 active:bg-gray-800 transition shadow-sm cursor-pointer">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M.077 3.518A2 2 0 012.071 2h15.858a2 2 0 011.994 1.518L18.42 8H1.58L.077 3.518zM6.5 10a.5.5 0 00-.5.5v2a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-2a.5.5 0 00-.5-.5h-7z" clip-rule="evenodd" />
                                            </svg>
                                            Import
                                        </label>
                                    </form>
                                </div>
                                <a href="{{ route('admin.obat.create') }}"
                                   class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition shadow-sm">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tambah Obat
                                </a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('import-excel-obat').addEventListener('change', function() {
                            document.getElementById('import-form-obat').submit();
                        });
                    </script>

                    @php
                        function sortIcon($field) {
                            if (request('sort') !== $field) return '';
                            return request('direction', 'asc') === 'desc' ? '↓' : '↑';
                        }

                        function sortUrl($field) {
                            $params = [
                                'sort' => $field,
                                'direction' => request('sort') === $field && request('direction', 'asc') === 'asc' ? 'desc' : 'asc',
                                'search' => request('search'),
                                'stock_status' => request('stock_status'),
                            ];
                            return route('admin.obat.index', array_filter($params));
                        }
                    @endphp

                    {{-- Table --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('nama_obat') }}" class="flex items-center gap-1">Nama Obat <span class="text-gray-400">{{ sortIcon('nama_obat') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('jenis_obat') }}" class="flex items-center gap-1">Jenis Obat <span class="text-gray-400">{{ sortIcon('jenis_obat') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('tgl_kadaluarsa') }}" class="flex items-center gap-1">Tgl Kadaluarsa <span class="text-gray-400">{{ sortIcon('tgl_kadaluarsa') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('stok') }}" class="flex items-center gap-1">Stok <span class="text-gray-400">{{ sortIcon('stok') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($obat as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150">
                                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $item->nama_obat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->jenis_obat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 {{ \Carbon\Carbon::parse($item->tgl_kadaluarsa)->isPast() ? 'text-red-600 font-medium' : '' }}">
                                            {{ \Carbon\Carbon::parse($item->tgl_kadaluarsa)->isoFormat('D MMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium {{ $item->stok == 0 ? 'text-red-600' : 'text-gray-700' }}">
                                            {{ $item->stok }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                            <div class="flex justify-center items-center gap-3">
                                                <a href="{{ route('admin.obat.edit', $item->id_obat) }}" title="Edit" class="text-yellow-600 hover:text-yellow-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z"/></svg>
                                                </a>
                                                <form action="{{ route('admin.obat.destroy', $item->id_obat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus" class="text-red-600 hover:text-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                </svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data obat yang cocok dengan pencarian atau filter Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $obat->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
