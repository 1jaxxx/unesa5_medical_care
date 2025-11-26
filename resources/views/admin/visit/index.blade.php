<x-admin-layout>
    <x-slot name="header">
        <div class="custom-header">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="font-semibold text-xl leading-tight text-blue-900">
                    {{ __('Daftar Kunjungan') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">

                    <div class="flex flex-wrap gap-3 mb-6 justify-end">
                        <a href="{{ route('admin.visit.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 active:bg-blue-800 transition">
                            + Tambah Kunjungan
                        </a>

                        <a href="{{ route('admin.visit.export.excel') }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 active:bg-green-800 transition">
                            Export Excel
                        </a>

                        <a href="{{ route('admin.visit.export.pdf') }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition">
                            Export PDF
                        </a>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Kunjungan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pasien
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Keluhan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Diagnosis
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Dokter
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($visits as $visit)
                                    @php
                                        $statusClasses = [
                                            'pending'    => 'bg-yellow-100 text-yellow-800',
                                            'inprogress' => 'bg-blue-100 text-blue-800',
                                            'completed'  => 'bg-green-100 text-green-800',
                                        ];
                                    @endphp

                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->tgl_kunjungan }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $visit->pasien->nama }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->keluhan }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->diagnosis }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->dokter->nama ?? 'Belum ditugaskan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$visit->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($visit->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap flex gap-3">
                                            <a href="{{ route('admin.visit.edit', $visit->id_visit) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.visit.destroy', $visit->id_visit) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Hapus kunjungan ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 font-medium">
                                                    Hapus
                                                </button>
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
    </div>
</x-admin-layout>
