<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Screening') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Data Semua Screening</h3>
                        <a href="{{ route('admin.screening.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Screening
                        </a>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tgl Screening
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama Pasien
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tipe Pasien
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        IMT
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status Gizi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Kebugaran
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($screenings as $screening)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ ($screenings->currentPage() - 1) * $screenings->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ \Carbon\Carbon::parse($screening->tgl_screening)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $screening->pasien->nama ?? 'N/A' }}
                                        </td>
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
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $screening->imt }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $screening->status_gizi }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ ucfirst($screening->kebugaran) }}
                                        </td>
                                                                                 <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                                    <div class="flex items-center gap-3">
                                                                                        <button type="button"
                                                                                            x-on:click.prevent="$dispatch('open-modal', 'show-screening'); $dispatch('load-screening', { url: '{{ route('admin.screening.show.modal', $screening->id_screening) }}' })"
                                                                                            class="text-blue-600 hover:text-blue-900" title="Detail">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                                                stroke-width="2">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                        <a href="{{ route('admin.screening.edit', $screening->id_screening) }}"
                                                                                            class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                                                stroke-width="2">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" />
                                                                                            </svg>
                                                                                        </a>
                                                                                        <form
                                                                                            action="{{ route('admin.screening.destroy', $screening->id_screening) }}"
                                                                                            method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                                                                title="Hapus">
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
                                                                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                                                                    Tidak ada data screening yang ditemukan.
                                                                                </td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                        
                                                            <div class="mt-6">
                                                                {{ $screenings->links() }}
                                                            </div>
                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <x-modal name="show-screening" :show="false" focusable>
                                                <div x-data="{ loading: true, content: '' }" x-on:load-screening.window="
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
                                                " class="relative">
                                                    <div x-show="loading" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                                                        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
                                                    </div>
                                                    <div x-html="content"></div>
                                                </div>
                                            </x-modal>
                                        </x-admin-layout>
