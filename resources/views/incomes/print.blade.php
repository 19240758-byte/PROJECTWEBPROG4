<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi #{{ $income->id }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.4;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .ticket {
            width: 350px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .center { text-align: center; }
        .divider {
            border-top: 1px dashed #000;
            margin: 15px 0;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            font-style: italic;
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-cetak {
            padding: 10px 20px;
            cursor: pointer;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }
        @media print {
            body { background: white; padding: 0; }
            .ticket { width: 100%; box-shadow: none; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print">
        <button onclick="window.print()" class="btn-cetak">
            Cetak Ulang Nota
        </button>
        <a href="{{ url()->previous() }}" style="margin-left: 10px; text-decoration: none; color: #666;"> Kembali</a>
    </div>

    <div class="ticket">
        <div class="center">
            <h3 style="margin: 0; color: #064e3b;">NGAPAK ADVENTURE</h3>
            <p style="margin: 5px 0;">Purwokerto, Banyumas</p>
            {{-- Menggunakan booking_date sesuai database --}}
            <p style="font-size: 11px;">{{ \Carbon\Carbon::parse($income->booking_date)->translatedFormat('d M Y') }}</p>
        </div>

        <div class="divider"></div>

        <div class="row">
            <span>ID Transaksi:</span>
            <span>#{{ $income->id }}</span>
        </div>
        <div class="row">
            <span>Customer:</span>
            {{-- Mengambil nama dari relasi user --}}
            <span>{{ $income->user->name ?? 'Pelanggan Umum' }}</span>
        </div>
        <div class="row">
            <span>Durasi:</span>
            {{-- Menggunakan duration_hours sesuai database --}}
            <span>{{ $income->duration_hours }} Jam</span>
        </div>

        <div class="divider"></div>

        <div class="row">
            <span style="font-weight: bold;">Layanan Wisata</span>
            <span></span>
        </div>
        <div class="row">
            {{-- Mengambil nama destinasi dari relasi destination --}}
            <span style="font-size: 12px;">- {{ $income->destination->name ?? 'Paket Wisata' }}</span>
            <span></span>
        </div>
        @if($income->guide_id)
        <div class="row">
            <span style="font-size: 11px; color: #666; margin-left: 10px;">Pemandu: {{ $income->guide->name ?? '-' }}</span>
        </div>
        @endif

        <div class="row total">
            <span>TOTAL BAYAR:</span>
            {{-- Menggunakan total_cost sesuai database --}}
            <span>Rp {{ number_format($income->total_cost, 0, ',', '.') }}</span>
        </div>

        <div class="divider"></div>

        <div class="row">
            <span>Status:</span>
            <span style="text-transform: uppercase; font-weight: bold; color: #059669;">
                {{ $income->status }}
            </span>
        </div>

        <div class="center footer">
            <p>Matur Nuwun!</p>
            <p>Bukti pembayaran sah Purwokerto Adventure</p>
        </div>
    </div>

</body>
</html>
