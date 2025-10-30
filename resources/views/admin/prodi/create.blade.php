<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah prodi Baru') }}
        </h2>
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.prodi.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="nama_prodi" :value="__('Nama prodi')" />
                            <x-text-input id="nama_prodi" name="nama_prodi" type="text" class="mt-1 block w-full"
                                :value="old('nama_prodi')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_prodi')" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



</x-admin-layout>
