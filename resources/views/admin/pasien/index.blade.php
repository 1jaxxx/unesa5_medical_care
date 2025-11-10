<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle }}
            </h2>

            <div class="flex items-center gap-4">
                <div class="flex -space-x-px">
                    <a href="{{ route('admin.pasien.index', ['type' => 'mahasiswa']) }}" @class([
                        'px-4 py-2 text-sm font-medium border rounded-l-md',
                        'bg-blue-50 text-blue-600 border-blue-300' =>
                            request('type') === 'mahasiswa',
                        'bg-white text-gray-500 hover:bg-gray-50 border-gray-300' =>
                            request('type') !== 'mahasiswa',
                    ])>
                        Mahasiswa
                    </a>
                    <a href="{{ route('admin.pasien.index', ['type' => 'dosen']) }}" @class([
                        'px-4 py-2 text-sm font-medium border',
                        'bg-green-50 text-green-600 border-green-300' =>
                            request('type') === 'dosen',
                        'bg-white text-gray-500 hover:bg-gray-50 border-gray-300' =>
                            request('type') !== 'dosen',
                    ])>
                        Dosen
                    </a>
                    <a href="{{ route('admin.pasien.index', ['type' => 'staff']) }}" @class([
                        'px-4 py-2 text-sm font-medium border',
                        'bg-purple-50 text-purple-600 border-purple-300' =>
                            request('type') === 'staff',
                        'bg-white text-gray-500 hover:bg-gray-50 border-gray-300' =>
                            request('type') !== 'staff',
                    ])>
                        Staff
                    </a>
                    <a href="{{ route('admin.pasien.index', ['type' => 'all']) }}" @class([
                        'px-4 py-2 text-sm font-medium border rounded-r-md',
                        'bg-gray-100 text-gray-700 border-gray-300' =>
                            request('type', 'all') === 'all',
                        'bg-white text-gray-500 hover:bg-gray-50 border-gray-300' =>
                            request('type', 'all') !== 'all',
                    ])>
                        Semua
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">
                            @if (request('type') && request('type') != 'all')
                                Data Pasien {{ ucfirst(request('type')) }}
                            @else
                                Data Semua Pasien
                            @endif
                        </h3>
                        <a href="{{ route('admin.pasien.create', ['type' => request('type', 'mahasiswa')]) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Pasien
                        </a>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        @php
                            function sortIcon($field)
                            {
                                $icon = request('direction', 'desc') === 'desc' ? '↓' : '↑';
                                return request('sort') === $field ? $icon : '';
                            }

                            function sortUrl($field)
                            {
                                $direction =
                                    request('sort') === $field && request('direction', 'desc') === 'desc'
                                        ? 'asc'
                                        : 'desc';
                                return route('admin.pasien.index', [
                                    'type' => request('type', 'all'),
                                    'sort' => $field,
                                    'direction' => $direction,
                                ]);
                            }
                        @endphp

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                        <a href="{{ sortUrl('nama') }}" class="flex items-center">
                                            Nama {{ sortIcon('nama') }}
                                        </a>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Identitas
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                        <a href="{{ sortUrl('type') }}" class="flex items-center">
                                            Tipe Pasien {{ sortIcon('type') }}
                                        </a>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Program Studi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                        <a href="{{ sortUrl('jenis_kelamin') }}" class="flex items-center">
                                            Jenis Kelamin {{ sortIcon('jenis_kelamin') }}
                                        </a>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Lahir
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tempat Lahir
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                        <a href="{{ sortUrl('email') }}" class="flex items-center">
                                            Email {{ sortIcon('email') }}
                                        </a>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        No Telepon
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                                        <a href="{{ sortUrl('created_at') }}" class="flex items-center">
                                            Dibuat Pada {{ sortIcon('created_at') }}
                                        </a>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pasien as $p)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-700 text-left">
                                            {{ ($pasien->currentPage() - 1) * $pasien->perPage() + $loop->iteration }}
                                        </td>

                                        {{-- PERUBAHAN 1: 'whitespace-nowrap' dihapus agar nama bisa wrap --}}
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $p->nama }}
                                        </td>

                                        {{-- PERUBAHAN 1: 'whitespace-nowrap' dihapus agar identitas bisa wrap --}}
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            @if ($p->type === 'mahasiswa')
                                                <span class="font-medium text-blue-600">NIM:</span>
                                                {{ $p->identifier }}
                                            @elseif($p->type === 'dosen')
                                                <span class="font-medium text-green-600">NIDN:</span>
                                                {{ $p->identifier }}
                                            @else
                                                <span class="font-medium text-purple-600">Bagian:</span>
                                                {{ $p->identifier ?? '-' }}
                                            @endif
                                        </td>

                                        {{-- 'whitespace-nowrap' tetap ada di sini agar badge tidak pecah --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <span @class([
                                                'px-2 py-1 rounded-full text-xs font-medium',
                                                'bg-blue-100 text-blue-800' => $p->type === 'mahasiswa',
                                                'bg-green-100 text-green-800' => $p->type === 'dosen',
                                                'bg-purple-100 text-purple-800' => $p->type === 'staff',
                                            ])>
                                                {{ ucfirst($p->type ?? 'N/A') }}
                                            </span>
                                        </td>

                                        {{-- PERUBAHAN 1: 'whitespace-nowrap' dihapus agar prodi bisa wrap --}}
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $p->prodi?->nama_prodi ?? '-' }}
                                        </td>

                                        {{-- PERUBAHAN 2: Menampilkan Laki-laki / Perempuan --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ match ($p->jenis_kelamin) {
                                                'L' => 'Laki-laki',
                                                'P' => 'Perempuan',
                                                default => $p->jenis_kelamin,
                                            } }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{-- Sebaiknya format tanggalnya agar konsisten --}}
                                            {{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d M Y') }}
                                        </td>

                                        {{-- PERUBAHAN 1: 'whitespace-nowrap' dihapus agar tempat lahir bisa wrap --}}
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $p->tempat_lahir }}
                                        </td>

                                        {{-- PERUBAHAN 1: 'whitespace-nowrap' dihapus agar email bisa wrap --}}
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $p->email }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $p->no_telp }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $p->created_at->format('d M Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.pasien.show', ['type' => $p->type, 'id' => $p->id]) }}"
                                                    class="text-blue-600 hover:text-blue-900" title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                <a href="{{ route('admin.pasien.edit', ['type' => $p->type, 'id' => $p->id]) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form
                                                    action="{{ route('admin.pasien.destroy', ['type' => $p->type, 'id' => $p->id]) }}"
                                                    method="POST" onsubmit="showDeleteConfirm(event); return false;">
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
                                        {{-- PERBAIKAN 3: Colspan disesuaikan menjadi 12 --}}
                                        <td colspan="12" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data pasien yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $pasien->appends(request()->except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>


