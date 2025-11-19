<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.visit.update', $visit->id_visit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="pasien" class="block text-sm font-medium text-gray-700">Pasien</label>
                                <select id="pasien" name="pasien" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Pasien</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->type }}-{{ $p->id }}" @if($visit->type_pasien == $p->type && $visit->{'id_'.$p->type} == $p->id) selected @endif>{{ $p->nama }} ({{ $p->type }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="dokter_id" class="block text-sm font-medium text-gray-700">Dokter</label>
                                <select id="dokter_id" name="dokter_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Pilih Dokter</option>
                                    @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->id_users }}" @if($visit->dokter_id == $dokter->id_users) selected @endif>{{ $dokter->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tgl_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                                <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" value="{{ $visit->tgl_kunjungan }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
                                <textarea name="keluhan" id="keluhan" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $visit->keluhan }}</textarea>
                            </div>

                            <div>
                                <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                <textarea name="diagnosis" id="diagnosis" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $visit->diagnosis }}</textarea>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="pending" @if($visit->status == 'pending') selected @endif>Pending</option>
                                    <option value="inprogress" @if($visit->status == 'inprogress') selected @endif>In Progress</option>
                                    <option value="completed" @if($visit->status == 'completed') selected @endif>Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                            <a href="{{ route('admin.visit.index') }}" class="ml-4 text-gray-500 hover:text-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
