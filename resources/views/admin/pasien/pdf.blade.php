<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Data Pasien</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Identifier</th>
                <th>Tipe</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Prodi</th>
                <th>Email</th>
                <th>No. Telp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasien as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->identifier }}</td>
                    <td>{{ $p->type }}</td>
                    <td>{{ $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $p->tgl_lahir }}</td>
                    <td>{{ $p->tempat_lahir }}</td>
                    <td>{{ $p->type === 'mahasiswa' ? ($p->prodi ? $p->prodi->nama_prodi : '') : '' }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_telp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
