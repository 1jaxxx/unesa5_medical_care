@php
    $imagePath = public_path('assets/icon/logo-unesa.png');
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/png;base64,' . $imageData;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Program Studi</title>
    <style>
        @page {
            margin: 20px 25px;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #333;
        }
        
        footer {
            position: fixed; 
            bottom: -20px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
        }

        footer .page-number:before {
            content: "Halaman " counter(page);
        }

        .header-table {
            width: 100%;
            border-bottom: 4px solid #000;
            padding-bottom: 10px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .clinic-info {
            text-align: right;
        }

        .clinic-info h2 {
            font-size: 18px;
            margin: 0;
            font-weight: bold;
        }

        .clinic-info p {
            font-size: 11px;
            margin: 2px 0;
        }

        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-table th, .main-table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        .main-table thead th {
            background-color: #EAEAEA;
            color: #000;
            font-weight: bold;
        }

        .main-table tbody tr:nth-child(even) {
            background-color: #F9F9F9;
        }
    </style>
</head>
<body>
    <header>
        <table class="header-table">
            <tr>
                <td style="width: 100px;">
                    <img src="{{ $imageSrc }}" alt="Logo" class="logo">
                </td>
                <td class="clinic-info">
                    <h2>UNESA MEDICAL CENTER</h2>
                    <p>Jl. Kampus Unesa, Lidah Wetan, Surabaya</p>
                    <p>Telepon: (031) 1234567 | Email: medical.center@unesa.ac.id</p>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <span class="page-number"></span>
    </footer>

    <main>
        <h3 class="report-title">Laporan Data Program Studi</h3>
        
        <table class="main-table">
            <thead>
                <tr>
                    <th style="width: 10%;">No</th>
                    <th>Nama Program Studi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prodi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_prodi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align: center; padding: 20px;">Tidak ada data program studi yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
