<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEquipmentController extends Controller
{
    public function index()
    {
        // Mengambil semua data untuk ditampilkan di view index
        $equipments = Equipment::latest()->get();
        return view('admin.equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(Request $request)
    {
        // Validasi ketat sesuai struktur image_1d9356.png untuk cegah error database
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'daily_rate' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'available_stock' => 'required|integer|min:0|max:'.$request->stock, // Cegah tersedia > total stok
            'category' => 'required|in:sepeda,camping,trekking,lainnya',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Tambahkan user_id (Admin yang input)
        $validated['user_id'] = auth()->id();

        // Status default sesuai struktur database
        $validated['status'] = 'available';

        // Handle Upload Foto
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('equipments', 'public');
        }

        Equipment::create($validated);

        return redirect()->route('equipments.index')
                         ->with('success', 'Alat berhasil ditambahkan ke inventaris!');
    }


    /**
     * Menampilkan form edit untuk alat tertentu.
     */
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('admin.equipments.edit', compact('equipment'));
    }

    /**
     * Memperbarui data alat di database.
     */
    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'total_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada sebelum upload yang baru
            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image);
            }
            $data['image'] = $request->file('image')->store('equipments', 'public');
        }

        $equipment->update($data);

        return redirect()->route('admin.equipments.index')
            ->with('success', 'Data peralatan berhasil diperbarui!');
    }

    /**
     * Menghapus data alat dari database.
     */
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);

        // Hapus file gambar dari storage agar tidak memenuhi memori
        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return redirect()->route('admin.equipments.index')
            ->with('success', 'Alat telah berhasil dihapus!');
    }
}
