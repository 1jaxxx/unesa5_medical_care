<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
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
                                <form method="GET" action="{{ route('admin.users.index') }}">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>
                                        <input type="search" name="search" id="search" value="{{ $search ?? '' }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Cari nama atau email...">
                                    </div>
                                    @if(request('role'))
                                        <input type="hidden" name="role" value="{{ request('role') }}">
                                    @endif
                                </form>

                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Role:</span>
                                    @php
                                        $roles = ['all' => 'Semua', 'admin' => 'Admin', 'dokter' => 'Dokter', 'petugas' => 'Petugas'];
                                    @endphp
                                    <div class="flex flex-wrap rounded-md -space-x-px">
                                        @foreach($roles as $key => $label)
                                        <a href="{{ route('admin.users.index', ['role' => $key, 'search' => $search]) }}" @class([
                                            'px-3 py-1.5 text-sm font-medium border',
                                            'rounded-l-md' => $loop->first,
                                            'rounded-r-md' => $loop->last,
                                            'bg-blue-600 text-white border-blue-600 z-10' => (request('role', 'all') === $key),
                                            'bg-white text-gray-600 hover:bg-gray-50 border-gray-300' => (request('role', 'all') !== $key),
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
                                    <a href="{{ route('admin.users.export.excel', request()->all()) }}"
                                       class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition shadow-sm">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm7 4V6h3v2H9zm-3 4V8h3v2H6zm6 0V8h3v2h-3zm-3 4v-2h3v2H9zm-3 0v-2h3v2H6z" />
                                        </svg>
                                        Export
                                    </a>
                                     <a href="{{ route('admin.users.export.pdf', request()->all()) }}"
                                        class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition shadow-sm">
                                         <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                           <path fill-rule="evenodd" d="M3 17a2 2 0 012-2h10a2 2 0 012 2v2H3v-2zm4-3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5zM3 6a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V6zm4 3.5a.5.5 0 01.5-.5h5a.5.5 0 010 1h-5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                                         </svg>
                                        PDF
                                     </a>
                                </div>
                                <a href="{{ route('admin.users.create') }}" class="inline-flex w-full sm:w-auto justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition shadow-sm">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tambah Pengguna
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

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
                                'role' => request('role'),
                            ];
                            return route('admin.users.index', array_filter($params));
                        }
                    @endphp

                    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"><a href="{{ sortUrl('nama') }}" class="flex items-center gap-1">Nama <span class="text-gray-400">{{ sortIcon('nama') }}</span></a></th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"><a href="{{ sortUrl('email') }}" class="flex items-center gap-1">Email <span class="text-gray-400">{{ sortIcon('email') }}</span></a></th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"><a href="{{ sortUrl('role') }}" class="flex items-center gap-1">Role <span class="text-gray-400">{{ sortIcon('role') }}</span></a></th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Spesialisasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"><a href="{{ sortUrl('is_active') }}" class="flex items-center gap-1">Status <span class="text-gray-400">{{ sortIcon('is_active') }}</span></a></th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $user->nama }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ ucfirst($user->role) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">{{ $user->specialization ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            <span @class([
                                                'px-2 py-1 text-xs font-semibold rounded-full',
                                                'bg-green-100 text-green-800' => $user->is_active,
                                                'bg-red-100 text-red-800' => !$user->is_active,
                                            ])>
                                                {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-medium">
                                            <div class="flex justify-center items-center space-x-4">
                                                <a href="{{ route('admin.users.edit', $user->id_users) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 112.828 2.828L10.828 15H8v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id_users) }}" method="POST" onsubmit="showDeleteConfirm(event); return false;">
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
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-1.125-4.509a9.38 9.38 0 0 1-2.625-.372m-1.125 4.509a9.38 9.38 0 0 0-2.625-.372m-1.125 4.509a9.38 9.38 0 0 1-2.625.372m1.125-4.509a9.38 9.38 0 0 0-2.625.372M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 4.5a.75.75 0 0 0 .75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008a.75.75 0 0 0-.75.75v.008Z" />
                                                </svg>
                                                <h3 class="mt-2 text-lg font-medium text-gray-800">Tidak Ada Hasil</h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    Tidak ada data pengguna yang cocok dengan pencarian atau filter Anda.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $users->appends(request()->except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
