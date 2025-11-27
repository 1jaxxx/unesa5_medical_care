<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Screening') }}
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
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                    <form method="GET" action="{{ route('admin.screening.index') }}" class="flex-1">
                                        <label for="search" class="sr-only">Cari</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                            </div>
                                            <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Cari pasien, status gizi, dll...">
                                        </div>
                                         @if(request('type'))
                                            <input type="hidden" name="type" value="{{ request('type') }}">
                                        @endif
                                    </form>
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.screening.export.excel', request()->all()) }}"
                                           class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition shadow-sm">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                              <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm7 4V6h3v2H9zm-3 4V8h3v2H6zm6 0V8h3v2h-3zm-3 4v-2h3v2H9zm-3 0v-2h3v2H6z" />
                                            </svg>
                                            Export
                                        </a>
                                         <a href="{{ route('admin.screening.export.pdf', request()->all()) }}"
                                            class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition shadow-sm">
                                             <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                               <path fill-rule="evenodd" d="M3 17a2 2 0 012-2h10a2 2 0 012 2v2H3v-2zm4-3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5zM3 6a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                                             </svg>
                                            PDF
                                         </a>
                                    </div>
                                </div>
                                

                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Tipe Pasien:</span>
                                    @php
                                        $types = ['all' => 'Semua', 'mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'staff' => 'Staff'];
                                    @endphp
                                    <div class="flex flex-wrap rounded-md -space-x-px">
                                        @foreach($types as $key => $label)
                                        <a href="{{ route('admin.screening.index', ['type' => $key, 'search' => $search]) }}" @class([
                                            'px-3 py-1.5 text-sm font-medium border',
                                            'rounded-l-md' => $loop->first,
                                            'rounded-r-md' => $loop->last,
                                            'bg-blue-600 text-white border-blue-600 z-10' => (request('type', 'all') === $key),
                                            'bg-white text-gray-600 hover:bg-gray-50 border-gray-300' => (request('type', 'all') !== $key),
                                        ])>
                                            {{ $label }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Right side: Action Buttons (This section is now empty or removed as buttons are moved) -->
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-end gap-3 mt-2 md:mt-0">
                                <div class="flex items-center gap-3">
                                    
                                </div>
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
                                'type' => request('type'),
                            ];
                            return route('admin.screening.index', array_filter($params));
                        }
                    @endphp

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                         <a href="{{ sortUrl('tgl_screening') }}" class="flex items-center gap-1">Tgl Screening <span class="text-gray-400">{{ sortIcon('tgl_screening') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pasien</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe Pasien</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('imt') }}" class="flex items-center gap-1">IMT <span class="text-gray-400">{{ sortIcon('imt') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                         <a href="{{ sortUrl('status_gizi') }}" class="flex items-center gap-1">Status Gizi <span class="text-gray-400">{{ sortIcon('status_gizi') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                         <a href="{{ sortUrl('kebugaran') }}" class="flex items-center gap-1">Kebugaran <span class="text-gray-400">{{ sortIcon('kebugaran') }}</span></a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($screenings as $screening)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ ($screenings->currentPage() - 1) * $screenings->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($screening->tgl_screening)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $screening->pasien->nama ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <span @class([
                                                'px-2 py-1 rounded-full text-xs font-medium',
                                                'bg-blue-100 text-blue-800' => $screening->type_pasien === 'mahasiswa',
                                                'bg-green-100 text-green-800' => $screening->type_pasien === 'dosen',
                                                'bg-purple-100 text-purple-800' => $screening->type_pasien === 'staff',
                                            ])>
                                                {{ ucfirst($screening->type_pasien ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $screening->imt }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $screening->status_gizi }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($screening->kebugaran) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-3">
                                                <button type="button"
                                                    x-on:click.prevent="$dispatch('open-modal', 'show-screening'); $dispatch('load-screening', { url: '{{ route('admin.screening.show.modal', $screening->id_screening) }}' })"
                                                    class="text-blue-600 hover:text-blue-900" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                </button>
                                                <a href="{{ route('admin.screening.edit', $screening->id_screening) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.screening.destroy', $screening->id_screening) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m-9 8h12a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data screening yang cocok dengan pencarian atau filter Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $screenings->appends(request()->except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-modal name="show-screening" :show="false" focusable>
        <div x-data="{ loading: true, content: '' }"
            x-on:load-screening.window="
                loading = true;
                content = '';
                fetch($event.detail.url)
                    .then(response => response.text())
                    .then(html => {
                        content = html;
                        loading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching screening data:', error);
                        content = '<p class=\'p-6 text-red-500\'>Gagal memuat data screening.</p>';
                        loading = false;
                    });
            "
            class="relative">
            <div x-show="loading" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
            </div>
            <div x-html="content"></div>
        </div>
    </x-modal>
</x-admin-layout>
