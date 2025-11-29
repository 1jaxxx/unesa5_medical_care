<x-admin-layout>
    <x-slot name="header">
        <div class="custom-header">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="font-semibold text-xl leading-tight text-blue-900">
                    {{ __('Kunjungan Saya') }}
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
                            <!-- Left side: Search and Filters -->
                            <div class="flex-1 space-y-4">
                                <form method="GET" action="{{ route('admin.visit.my_visits') }}">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Cari pasien, keluhan...">
                                    </div>
                                    @if (request('status'))
                                        <input type="hidden" name="status" value="{{ request('status') }}">
                                    @endif
                                </form>

                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Status:</span>
                                    @php
                                        $statuses = [
                                            'all' => 'Semua',
                                            'pending' => 'Pending',
                                            'inprogress' => 'In Progress',
                                            'completed' => 'Completed',
                                        ];
                                    @endphp
                                    <div class="flex flex-wrap rounded-md -space-x-px">
                                        @foreach ($statuses as $key => $label)
                                            <a href="{{ route('admin.visit.my_visits', ['status' => $key, 'search' => $search]) }}"
                                                @class([
                                                    'px-3 py-1.5 text-sm font-medium border',
                                                    'rounded-l-md' => $loop->first,
                                                    'rounded-r-md' => $loop->last,
                                                    'bg-blue-600 text-white border-blue-600 z-10' =>
                                                        request('status', 'all') === $key,
                                                    'bg-white text-gray-600 hover:bg-gray-50 border-gray-300' =>
                                                        request('status', 'all') !== $key,
                                                ])>
                                                {{ $label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        function sortIcon($field)
                        {
                            if (request('sort') !== $field) {
                                return '';
                            }
                            return request('direction', 'desc') === 'desc' ? '↓' : '↑';
                        }

                        function sortUrl($field)
                        {
                            $params = [
                                'sort' => $field,
                                'direction' =>
                                    request('sort') === $field && request('direction', 'desc') === 'desc'
                                        ? 'asc'
                                        : 'desc',
                                'search' => request('search'),
                                'status' => request('status'),
                            ];
                            return route('admin.visit.my_visits', array_filter($params));
                        }
                    @endphp

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('tgl_kunjungan') }}" class="flex items-center gap-1">
                                            Tgl Kunjungan <span
                                                class="text-gray-400">{{ sortIcon('tgl_kunjungan') }}</span>
                                        </a>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pasien</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Keluhan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <a href="{{ sortUrl('status') }}" class="flex items-center gap-1">
                                            Status <span class="text-gray-400">{{ sortIcon('status') }}</span>
                                        </a>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($visits as $visit)
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'inprogress' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                        ];
                                    @endphp

                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ \Carbon\Carbon::parse($visit->tgl_kunjungan)->isoFormat('D MMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $visit->pasien->nama }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">
                                            {{ $visit->keluhan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$visit->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($visit->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.visit.print_card', $visit->id_visit) }}"
                                                    target="_blank" class="text-gray-600 hover:text-gray-900"
                                                    title="Cetak Kartu Pasien">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5 4v3H4a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.screening.create_for_visit', $visit->id_visit) }}"
                                                    class="text-green-600 hover:text-green-900" title="Mulai Screening">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.visit.edit', $visit->id_visit) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 17v-2m3 2v-4m3 4v-6m-9 8h12a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data kunjungan yang cocok dengan pencarian atau filter
                                                    Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $visits->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
