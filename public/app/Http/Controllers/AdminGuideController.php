<?php
namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminGuideController extends Controller
{
    public function index()
    {
        $guides = Guide::with('user')->latest()->paginate(12);
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        return view('admin.guides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'bio' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'phone' => $request->phone,
            'role' => 'guide', // Pastikan role diset agar muncul di dashboard
        ]);

        // 2. Siapkan data Guide
        $data = [
            'user_id'     => $user->id,
            'name'        => $request->name,
            'phone'       => $request->phone,
            'bio'         => $request->bio,
            'hourly_rate' => $request->price, // Menggunakan hourly_rate sesuai model Anda
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('guides', 'public');
        }

        Guide::create($data);

        return redirect()->route('admin.guides.index')->with('success', 'Guide baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $guide = Guide::with('user')->findOrFail($id);
        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        $guide = Guide::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'hourly_rate' => 'required|numeric',
            'bio'         => 'nullable',
            'certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. UPDATE NAMA DI TABEL USERS (Relasi)
        // Pastikan 'name' ada di $fillable di file App\Models\User.php
        if ($guide->user) {
            $guide->user->update([
                'name' => $request->name
            ]);
        }

        // 2. Siapkan data untuk tabel Guides
        $updateData = [
            'hourly_rate' => $request->hourly_rate,
            'bio'         => $request->bio,
            'name'        => $request->name, // Jika tabel guides juga menyimpan nama
        ];

        // 3. Update Certificate
        if ($request->hasFile('certificate')) {
            if ($guide->certificate && Storage::disk('public')->exists($guide->certificate)) {
                Storage::disk('public')->delete($guide->certificate);
                $updateData['is_certified'] = 1;
            }
            $updateData['certificate'] = $request->file('certificate')->store('certificates', 'public');
        }

        // 4. Update Photo
        if ($request->hasFile('photo')) {
            if ($guide->photo && Storage::disk('public')->exists($guide->photo)) {
                Storage::disk('public')->delete($guide->photo);
            }
            $updateData['photo'] = $request->file('photo')->store('guides', 'public');
        }

        // 5. EKSEKUSI UPDATE KE DATABASE
        $guide->update($updateData);

        return redirect()->route('admin.guides.index')->with('success', 'Guide berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Cari di tabel Guide dulu supaya bisa hapus file fotonya
        $guide = Guide::findOrFail($id);

        if ($guide->photo) {
            Storage::disk('public')->delete($guide->photo);
        }

        // Jika ingin menghapus usernya juga:
        if ($guide->user) {
            $guide->user->delete();
        }

        $guide->delete();

        return redirect()->back()->with('success', 'Guide berhasil dihapus.');
    }

     public function welcome()
{
    // Mengambil data guide yang aktif
    $guides = \App\Models\User::where('role', 'guide')->latest()->get();

    // MENGAMBIL DATA DESTINASI (Ini yang bikin error tadi karena belum ada)
    // Gunakan \App\Models\Destinasi atau sesuaikan dengan nama model Anda
    $destinations = \App\Models\Destination::latest()->get();

    // Mengirim kedua variabel ke view welcome
    return view('welcome', compact('guides', 'destinations'));

}
}
