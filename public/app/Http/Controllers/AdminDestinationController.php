<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(12);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'distance_from_purwokerto' => 'nullable|numeric|min:0',
            'difficulty_level' => 'nullable|numeric|min:1|max:5',
            'category' => 'required|in:gunung,air terjun,danau,pantai,hutan'
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('destinations', 'public');
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi baru berhasil ditambahkan!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'distance_from_purwokerto' => 'nullable|numeric|min:0',
            'difficulty_level' => 'nullable|numeric|min:1|max:5',
            'category' => 'required|in:gunung,air terjun,danau,pantai,hutan'
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($destination->photo && Storage::disk('public')->exists($destination->photo)) {
                Storage::disk('public')->delete($destination->photo);
            }
            $data['photo'] = $request->file('photo')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi berhasil diupdate!');
    }

    public function destroy(Destination $destination)
    {
        // Hapus foto
        if ($destination->photo && Storage::disk('public')->exists($destination->photo)) {
            Storage::disk('public')->delete($destination->photo);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi berhasil dihapus!');
    }
    public function updatePhoto(Request $request, Destination $destination)
{
    $request->validate([
        'delete_photo' => 'required'
    ]);

    // Hapus foto lama
    if ($destination->photo && Storage::disk('public')->exists($destination->photo)) {
        Storage::disk('public')->delete($destination->photo);
    }

    // Update database
    $destination->update(['photo' => null]);

    return redirect()->back()->with('success', '✅ Foto berhasil dihapus!');
}
}
