<x-admin-layout>
    <x-slot name="header">
        <div class="custom-header">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="font-semibold text-xl leading-tight text-blue-900">
                    {{ __('Daftar Resep') }}
                </h2>
            </div>
        </div>
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
                                <form method="GET" action="{{ route('admin.resep.index') }}">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>
                                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Cari pasien, dokter, obat...">
                                    </div>
                                </form>
                            </div>
                            <!-- Right side: Action Buttons -->
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-end gap-3 mt-2 md:mt-0">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.resep.export.excel', request()->all()) }}"
                                       class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition shadow-sm">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm7 4V6h3v2H9zm-3 4V8h3v2H6zm6 0V8h3v2h-3zm-3 4v-2h3v2H9zm-3 0v-2h3v2H6z" />
                                        </svg>
                                        Export
                                    </a>
                                     <a href="{{ route('admin.resep.export.pdf', request()->all()) }}"
                                        class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition shadow-sm">
                                         <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                           <path fill-rule="evenodd" d="M3 17a2 2 0 012-2h10a2 2 0 012 2v2H3v-2zm4-3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5zM3 6a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                                         </svg>
                                        PDF
                                     </a>
                                </div>
                                <a href="{{ route('admin.resep.create') }}"
                                   class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition shadow-sm">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tambah Resep
                                </a>
                            </div>
                        </div>
                    </div>
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
                            return route('admin.resep.index', array_filter($params));
                        }
                    @endphp
                    
                    {{-- Table --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('tgl_diberikan') }}" class="flex items-center gap-1">Tgl Diberikan <span class="text-gray-400">{{ sortIcon('tgl_diberikan') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pasien</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dokter</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Obat</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dosis</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($resep as $item)
                                    <tr class="hover:bg-blue-50 transition duration-150">
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_diberikan)->isoFormat('D MMM YYYY') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $item->visit->pasien->nama ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->visit->dokter->nama ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->obat->nama_obat }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->dosis }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->jumlah }}</td>

                                        <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                            <div class="flex justify-center items-center gap-3">
                                                <a href="{{ route('admin.resep.edit', $item->id_resep) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z"/></svg>
                                                </a>
                                                <form action="{{ route('admin.resep.destroy', $item->id_resep) }}" method="POST" onsubmit="showDeleteConfirm(event); return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:text-red-900" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">
                                             <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data resep yang cocok dengan pencarian Anda.
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
                        {{ $resep->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
