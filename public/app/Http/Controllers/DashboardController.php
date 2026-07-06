<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guide;
use App\Models\Equipment;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncomeExport;
use App\Models\User;

class DashboardController extends Controller
{
    // Ini untuk halaman dashboard utama (dashboard.blade.php)
   public function index()
{
    $user = auth()->user();
    // Gunakan with(['destination', 'guide']) agar data relasi ikut terambil
    $bookings = Booking::with(['destination', 'guide'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();

    return view('dashboard', compact('bookings'));
}
    // Ini untuk halaman khusus Guide (guides/booking.blade.php)
    public function guideBookings()
    {
        $user = Auth::user();

        if (!$user->guide) {
            abort(403);
        }

        // Variabel ini juga harus $bookings agar Blade tidak error
       // Tambahkan 'destination' dan 'guide' ke dalam array with
$bookings = Booking::where('guide_id', $user->guide->id)
    ->with(['user', 'destination', 'guide']) // Wajib tambah destination di sini
    ->latest()
    ->paginate(10);

        $monthlyIncome = Booking::where('guide_id', $user->guide->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'approved')
            ->sum('guide_cost');

        return view('guides.booking', compact('bookings', 'monthlyIncome'));
    }
        public function approveBooking(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Booking disetujui!');
    }
    // ... (fungsi lainnya tetap sama)
     public function admin()
    {
        // Contoh: Mengambil semua user untuk ditampilkan di dashboard admin
        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }
    public function print($id)
    {
        // Fungsi ini digunakan jika wisatawan ingin mencetak nota dari tabel incomes
        $income = Income::findOrFail($id);
        return view('incomes.print', compact('income'));
    }
 public function tripHistory()
{
    // Kita panggil semua relasi yang kemungkinan kamu pakai di Model Booking
    $myTrips = Booking::where('user_id', Auth::id())
        ->with(['destination',  'guide'])
        ->latest()
        ->get();

    return view('Dashboard.trips.index', compact('myTrips'));
}
}
