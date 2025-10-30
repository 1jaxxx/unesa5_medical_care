<x-admin-layout>
    <x-slot name="header">
        {{-- Menambahkan class agar konsisten dengan halaman lain --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Prodi') }}
        </h2>
    </x-slot>

    {{-- Menggunakan padding dan container standar admin --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Membungkus form di dalam card putih --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Membatasi lebar form agar tidak terlalu aneh untuk satu field --}}
                    <div class="max-w-xl">
                        {{-- Memberi judul di dalam card --}}
                        <h3 class="text-lg font-medium text-gray-900 mb-6">
                            {{ __('Formulir Edit Program Studi') }}
                        </h3>

                        <form action="{{ route('admin.prodi.update', $prodi) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                {{-- 1. Menggunakan komponen x-input-label --}}
                                <x-input-label for="nama_prodi" :value="__('Nama Prodi')" />
                                
                                {{-- 2. Menggunakan komponen x-text-input --}}
                                <x-text-input id="nama_prodi" name="nama_prodi" type="text" class="mt-1 block w-full"
                                              :value="old('nama_prodi', $prodi->nama_prodi)" required autofocus />
                                              
                                {{-- 3. Menambahkan komponen x-input-error untuk validasi --}}
                                <x-input-error class="mt-2" :messages="$errors->get('nama_prodi')" />
                            </div>

                            <div class="flex items-center gap-4">
                                {{-- 4. Menggunakan komponen x-primary-button --}}
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                {{-- 5. Menambahkan link "Batal" (UX yang baik) --}}
                                <a href="{{ route('admin.prodi.index') }}" 
                                   class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Batal') }}
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>