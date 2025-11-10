<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.pasien.update', ['type' => $type, 'id' => $pasien->{$pasien->getKeyName()}]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama" :value="__('Nama')" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                    :value="old('nama', $pasien->nama)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                            </div>

                            <div>
                                <x-input-label for="type_pasien" :value="__('Tipe Pasien')" />
                                <select id="type_pasien" name="type_pasien"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-gray-100"
                                    disabled>
                                    <option value="mahasiswa" @selected($type == 'mahasiswa')>Mahasiswa</option>
                                    <option value="dosen" @selected($type == 'dosen')>Dosen</option>
                                    <option value="staff" @selected($type == 'staff')>Staff</option>
                                </select>
                                <input type="hidden" name="type_pasien" value="{{ $type }}">
                                <x-input-error class="mt-2" :messages="$errors->get('type_pasien')" />
                            </div>

                            <div class="prodi-field">
                                <x-input-label for="id_prodi" :value="__('Program Studi')" />
                                <select id="id_prodi" name="id_prodi"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->id_prodi }}" @selected(old('id_prodi', $pasien->id_prodi ?? '') == $p->id_prodi)>{{ $p->nama_prodi }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('id_prodi')" />
                            </div>

                            <div class="nim-field">
                                <x-input-label for="nim" :value="__('NIM')" />
                                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full"
                                    :value="old('nim', $pasien->nim ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                            </div>

                            <div class="nidn-field hidden">
                                <x-input-label for="nidn" :value="__('NIDN')" />
                                <x-text-input id="nidn" name="nidn" type="text" class="mt-1 block w-full"
                                    :value="old('nidn', $pasien->nidn ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nidn')" />
                            </div>

                            <div class="bagian-field hidden">
                                <x-input-label for="bagian" :value="__('Bagian')" />
                                <x-text-input id="bagian" name="bagian" type="text" class="mt-1 block w-full"
                                    :value="old('bagian', $pasien->bagian ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('bagian')" />
                            </div>

                            <div>
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="L" @selected(old('jenis_kelamin', $pasien->jenis_kelamin) == 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('jenis_kelamin', $pasien->jenis_kelamin) == 'P')>Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                            </div>

                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text"
                                    class="mt-1 block w-full" :value="old('tempat_lahir', $pasien->tempat_lahir)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                            </div>

                            <div>
                                <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tgl_lahir" name="tgl_lahir" type="date" class="mt-1 block w-full"
                                    :value="old('tgl_lahir', $pasien->tgl_lahir)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email', $pasien->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full"
                                    :value="old('no_telp', $pasien->no_telp)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telp')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.pasien.index', ['type' => $type]) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const typePasienSelect = document.getElementById('type_pasien');
            const nimField = document.querySelector('.nim-field');
            const nidnField = document.querySelector('.nidn-field');
            const bagianField = document.querySelector('.bagian-field');
            const prodiField = document.querySelector('.prodi-field');
            const prodiSelect = document.getElementById('id_prodi');

            function updateFormFields() {
                const selectedValue = typePasienSelect.value;

                nimField.classList.add('hidden');
                nidnField.classList.add('hidden');
                bagianField.classList.add('hidden');
                prodiField.classList.add('hidden');
                prodiSelect.disabled = true;

                if (selectedValue === 'mahasiswa') {
                    nimField.classList.remove('hidden');
                    prodiField.classList.remove('hidden');
                    prodiSelect.disabled = false;
                } else if (selectedValue === 'dosen') {
                    nidnField.classList.remove('hidden');
                } else if (selectedValue === 'staff') {
                    bagianField.classList.remove('hidden');
                }
            }

            updateFormFields();
        });
    </script>
</x-admin-layout>
