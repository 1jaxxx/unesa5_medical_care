<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pasien Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.pasien.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama" :value="__('Nama')" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                    :value="old('nama')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                            </div>

                            <div>
                                <x-input-label for="type_pasien" :value="__('Tipe Pasien')" />
                                <select id="type_pasien" name="type_pasien"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="dosen">Dosen</option>
                                    <option value="staff">Staff</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type_pasien')" />
                            </div>

                            <div class="prodi-field">
                                <x-input-label for="id_prodi" :value="__('Program Studi')" />
                                <select id="id_prodi" name="id_prodi"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('id_prodi')" />
                            </div>

                            <div class="nim-field">
                                <x-input-label for="nim" :value="__('NIM')" />
                                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full"
                                    :value="old('nim')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                            </div>

                            <div class="nidn-field hidden">
                                <x-input-label for="nidn" :value="__('NIDN')" />
                                <x-text-input id="nidn" name="nidn" type="text" class="mt-1 block w-full"
                                    :value="old('nidn')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nidn')" />
                            </div>

                            <div class="bagian-field hidden">
                                <x-input-label for="bagian" :value="__('Bagian')" />
                                <x-text-input id="bagian" name="bagian" type="text" class="mt-1 block w-full"
                                    :value="old('bagian')" />
                                <x-input-error class="mt-2" :messages="$errors->get('bagian')" />
                            </div>

                            <div class="nik-field hidden">
                                <x-input-label for="nik" :value="__('NIK')" />
                                <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full"
                                    :value="old('nik')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nik')" />
                            </div>

                            <div>
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                            </div>

                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text"
                                    class="mt-1 block w-full" :value="old('tempat_lahir')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                            </div>

                            <div>
                                <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tgl_lahir" name="tgl_lahir" type="date" class="mt-1 block w-full"
                                    :value="old('tgl_lahir')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full"
                                    :value="old('no_telp')" required inputmode="numeric" pattern="[0-9]*" maxlength="13" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telp')" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type_pasien');
            const prodiField = document.querySelector('.prodi-field');
            const nimField = document.querySelector('.nim-field');
            const nidnField = document.querySelector('.nidn-field');
            const bagianField = document.querySelector('.bagian-field');
            const nikField = document.querySelector('.nik-field');

            function toggleFields() {
                const selectedType = typeSelect.value;

                prodiField.classList.toggle('hidden', selectedType !== 'mahasiswa');
                nimField.classList.toggle('hidden', selectedType !== 'mahasiswa');
                nidnField.classList.toggle('hidden', selectedType !== 'dosen');
                bagianField.classList.toggle('hidden', selectedType !== 'staff');
                nikField.classList.toggle('hidden', selectedType !== 'lainnya');
            }

            toggleFields();
            typeSelect.addEventListener('change', toggleFields);
        });
    </script>
</x-admin-layout>
