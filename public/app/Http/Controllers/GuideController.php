<?php
namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::with('user')
            ->where('status', 'active')
            ->paginate(12);

        return view('guides.index', compact('guides'));
    }
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Menyimpan data guide baru & membuat akun login otomatis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'price' => 'required|numeric',
            'bio' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Handle Upload Foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('guides', 'public');
        }

        // 2. Create User (Otomatis buat password berdasarkan nama/email)
        // Password default: password123 (Sebaiknya minta user ganti saat login pertama)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'phone' => $request->phone,
            'price' => $request->price,
            'bio' => $request->bio,
            'photo' => $photoPath,
            'role' => 'guide',
            //'is_certified' => $request->has('is_certified'),
        ]);

        return redirect()->route('admin.guides.index')->with('success', 'Guide dan Akun Login berhasil dibuat!');
    }

    /**
     * Menghapus guide dan fotonya.
     */
    public function destroy(User $guide)
    {
        if ($guide->photo) {
            Storage::disk('public')->delete($guide->photo);
        }

        $guide->delete();
        return redirect()->back()->with('success', 'Guide berhasil dihapus.');
    }
    public function show($id)
    {
        // Cari data guide berdasarkan ID, jika tidak ketemu akan memunculkan error 404
        $guide = Guide::findOrFail($id);

        // Return ke view detail profil guide (misal nama filennya: resources/views/guides/show.blade.php)
        return view('guides.show', compact('guide'));
    }
}

