@php
    $imagePath = public_path('assets/icon/logo-unesa.png');
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/png;base64,' . $imageData;

    $pasien = $visit->pasien;
    $pasienName = $pasien ? $pasien->nama : 'N/A';
    $pasienIdLabel = 'ID Pasien';
    $pasienIdValue = 'N/A';
    if ($pasien) {
        switch ($visit->type_pasien) {
            case 'mahasiswa':
                $pasienIdLabel = 'NIM';
                $pasienIdValue = $pasien->nim;
                break;
            case 'dosen':
                $pasienIdLabel = 'NIDN';
                $pasienIdValue = $pasien->nidn;
                break;
            case 'staff':
                $pasienIdLabel = 'ID Staff';
                $pasienIdValue = $pasien->id_staff;
                break;
        }
    }
    $visitDate = \Carbon\Carbon::parse($visit->tgl_kunjungan);
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Resep Pasien - {{ $pasienName }}</title>
    <style>
        @page {
            margin: 0.5cm 1cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 60px;
            height: auto;
        }

        .clinic-info {
            text-align: center;
        }

        .clinic-info h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
        }

        .clinic-info p {
            font-size: 10pt;
            margin: 2px 0;
        }

        .info-header {
            width: 100%;
            margin-top: 15px;
            border-bottom: 1px solid #999;
            padding-bottom: 10px;
        }

        .info-header td {
            vertical-align: top;
            font-size: 11pt;
            padding: 1px 5px;
        }

        .main-content {
            margin-top: 20px;
            padding-left: 10px;
        }

        .diagnosis-block {
            margin-bottom: 15px;
        }

        .diagnosis-block span {
            font-weight: bold;
        }

        .rx-symbol {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 32pt;
            font-weight: bold;
            float: left;
            margin-right: 10px;
            line-height: 1;
        }

        .prescription-list {
            list-style-type: none;
            padding-left: 45px;
        }

        .prescription-list li {
            margin-bottom: 15px;
            font-size: 14pt;
        }

        .prescription-list .drug-name {
            font-weight: bold;
        }

        .prescription-list .signa {
            padding-left: 10px;
            font-style: italic;
        }

        .screening-section {
            margin-top: 25px;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
            font-size: 10pt;
        }

        .screening-section h4 {
            margin: 0 0 5px 0;
            font-size: 11pt;
            font-weight: bold;
        }

        .signature-block {
            margin-top: 50px;
            width: 300px;
            float: right;
            text-align: center;
            font-size: 12pt;
        }

        .signature-block .signature-space {
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td style="width: 70px;">
                    <img src="{{ $imageSrc }}" alt="Logo" class="logo">
                </td>
                <td class="clinic-info">
                    <h2>UNESA 5 MEDICAL CENTER</h2>
                    <p>Jl. Maospati - Barat Nomor 358-360, Kec. Maospati, Kabupaten Magetan, Jawa Timur, 60213</p>
                    <p>Telepon: (031) 1234567 | Email: info@unesa.ac.id</p>
                </td>
            </tr>
        </table>

        <table class="info-header">
            <tr>
                <td style="width: 50%;">
                    <b>Pasien:</b> {{ $pasienName }} <br>
                    <b>{{ $pasienIdLabel }}:</b> {{ $pasienIdValue }} <br>
                    <b>Tgl. Lahir:</b>
                    {{ $pasien ? \Carbon\Carbon::parse($pasien->tgl_lahir)->isoFormat('D MMM YYYY') : 'N/A' }}
                </td>
                <td style="width: 50%; text-align: right;">
                    <b>Dokter:</b> {{ $visit->dokter ? $visit->dokter->nama : 'N/A' }} <br>
                    <b>Spesialisasi:</b> {{ $visit->dokter ? $visit->dokter->specialization ?? 'Umum' : 'N/A' }} <br>
                    <b>Tanggal:</b> {{ $visitDate->isoFormat('D MMMM YYYY') }}
                </td>
            </tr>
        </table>

        <div class="main-content">
            @if ($visit->diagnosis)
                <div class="diagnosis-block">
                    <span>Diagnosis:</span> {{ $visit->diagnosis }}
                </div>
            @endif

            @if ($visit->resep && $visit->resep->count() > 0)
                <div>
                    <span class="rx-symbol">R/</span>
                    <ol class="prescription-list">
                        @foreach ($visit->resep as $resep)
                            <li>
                                <span class="drug-name">{{ $resep->obat ? $resep->obat->nama_obat : 'N/A' }} No.
                                    {{ $resep->jumlah }}</span><br>
                                <span class="signa">S. {{ $resep->dosis }}</span>
                                @if ($resep->catatan)
                                    <br><span class="signa" style="font-size: 10pt;">Catatan:
                                        {{ $resep->catatan }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            @else
                <p>Tidak ada resep obat yang diberikan.</p>
            @endif
        </div>

        <div style="clear: both;"></div>

        @if ($visit->screening)
            <div class="screening-section">
                <h4>Hasil Screening</h4>
                <table class="info-table">
                    <tr>
                        <td>Tanggal Screening</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($visit->screening->tgl_screening)->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Berat Badan</td>
                        <td>:</td>
                        <td>{{ $visit->screening->berat_badan }} kg</td>
                    </tr>
                    <tr>
                        <td>Tinggi Badan</td>
                        <td>:</td>
                        <td>{{ $visit->screening->tinggi_badan }} cm</td>
                    </tr>
                    <tr>
                        <td>IMT (Indeks Massa Tubuh)</td>
                        <td>:</td>
                        <td>{{ $visit->screening->imt }}</td>
                    </tr>
                    <tr>
                        <td>Status Gizi</td>
                        <td>:</td>
                        <td>{{ $visit->screening->status_gizi }}</td>
                    </tr>
                    <tr>
                        <td>Pendengaran</td>
                        <td>:</td>
                        <td>{{ $visit->screening->pendengaran }}</td>
                    </tr>
                    <tr>
                        <td>Penglihatan</td>
                        <td>:</td>
                        <td>{{ $visit->screening->penglihatan }}</td>
                    </tr>
                    <tr>
                        <td>Tekanan Darah</td>
                        <td>:</td>
                        <td>{{ $visit->screening->tekanan_darah }}</td>
                    </tr>
                    <tr>
                        <td>Kecacatan</td>
                        <td>:</td>
                        <td>{{ $visit->screening->kecacatan }}</td>
                    </tr>
                    <tr>
                        <td>Kebugaran</td>
                        <td>:</td>
                        <td>{{ ucfirst($visit->screening->kebugaran) }}</td>
                    </tr>
                </table>
            </div>
        @endif

        <div class="signature-block">
            Surabaya, {{ $visitDate->isoFormat('D MMMM YYYY') }}<br>
            Dokter yang memeriksa,
            <div class="signature-space"></div>
            <u>{{ $visit->dokter ? $visit->dokter->nama : '____________________' }}</u>
        </div>
    </div>
</body>

</html>
