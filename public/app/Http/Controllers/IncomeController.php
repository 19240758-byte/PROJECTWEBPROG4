<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function exportPdf(Request $request)
{
    $now = Carbon::now('Asia/Jakarta');
    $monthParam = $request->get('month', $now->format('Y-m'));
    $date = Carbon::parse($monthParam);

    // Ambil data berdasarkan kolom 'tanggal' (sesuai gambar)
    $data = Income::where('user_id', Auth::id())
        ->whereMonth('tanggal', $date->month)
        ->whereYear('tanggal', $date->year)
        ->get();

    $viewData = [
        'data'         => $data,
        'month'        => $date->translatedFormat('F Y'),
        'total'        => $data->sum('biaya'), // Menggunakan kolom 'biaya'
        'waktu_cetak'  => $now->translatedFormat('d F Y, H:i') . ' WIB'
    ];

    $pdf = Pdf::loadView('pdf.laporan_pendapatan', $viewData);
    return $pdf->download('Laporan-Pendapatan-' . $monthParam . '.pdf');
}
   public function print($id)
{
    // Ambil data booking, tapi simpan ke variabel bernama $income
    $income = \App\Models\Booking::with(['destination', 'user', 'guide'])->findOrFail($id);

    // Kirim variabel $income ke view
    return view('incomes.print', compact('income'));
}
}
