<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.users.update', $user->id_users) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama" :value="__('Nama')" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="__('Password (kosongkan jika tidak ingin diubah)')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                            </div>
                            <div>
                                <x-input-label for="role" :value="__('Role')" />
                                <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    <option value="dokter" @selected($user->role === 'dokter')>Dokter</option>
                                    <option value="petugas" @selected($user->role === 'petugas')>Petugas</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('role')" />
                            </div>
                            <div>
                                <x-input-label for="specialization" :value="__('Spesialisasi (jika dokter)')" />
                                <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full" :value="old('specialization', $user->specialization)" />
                                <x-input-error class="mt-2" :messages="$errors->get('specialization')" />
                            </div>
                            <div>
                                <x-input-label for="is_active" :value="__('Status')" />
                                <select id="is_active" name="is_active" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="1" @selected($user->is_active)>Aktif</option>
                                    <option value="0" @selected(!$user->is_active)>Tidak Aktif</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
