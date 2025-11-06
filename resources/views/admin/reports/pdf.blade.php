<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Sistem Lelang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            width: 60px;
            height: auto;
            margin-right: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th {
            background: #f2f2f2;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <div>
            <h2>Laporan Sistem Lelang</h2>
            <small>{{ date('d/m/Y H:i') }}</small>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Total Pengguna</td>
                <td>{{ $totalUsers }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Total Lelang</td>
                <td>{{ $totalAuctions }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Total Tawaran</td>
                <td>{{ $totalBids }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Total Nilai Tawaran</td>
                <td>Rp {{ number_format($totalBidAmount, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y, H:i') }}</p>
    </div>

</body>

</html>