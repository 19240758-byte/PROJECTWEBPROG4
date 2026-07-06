<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan - {{ $month }}</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            color: #1f2937; /* Dark Navy/Black text */
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header {
            padding: 20px;
            border-bottom: 3px solid #059669; /* Emerald Green */
            margin-bottom: 30px;
        }
        /* Penataan Logo dan Judul */
        .header-content {
            width: 100%;
        }
        .logo {
            float: left;
            width: 80px;
            height: auto;
        }
        .title-area {
            margin-left: 100px;
            text-align: right;
        }
        .header h2 {
            margin: 0;
            color: #064e3b; /* Deep Emerald */
            text-transform: uppercase;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #ffffff;
        }
        th {
            background-color: #064e3b; /* Dark Emerald/Navy vibe */
            color: #ffffff;
            text-transform: uppercase;
            font-size: 11px;
            padding: 12px 10px;
            border: 1px solid #064e3b;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            background-color: #ecfdf5 !important; /* Light Emerald */
            font-weight: bold;
            font-size: 14px;
            color: #065f46;
        }
        .total-row td {
            border-top: 2px solid #059669;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .footer-content {
            float: right;
            text-align: center;
            width: 200px;
        }
        .waktu-cetak {
            font-size: 10px;
            color: #9ca3af;
            margin-top: 10px;
        }
        .stamp {
            margin: 10px 0;
            color: #059669;
            font-weight: bold;
            opacity: 0.1;
            font-size: 40px;
            position: absolute;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="border: none; width: 100%;">
            <tr>
                <<td style="border: none; width: 15%;">
    @php
        // Sesuai folder di image_791bb9.png: public -> images -> logo.png
        $path = public_path('images/logo.png');

        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $dataImg = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataImg);
        } else {
            $base64 = null;
        }
    @endphp

    @if($base64)
        <img src="{{ $base64 }}" style="width: 80px; height: auto;">
    @else
        <!-- Ini akan muncul jika path salah, untuk bantu kamu cek -->
        <span style="color: red; font-size: 8px;">File tidak ditemukan di: {{ $path }}</span>
    @endif
</td>
                <td style="border: none; text-align: right;">
                    <h2>LAPORAN PENDAPATAN</h2>
                    <p>NGAPAK ADVENTURE - Jelajah Alam Banyumasan</p>
                    <p style="font-weight: bold; color: #059669;">Periode: {{ $month }}</p>
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Nama Pelanggan</th>
                <th width="20%">Tanggal</th>
                <th width="15%">Durasi</th>
                <th width="25%">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td><strong>{{ $row->nama_pelanggan }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    <td style="text-align: center;">{{ $row->durasi }} Jam</td>
                    <td class="text-right">Rp{{ number_format($row->biaya, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px;">Belum ada data pendapatan untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL PENDAPATAN BERSIH:</td>
                <td class="text-right">Rp{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="footer-content">
            <p>Banyumas, {{ date('d F Y') }}</p>
            <p style="margin-top: 60px;"><strong>Admin Ngapak Adventure</strong></p>
            <hr style="border: 0.5px solid #333; width: 150px;">
            <p class="waktu-cetak">Sistem Informasi Ngapak Adventure<br>Dicetak pada: {{ $waktu_cetak }}</p>
        </div>
    </div>
</body>
</html>
