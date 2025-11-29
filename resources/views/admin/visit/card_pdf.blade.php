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
    <title>Resep & Resume Medis - {{ $pasienName }}</title>
    <style>
        /* Reset & Base Styles */
        @page {
            margin: 1cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            /* Font sans-serif lebih modern */
            font-size: 11pt;
            color: #333;
            line-height: 1.4;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header Section */
        .header-table {
            border-bottom: 3px double #444;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo {
            width: 70px;
            height: auto;
        }

        .clinic-info {
            text-align: center;
            vertical-align: middle;
        }

        .clinic-name {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            color: #000;
            text-transform: uppercase;
        }

        .clinic-address {
            font-size: 9pt;
            margin: 5px 0 0 0;
            color: #555;
        }

        /* Patient & Doctor Info Box */
        .info-box {
            width: 100%;
            margin-bottom: 25px;
            background-color: #f8f9fa;
            /* Background abu-abu tipis agar rapi */
            border: 1px solid #ddd;
        }

        .info-box td {
            padding: 8px 12px;
            vertical-align: top;
            width: 50%;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            font-size: 9pt;
            display: block;
            margin-bottom: 2px;
        }

        .info-value {
            font-weight: bold;
            font-size: 11pt;
            color: #000;
        }

        /* Section Titles */
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
            margin-bottom: 15px;
            padding-bottom: 5px;
            color: #2c3e50;
            text-transform: uppercase;
        }

        /* Diagnosis & Prescription */
        .content-block {
            margin-bottom: 25px;
        }

        .diagnosis-text {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .rx-container {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .rx-symbol {
            display: table-cell;
            width: 40px;
            font-family: serif;
            /* Simbol R/ tetap bagus pakai serif */
            font-size: 36pt;
            font-weight: bold;
            font-style: italic;
            vertical-align: top;
            color: #2c3e50;
        }

        .rx-list {
            display: table-cell;
            vertical-align: top;
            padding-left: 10px;
        }

        .drug-item {
            margin-bottom: 12px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 5px;
        }

        .drug-name {
            font-weight: bold;
            font-size: 11pt;
        }

        .drug-dose {
            font-style: italic;
            color: #555;
            margin-left: 5px;
        }

        .drug-note {
            display: block;
            font-size: 9pt;
            color: #777;
            margin-top: 2px;
        }

        /* Screening Table */
        .table-screening th,
        .table-screening td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            font-size: 10pt;
        }

        .table-screening th {
            background-color: #eee;
            text-align: left;
            width: 35%;
        }

        .table-screening td {
            font-weight: bold;
        }

        /* Signature */
        .signature-section {
            width: 100%;
            margin-top: 40px;
        }

        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .doctor-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td style="width: 80px;">
                    <img src="{{ $imageSrc }}" alt="Logo" class="logo">
                </td>
                <td class="clinic-info">
                    <h2 class="clinic-name">UNESA 5 MEDICAL CENTER</h2>
                    <p class="clinic-address">
                        Jl. Maospati - Barat Nomor 358-360, Kec. Maospati, Kab. Magetan, Jawa Timur 60213<br>
                        Telp: (031) 1234567 | Email: info@unesa.ac.id
                    </p>
                </td>
            </tr>
        </table>

        <table class="info-box">
            <tr>
                <td>
                    <span class="info-label">DATA PASIEN</span>
                    <div class="info-value">{{ $pasienName }}</div>
                    <div style="font-size: 10pt; margin-top: 4px;">
                        {{ $pasienIdLabel }}: {{ $pasienIdValue }} <br>
                        Tgl. Lahir:
                        {{ $pasien ? \Carbon\Carbon::parse($pasien->tgl_lahir)->isoFormat('D MMMM YYYY') : '-' }}
                    </div>
                </td>
                <td style="text-align: right; border-left: 1px solid #ddd;">
                    <span class="info-label">DOKTER PEMERIKSA</span>
                    <div class="info-value">{{ $visit->dokter ? $visit->dokter->nama : '-' }}</div>
                    <div style="font-size: 10pt; margin-top: 4px;">
                        {{ $visit->dokter ? $visit->dokter->specialization ?? 'Dokter Umum' : '-' }} <br>
                        Tgl. Kunjungan: {{ $visitDate->isoFormat('D MMMM YYYY') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="content-block">
            <div class="section-title">Instruksi Medis</div>

            @if ($visit->diagnosis)
                <div style="margin-bottom: 15px; background: #fdfdfd; padding: 10px; border-left: 4px solid #333;">
                    <span style="font-weight:bold; color: #555;">Diagnosis Utama:</span><br>
                    <span style="font-size: 12pt;">{{ $visit->diagnosis }}</span>
                </div>
            @endif

            @if ($visit->resep && $visit->resep->count() > 0)
                <div class="rx-container">
                    {{-- <div class="rx-symbol">R/</div> --}}
                    <div class="rx-list">
                        @foreach ($visit->resep as $resep)
                            <div class="drug-item">
                                <span class="drug-name">{{ $resep->obat ? $resep->obat->nama_obat : 'Obat' }}</span>
                                <span style="float:right;">Jumlah. {{ $resep->jumlah }}</span>
                                <br>
                                <span class="drug-dose">S. {{ $resep->dosis }}</span>
                                @if ($resep->catatan)
                                    <span class="drug-note">({{ $resep->catatan }})</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p style="font-style: italic; color: #777;">- Tidak ada resep obat -</p>
            @endif
        </div>

        @if ($visit->screening)
            <div class="content-block" style="page-break-inside: avoid;">
                <div class="section-title">Hasil Pemeriksaan Fisik (Screening)</div>
                <table class="table-screening">
                    <tr>
                        <th>Tanggal Screening</th>
                        <td>{{ \Carbon\Carbon::parse($visit->screening->tgl_screening)->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Tanda Vital</th>
                        <td>
                            TD: {{ $visit->screening->tekanan_darah }} mmHg &nbsp;|&nbsp;
                            BB: {{ $visit->screening->berat_badan }} kg &nbsp;|&nbsp;
                            TB: {{ $visit->screening->tinggi_badan }} cm
                        </td>
                    </tr>
                    <tr>
                        <th>Indeks Massa Tubuh (IMT)</th>
                        <td>{{ $visit->screening->imt }} ({{ $visit->screening->status_gizi }})</td>
                    </tr>
                    <tr>
                        <th>Fungsi Indera</th>
                        <td>
                            Penglihatan: {{ $visit->screening->penglihatan }} <br>
                            Pendengaran: {{ $visit->screening->pendengaran }}
                        </td>
                    </tr>
                    <tr>
                        <th>Kondisi Fisik Lain</th>
                        <td>
                            Kecacatan: {{ $visit->screening->kecacatan }} <br>
                            Kebugaran: {{ ucfirst($visit->screening->kebugaran) }}
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <div class="signature-section">
            <div class="signature-box">
                <p style="margin-bottom: 5px;">Magetan, {{ $visitDate->isoFormat('D MMMM YYYY') }}</p>
                <p style="font-size: 10pt; color: #555;">Dokter Penanggung Jawab,</p>
                <div class="signature-space">
                </div>
                <div class="doctor-name">{{ $visit->dokter ? $visit->dokter->nama : '____________________' }}</div>
                @if ($visit->dokter && $visit->dokter->sip)
                    <div style="font-size: 8pt;">SIP. {{ $visit->dokter->sip }}</div>
                @endif
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</body>

</html>
