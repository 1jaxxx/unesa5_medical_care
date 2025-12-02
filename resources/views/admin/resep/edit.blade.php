<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resep') }}
        </h2>
    </x-slot>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2-custom.css') }}" rel="stylesheet" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Edit Resep</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.resep.update', $resep->id_resep) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="id_obat" class="block font-medium text-sm text-gray-700">Obat</label>
                                <select name="id_obat" id="id_obat" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Obat</option>
                                    @foreach ($obat as $item)
                                        <option value="{{ $item->id_obat }}"
                                                data-stok="{{ $item->stok }}"
                                                {{ old('id_obat', $resep->id_obat) == $item->id_obat ? 'selected' : '' }}
                                                @if($item->stok <= 0 && $item->id_obat != $resep->id_obat) disabled @endif>
                                            {{ $item->nama_obat }}
                                            @if($item->stok > 0)
                                                (Stok: {{ $item->stok }})
                                            @else
                                                (Habis)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <div id="stok-display" class="text-sm text-gray-600 mt-1"></div>
                            </div>
                            <div>
                                <label for="id_visit" class="block font-medium text-sm text-gray-700">Visit</label>
                                <select name="id_visit" id="id_visit" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Visit</option>
                                    @foreach ($visits as $visit)
                                        <option value="{{ $visit->id_visit }}" {{ old('id_visit', $resep->id_visit) == $visit->id_visit ? 'selected' : '' }}>
                                            {{ $visit->mahasiswa->nama ?? $visit->dosen->nama ?? $visit->staff->nama }} ({{ $visit->tgl_kunjungan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="dosis" class="block font-medium text-sm text-gray-700">Dosis</label>
                                <input type="text" name="dosis" id="dosis" value="{{ old('dosis', $resep->dosis) }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="jumlah" class="block font-medium text-sm text-gray-700">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $resep->jumlah) }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="tgl_diberikan" class="block font-medium text-sm text-gray-700">Tanggal Diberikan</label>
                                <input type="date" name="tgl_diberikan" id="tgl_diberikan" value="{{ old('tgl_diberikan', $resep->tgl_diberikan) }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="catatan" class="block font-medium text-sm text-gray-700">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="3" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('catatan', $resep->catatan) }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('admin.resep.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batal
                            </a>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_obat').select2({
                placeholder: "Ketik untuk mencari obat...",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Obat tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            $('#id_visit').select2({
                placeholder: "Ketik untuk mencari visit...",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Visit tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            const obatSelect = $('#id_obat');
            const stokDisplay = $('#stok-display');

            function updateStokDisplay() {
                const selectedOption = obatSelect.find('option:selected');
                const stok = selectedOption.data('stok');

                if (stok) {
                    stokDisplay.text(`Stok yang tersedia: ${stok}`);
                } else {
                    stokDisplay.text('');
                }
            }

            // Initial display update
            updateStokDisplay();

            // Update display on change
            obatSelect.on('change', updateStokDisplay);
        });
    </script>
</x-admin-layout>
