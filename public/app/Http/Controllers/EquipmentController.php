<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    /**
     * Menampilkan daftar alat untuk Admin (Semua data)
     */
   public function index(Request $request)
{
    // 1. Ambil input kategori dari URL
    $category = $request->query('category');

    // 2. Mulai Query dasar (Gunakan with('user') jika ada relasi agar tidak lambat)
    $query = \App\Models\Equipment::with('user')->latest();

    // 3. JIKA ada kategori yang dipilih, saring datanya
    if ($category) {
        $query->where('category', $category);
    }

    // 4. Eksekusi query menjadi pagination (JANGAN gunakan Equipment::latest() lagi di sini)
    $featuredEquipments = $query->paginate(12)->withQueryString();

    // 5. Kirim ke view
    return view('equipments.index', compact('featuredEquipments'));
}

    /**
     * Menampilkan daftar alat untuk User/Dashboard Sewa Alat
     */
   public function userIndex()
    {
        $equipments = Equipment::where('status', 'available')
            ->where('available_stock', '>', 0)
            ->latest()
            ->paginate(12); // Menggunakan paginate untuk mengatasi error image_1cbdda.png

        return view('equipments.index', compact('equipments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'daily_rate' => 'required|numeric',
            'stock' => 'required|integer',
            'available_stock' => 'required|integer|max:'.$request->stock,
            'category' => 'required|in:sepeda,camping,trekking,lainnya',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('equipments', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'available';

        Equipment::create($validated);

        return redirect()->route('equipments.index')->with('success', 'Alat berhasil ditambah!');
    }

   public function edit($id)
{
    // Cari data alat berdasarkan ID, jika tidak ada langsung memunculkan eror 404
    $equipment = Equipment::findOrFail($id);

    // Lempar data alat ke file form edit khusus admin
    return view('dashboard.equipments.edit', compact('equipment'));
}

// 2. Fungsi mengeksekusi update data ke database MySQL Laragon
public function update(Request $request, $id)
{
    // 1. Validasi Input Data
    $request->validate([
        'name'            => 'required|string|max:255',
        'category'        => 'required|string',
        'daily_rate'      => 'required|numeric',
        'stock'           => 'required|integer',
        'available_stock' => 'required|integer',
        'status'          => 'required|string',
        'description'     => 'required|string',
        'photo'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto maks 2MB
    ]);

    // 2. Cari data alat berdasarkan ID
    $equipment = Equipment::findOrFail($id);

    // 3. Ambil semua request text default
    $data = $request->all();

    // 4. Proses Jika Ada File Foto Baru Yang Diunggah
    if ($request->hasFile('photo')) {

        // Hapus file foto lama dari folder storage jika filenya memang ada
        if ($equipment->photo && Storage::disk('public')->exists($equipment->photo)) {
            Storage::disk('public')->delete($equipment->photo);
        }

        // Simpan foto baru ke folder 'public/equipments' di dalam direktori storage
        $path = $request->file('photo')->store('equipments', 'public');

        // Masukkan path foto baru ke dalam array data untuk diupdate
        $data['photo'] = $path;
    }

    // 5. Eksekusi update data ke database MySQL
    $equipment->update($data);

    // 6. Redirect kembali ke halaman utama index dengan alert sukses
    return redirect()->route('admin.equipments.index')->with('success', 'Data perlengkapan dan foto berhasil diperbarui!');
}
    public function destroy(Equipment $equipment)
    {
        if ($equipment->photo) Storage::disk('public')->delete($equipment->photo);
        $equipment->delete();

        return redirect()->route('equipments.index')->with('success', 'Alat dihapus!');
    }
}
