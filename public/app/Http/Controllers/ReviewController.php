<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Menampilkan semua ulasan dari wisatawan untuk Guide yang sedang login
     */
    public function index()
    {
        // Ambil data user yang sedang login beserta relasi guide-nya
        $user = Auth::user();

        // Pengaman: Pastikan user ini memang terdaftar sebagai guide di sistem
        if (!$user->guide) {
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini khusus untuk Pemandu Wisata.');
        }

        // Ambil semua ulasan yang ditujukan untuk guide ini beserta data wisatawan yang mengisi (user)
        $reviews = Review::where('guide_id', $user->guide->id)
            ->with('user')
            ->latest() // Urutkan dari ulasan yang paling baru masuk
            ->get();

        // Hitung rata-rata rating (bintang) secara otomatis untuk pajangan widget dashboard
        $averageRating = $reviews->avg('rating') ?? 0;

        // Lempar data ke halaman view premium ulasan guide
        return view('guides.reviews.index', compact('reviews', 'averageRating'));
    }


public function touristIndex()
    {
        $user = Auth::user();

        // 1. Ambil data ulasan yang PERNAH ditulis oleh wisatawan ini
        $myReviews = Review::where('user_id', $user->id)
            ->with('guide.user')
            ->latest()
            ->get();

        // 2. Ambil data booking milik user ini (Gunakan query LIKE agar huruf besar/kecil tidak berpengaruh)
        $bookings = Booking::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('status', 'LIKE', '%selesai%')
                      ->orWhere('status', 'LIKE', '%completed%');
            })
            ->with('guide.user')
            ->latest()
            ->get();



    // 3. Lempar KEDUA variabel ke view (compact 'myReviews' dan 'bookings')
    return view('dashboard.reviews.index', compact('myReviews', 'bookings'));
}
public function store(Request $request, $bookingId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    $booking = Booking::findOrFail($bookingId);

    Review::create([
        'booking_id' => $booking->id,
        'user_id' => auth()->id(),
        'guide_id' => $booking->guide_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // DI SINI: Setelah sukses mengulas, otomatis dilempar ke halaman list Ulasan Saya
    return redirect()->route('tourist.reviews.index')->with('success', 'Ulasan berhasil dikirim! Terima kasih atas feedback Anda.');
}
/**
 * Menampilkan semua data riwayat transaksi/booking milik wisatawan yang sedang login
 */
public function touristBookingIndex()
{
    $user = Auth::user();

    // Ganti nama $bookings menjadi $myTrips agar sinkron dengan baris 71 di Blade
    $myTrips = Booking::where('user_id', $user->id)
        ->with('guide.user')
        ->latest()
        ->get();

    // Lempar variabel $myTrips ke halaman file blade tabel riwayat
    return view('dashboard.booking.index', compact('myTrips'));
}
}
