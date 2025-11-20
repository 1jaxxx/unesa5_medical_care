<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resep') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Daftar Resep</h1>
                        <div>
                            <a href="{{ route('admin.resep.export.excel') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Export to Excel
                            </a>
                            <a href="{{ route('admin.resep.export.pdf') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Export to PDF
                            </a>
                            <a href="{{ route('admin.resep.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Tambah Resep
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Obat</th>
                                <th class="py-2 px-4 border-b">Visit ID</th>
                                <th class="py-2 px-4 border-b">Dosis</th>
                                <th class="py-2 px-4 border-b">Jumlah</th>
                                <th class="py-2 px-4 border-b">Tanggal Diberikan</th>
                                <th class="py-2 px-4 border-b">Catatan</th>
                                <th class="py-2 px-4 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resep as $item)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $item->obat->nama_obat }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->id_visit }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->dosis }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->jumlah }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->tgl_diberikan }}</td>
                                    <td class="py-2 px-4 border-b">{{ $item->catatan }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('admin.resep.edit', $item->id_resep) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.resep.destroy', $item->id_resep) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $resep->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
