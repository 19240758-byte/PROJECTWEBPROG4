<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guide;
use App\Models\Equipment;
use App\Models\Income;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $guideId = auth()->id();

        // 1. Ambil input bulan dari filter (Default: Bulan & Tahun Sekarang jika kosong)
        $selectedMonth = $request->input('month', \Carbon\Carbon::now()->format('Y-m'));

        // Pecah string 'YYYY-MM' menjadi angka tahun dan bulan
        $carbonDate = \Carbon\Carbon::parse($selectedMonth . '-01');
        $monthNumber = $carbonDate->month;
        $yearNumber = $carbonDate->year;

        // 2. Query data booking khusus untuk Guide ini di bulan & tahun terpilih
        $query = \App\Models\Booking::where('guide_id', $guideId)
            ->whereYear('booking_date', $yearNumber)
            ->whereMonth('booking_date', $monthNumber);

        // 3. Hitung Statistik Ringkasan Otomatis untuk bulan terpilih
        $monthlyIncome = (clone $query)->whereIn('status', ['approved', 'completed'])->sum('guide_cost');
        $totalHours = (clone $query)->whereIn('status', ['approved', 'completed'])->sum('duration_hours');
        $completedTripsCount = (clone $query)->where('status', 'completed')->count();

        // 4. Ambil data list tabel dengan pagination
        $bookings = $query->with('user')
            ->orderBy('booking_date', 'desc')
            ->paginate(10)
            ->appends(['month' => $selectedMonth]);

        // 5. Return ke view folder guides (sesuai letak file booking.blade.php kamu)
        return view('guides.booking', compact(
            'bookings',
            'monthlyIncome',
            'totalHours',
            'completedTripsCount',
            'selectedMonth'
        ));
    }
    public function create()
    {
        $guides = Guide::where('status', 'active')->get();
        $equipments = Equipment::where('status', 'available')
            ->where('available_stock', '>', 0)
            ->get();
        $destinations = Destination::all();

        return view('bookings.create', compact('guides', 'equipments', 'destinations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'destination_id' => 'required|exists:destinations,id',
        'booking_date'   => 'required|date',
        'amount'         => 'required|numeric',
        'duration_hours' => 'required|integer',
        'guide_id'       => 'nullable|exists:guides,id',
    ]);

    // Menggunakan Transaction agar jika satu gagal, keduanya batal simpan
    $data = DB::transaction(function () use ($request) {

        // 1. SIMPAN KE TABEL BOOKINGS (Agar muncul di dashboard Guide/Bayu)
        $booking = Booking::create([
            'user_id'        => Auth::id(),
            'guide_id'       => $request->guide_id,
            'destination_id' => $request->destination_id,
            'booking_date'   => $request->booking_date,
            'duration_hours' => $request->duration_hours,
            'guide_cost'     => $request->amount,
            'total_cost'     => $request->amount,
            'status'         => 'pending',
        ]);

        // 2. SIMPAN KE TABEL INCOMES (Agar data real-time untuk Nota)
       $income = Income::create([
    // Ambil User ID asli si Guide dari relasi
    'user_id'        => Guide::find($request->guide_id)->user_id,
    'nama_pelanggan' => Auth::user()->name,
    'tanggal'        => $request->booking_date,
    'durasi'         => $request->duration_hours,
    'biaya'          => $request->amount,
    'status'         => 'pending',
]);
    });

    // Arahkan ke dashboard dengan opsi cetak nota
    return redirect()->route('dashboard')->with('success', 'Booking berhasil! Data sudah masuk ke rekapan.');
}

    public function approve($id)
{
    $booking = Booking::with('user')->findOrFail($id);
    $booking->status = 'approved';
    $booking->save();

    // HANYA masukkan ke incomes jika ada Guide-nya
    if ($booking->guide_id) {
        Income::updateOrCreate(
            // Cek apakah data ini sudah pernah masuk (berdasarkan user dan tanggal)
            ['tanggal' => $booking->booking_date, 'nama_pelanggan' => $booking->user->name],
            [
                'user_id'        => $booking->guide_id, // Ini tidak boleh NULL
                'durasi'         => $booking->duration_hours,
                'biaya'          => $booking->guide_cost,
                'status'         => 'disetujui',
            ]
        );
    }

    return redirect()->back()->with('success', 'Booking disetujui.');
}

    public function print($id)
    {
        // Fungsi ini digunakan jika wisatawan ingin mencetak nota dari tabel incomes
        $income = Income::findOrFail($id);
        return view('incomes.print', compact('income'));
    }
    public function showCalendar()
{
    return view('Dashboard.calender.index');
}

// Menyediakan feed data JSON otomatis untuk ditarik oleh FullCalendar Javascript
public function getCalendarEvents()
{
    $guideId = \Auth::id();

    // Ambil data booking berstatus pending dan approved milik guide ini
    $bookings = \App\Models\Booking::where('guide_id', $guideId)
        ->whereIn('status', ['pending', 'approved'])
        ->with('user')
        ->get();

    $events = [];

    foreach ($bookings as $booking) {
        // Tentukan warna penanda jadwal berdasarkan status konfirmasi
        $color = ($booking->status === 'approved') ? '#10b981' : '#f59e0b'; // Emerald untuk disetujui, Amber untuk pending

        $events[] = [
            'id' => $booking->id,
            'title' => 'Trip: ' . $booking->user->name . ' (' . $booking->duration_hours . ' Jam)',
            'start' => $booking->booking_date->format('Y-m-d') . ($booking->start_time ? 'T' . $booking->start_time->format('H:i:s') : ''),
            'end' => $booking->booking_date->format('Y-m-d') . ($booking->end_time ? 'T' . $booking->end_time->format('H:i:s') : ''),
            'backgroundColor' => $color,
            'extendedProps' => [
                'waktu' => $booking->start_time ? $booking->start_time->format('H:i') . ' WIB' : '-'
            ]
        ];
    }

    return response()->json($events);
}
/**
     * Relasi ke model Message
     * Satu bookingan memiliki banyak baris pesan chat
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'booking_id');
    }
}
