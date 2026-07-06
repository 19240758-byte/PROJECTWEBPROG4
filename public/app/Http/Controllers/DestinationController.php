<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * 🌍 HALAMAN PUBLIK: Menampilkan semua list destinasi (Gaya Baru)
     * Diakses saat siapa saja klik "Lihat Semua" di halaman depan
     */
    public function index()
    {
        // Ambil semua data destinasi terbaru
        $destinations = Destination::latest()->get();

        // ✅ Diarahkan ke views/destination/index.blade.php tanpa awalan "admin."
        return view('destination.index', compact('destinations'));
    }

    /**
     * 🌍 HALAMAN PUBLIK: Menampilkan detail satu lokasi wisata
     */
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destination.show', compact('destination'));
    }
}
