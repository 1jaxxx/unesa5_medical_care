<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('admin.visit.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Kunjungan
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Kunjungan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pasien
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Keluhan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Diagnosis
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dokter
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($visits as $visit)
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'inprogress' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                ];
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visit->tgl_kunjungan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visit->pasien->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visit->keluhan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visit->diagnosis }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visit->dokter->nama ?? 'Belum ditugaskan' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$visit->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($visit->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.visit.edit', $visit->id_visit) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.visit.destroy', $visit->id_visit) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
