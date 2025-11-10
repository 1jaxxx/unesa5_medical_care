<div class="bg-gray-50 dark:bg-gray-800">
    <div class="p-6 bg-blue-600 dark:bg-blue-800">
        <h2 class="text-2xl font-bold text-white">{{ $pasien->nama }}</h2>
        <p class="text-sm text-blue-100 dark:text-blue-200 capitalize">{{ $type }}</p>
    </div>
    <div class="p-6">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->email }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">No. Telepon</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->no_telp }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($pasien->tgl_lahir)->format('d F Y') }}</dd>
            </div>

            @switch($type)
                @case('mahasiswa')
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NIM</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->nim }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Prodi</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->prodi->nama_prodi }}</dd>
                    </div>
                    @break
                @case('dosen')
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NIDN</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->nidn }}</dd>
                    </div>
                    @break
                @case('staff')
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bagian</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->bagian }}</dd>
                    </div>
                    @break
            @endswitch
            
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->created_at->format('d F Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Diperbarui</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pasien->updated_at->format('d F Y H:i') }}</dd>
            </div>
        </dl>
    </div>
    <div class="px-6 py-4 bg-gray-100 dark:bg-gray-800 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            Tutup
        </x-secondary-button>
    </div>
</div>
