@csrf
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div class="sm:col-span-2">
        <x-input-label for="id_visit" :value="__('Kunjungan Pasien')" />
        <select id="id_visit" name="id_visit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            <option value="">Pilih Kunjungan</option>
            @foreach ($visits as $visit)
                <option value="{{ $visit->id_visit }}"
                    {{ (old('id_visit', $screening->id_visit ?? '') == $visit->id_visit) ? 'selected' : '' }}>
                    {{ $visit->pasien->nama ?? 'N/A' }} ({{ ucfirst($visit->type_pasien) }}) - {{ \Carbon\Carbon::parse($visit->tgl_kunjungan)->format('d M Y') }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('id_visit')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tgl_screening" :value="__('Tanggal Screening')" />
        <x-text-input id="tgl_screening" class="block mt-1 w-full" type="date" name="tgl_screening" :value="old('tgl_screening', isset($screening) ? \Carbon\Carbon::parse($screening->tgl_screening)->format('Y-m-d') : date('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('tgl_screening')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="berat_badan" :value="__('Berat Badan (kg)')" />
        <x-text-input id="berat_badan" class="block mt-1 w-full" type="number" step="0.01" name="berat_badan" :value="old('berat_badan', $screening->berat_badan ?? '')" required />
        <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tinggi_badan" :value="__('Tinggi Badan (cm)')" />
        <x-text-input id="tinggi_badan" class="block mt-1 w-full" type="number" step="0.01" name="tinggi_badan" :value="old('tinggi_badan', $screening->tinggi_badan ?? '')" required />
        <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="imt" :value="__('IMT')" />
        <x-text-input id="imt" class="block mt-1 w-full bg-gray-100" type="text" name="imt" :value="old('imt', $screening->imt ?? '')" readonly />
        <x-input-error :messages="$errors->get('imt')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="pendengaran" :value="__('Pendengaran')" />
        <x-text-input id="pendengaran" class="block mt-1 w-full" type="text" name="pendengaran" :value="old('pendengaran', $screening->pendengaran ?? '')" required />
        <x-input-error :messages="$errors->get('pendengaran')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="penglihatan" :value="__('Penglihatan')" />
        <x-text-input id="penglihatan" class="block mt-1 w-full" type="text" name="penglihatan" :value="old('penglihatan', $screening->penglihatan ?? '')" required />
        <x-input-error :messages="$errors->get('penglihatan')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tekanan_darah" :value="__('Tekanan Darah')" />
        <x-text-input id="tekanan_darah" class="block mt-1 w-full" type="text" name="tekanan_darah" :value="old('tekanan_darah', $screening->tekanan_darah ?? '')" required placeholder="cth: 120/80"/>
        <x-input-error :messages="$errors->get('tekanan_darah')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status_gizi" :value="__('Status Gizi')" />
        <x-text-input id="status_gizi" class="block mt-1 w-full" type="text" name="status_gizi" :value="old('status_gizi', $screening->status_gizi ?? '')" required />
        <x-input-error :messages="$errors->get('status_gizi')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="kecacatan" :value="__('Kecacatan')" />
        <x-text-input id="kecacatan" class="block mt-1 w-full" type="text" name="kecacatan" :value="old('kecacatan', $screening->kecacatan ?? '')" required />
        <x-input-error :messages="$errors->get('kecacatan')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="kebugaran" :value="__('Kebugaran')" />
        <select id="kebugaran" name="kebugaran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="kurang" {{ (old('kebugaran', $screening->kebugaran ?? '') == 'kurang') ? 'selected' : '' }}>Kurang</option>
            <option value="cukup" {{ (old('kebugaran', $screening->kebugaran ?? '') == 'cukup') ? 'selected' : '' }}>Cukup</option>
            <option value="bugar" {{ (old('kebugaran', $screening->kebugaran ?? '') == 'bugar') ? 'selected' : '' }}>Bugar</option>
        </select>
        <x-input-error :messages="$errors->get('kebugaran')" class="mt-2" />
    </div>
</div>

<div class="mt-6 flex justify-end">
    <a href="{{ route('admin.screening.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
        Batal
    </a>

    <x-primary-button class="ml-3">
        {{ isset($screening) ? __('Perbarui') : __('Simpan') }}
    </x-primary-button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const beratBadanInput = document.getElementById('berat_badan');
        const tinggiBadanInput = document.getElementById('tinggi_badan');
        const imtInput = document.getElementById('imt');

        function calculateImt() {
            const berat = parseFloat(beratBadanInput.value);
            const tinggi = parseFloat(tinggiBadanInput.value);

            if (berat > 0 && tinggi > 0) {
                const tinggiM = tinggi / 100;
                const imt = berat / (tinggiM * tinggiM);
                imtInput.value = imt.toFixed(2);
            } else {
                imtInput.value = '';
            }
        }

        beratBadanInput.addEventListener('input', calculateImt);
        tinggiBadanInput.addEventListener('input', calculateImt);
        
        // Initial calculation
        calculateImt();
    });
</script>
@endpush
