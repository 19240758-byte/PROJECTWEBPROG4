<?php
namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Equipment;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $guides = Guide::where('status', 'active')
        ->with('user')
        ->limit(4)
        ->get();

        $featuredEquipments = Equipment::where('status', 'available')
            ->where('available_stock', '>', 0)
            ->limit(6)
            ->get();
         $destinations = \App\Models\Destination::all();


        return view('welcome', compact('guides', 'featuredEquipments','destinations'));


    // Mengambil semua data destinasi dari database
        $guides = Guide::all();


    // Pastikan $guides dikirim ke view
    return view('welcome', compact('guides'));
    }

}
