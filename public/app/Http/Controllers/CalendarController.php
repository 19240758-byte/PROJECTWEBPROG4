<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Pastikan yang akses adalah guide dan datanya ada
        if (!$user->guide) {
            return redirect()->back()->with('error', 'Akses khusus pemandu wisata.');
        }

        $guideId = $user->guide->id;

        // Ambil data booking milik guide ini yang statusnya 'approved' atau 'completed'
        $trips = Booking::where('guide_id', $guideId)
            ->whereIn('status', ['approved', 'completed'])
            ->with('user') // Ambil data wisatawan yang memesan
            ->get();

        // Format data agar mudah dibaca oleh kalender visual di Blade
        $events = [];
        foreach ($trips as $trip) {
            $events[] = [
                'title' => 'Trip dengan ' . $trip->user->name,
                'start' => $trip->booking_date->format('Y-m-d'), // Pastikan kolom booking_date sudah masuk format date/carbon di model
                'status' => $trip->status,
                'location' => $trip->location ?? 'Banyumas',
            ];
        }

        // Kirim data events ke dalam folder views/guides/calendar/index.blade.php
        return view('guides.calendar.index', compact('events'));
    }
}
