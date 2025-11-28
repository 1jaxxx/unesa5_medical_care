<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Program Studi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Control Panel -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex flex-col md:flex-row justify-between gap-4">
                            <!-- Left side: Search -->
                            <div class="flex-1">
                                <form method="GET" action="{{ route('admin.prodi.index') }}">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Cari nama prodi...">
                                    </div>
                                </form>
                            </div>

                            <!-- Right side: Action Buttons -->
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-end gap-3 mt-2 md:mt-0">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.prodi.export.excel', request()->all()) }}"
                                       class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition shadow-sm">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm7 4V6h3v2H9zm-3 4V8h3v2H6zm6 0V8h3v2h-3zm-3 4v-2h3v2H9zm-3 0v-2h3v2H6z" />
                                        </svg>
                                        Export
                                    </a>
                                     <a href="{{ route('admin.prodi.export.pdf', request()->all()) }}"
                                        class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition shadow-sm">
                                         <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                           <path fill-rule="evenodd" d="M3 17a2 2 0 012-2h10a2 2 0 012 2v2H3v-2zm4-3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5zM3 6a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                                         </svg>
                                        PDF
                                     </a>
                                     <form action="{{ route('admin.prodi.import.excel') }}" method="POST" enctype="multipart/form-data" id="import-form-prodi">
                                        @csrf
                                        <input type="file" name="file" class="hidden" id="import-excel-prodi">
                                        <label for="import-excel-prodi" class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-800 active:bg-gray-800 transition shadow-sm cursor-pointer">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M.077 3.518A2 2 0 012.071 2h15.858a2 2 0 011.994 1.518L18.42 8H1.58L.077 3.518zM6.5 10a.5.5 0 00-.5.5v2a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-2a.5.5 0 00-.5-.5h-7z" clip-rule="evenodd" />
                                            </svg>
                                            Import
                                        </label>
                                    </form>
                                </div>
                                <a href="{{ route('admin.prodi.create') }}"
                                   class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition shadow-sm">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tambah Prodi
                                </a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('import-excel-prodi').addEventListener('change', function() {
                            document.getElementById('import-form-prodi').submit();
                        });
                    </script>

                    {{-- Pesan Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                         @php
                            function sortIcon($field)
                            {
                                if (request('sort') !== $field) return '';
                                return request('direction', 'desc') === 'desc' ? '↓' : '↑';
                            }

                            function sortUrl($field)
                            {
                                $params = [
                                    'sort' => $field,
                                    'direction' => request('sort') === $field && request('direction', 'desc') === 'desc' ? 'asc' : 'desc',
                                    'search' => request('search'),
                                ];
                                return route('admin.prodi.index', array_filter($params));
                            }
                        @endphp
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="w-24 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('nama_prodi') }}" class="flex items-center gap-1">
                                            Nama Program Studi <span class="text-gray-400">{{ sortIcon('nama_prodi') }}</span>
                                        </a>
                                    </th>
                                    <th class="w-1/5 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($prodi as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ ($prodi->currentPage() - 1) * $prodi->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $item->nama_prodi }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center space-x-4">
                                                <a href="{{ route('admin.prodi.edit', $item) }}"
                                                   class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.prodi.destroy', $item) }}" method="POST"
                                                    onsubmit="showDeleteConfirm(event); return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                                        <td colspan="3" class="px-6 py-12 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m-9 8h12a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data prodi yang cocok dengan pencarian Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-6">
                        {{ $prodi->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
