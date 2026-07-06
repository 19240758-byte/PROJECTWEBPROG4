@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pb-10">
    <!-- Header Section -->
    <div class="bg-[#0f172a] pt-12 pb-20 px-4">
        <div class="max-w-3xl mx-auto">
            <a href="{{ route('admin.equipments.index') }}" class="text-emerald-400 hover:text-emerald-300 mb-4 inline-flex items-center gap-2 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali ke Inventaris
            </a>
            <h1 class="text-3xl font-bold text-white mt-2">Tambah Alat Rental Baru</h1>
            <p class="text-slate-400">Lengkapi formulir di bawah untuk menambahkan unit peralatan ke dalam database.</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-3xl mx-auto px-4 -mt-10">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">

            <!-- Error Handling Section -->
            @if ($errors->any())
            <div class="p-4 bg-red-50 border-b border-red-100">
                <div class="flex items-center gap-2 text-red-700 font-bold mb-2">
                    <i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan:
                </div>
                <ul class="list-disc ml-5 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.equipments.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Alat -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Peralatan</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Tenda Dome 4 Orang"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none">
                            <option value="">Pilih Kategori</option>
                            <option value="sepeda" {{ old('category') == 'sepeda' ? 'selected' : '' }}>Sepeda</option>
                            <option value="camping" {{ old('category') == 'camping' ? 'selected' : '' }}>Camping</option>
                            <option value="trekking" {{ old('category') == 'trekking' ? 'selected' : '' }}>Trekking</option>
                            <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Harga Sewa -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga Sewa / Hari (Rp)</label>
                        <input type="number" name="daily_rate" value="{{ old('daily_rate') }}" placeholder="75000"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>

                    <!-- Total Stok -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Total Stok Unit</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" placeholder="10"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>

                    <!-- Stok Tersedia -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Stok Siap Sewa</label>
                        <input type="number" name="available_stock" value="{{ old('available_stock') }}" placeholder="10"
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan detail alat, merk, dan kelengkapannya..."
                              class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('description') }}</textarea>
                </div>

                <!-- Foto Upload -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Foto Peralatan</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-emerald-400 transition-colors cursor-pointer" onclick="document.getElementById('photo-input').click()">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2" id="upload-icon"></i>
                            <div class="flex text-sm text-gray-600">
                                <span class="text-emerald-600 font-medium">Klik untuk upload foto</span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                        </div>
                        <input id="photo-input" name="photo" type="file" class="hidden" onchange="previewImage(event)">
                    </div>
                    <!-- Preview Image Area -->
                    <div id="image-preview-container" class="mt-4 hidden">
                        <img id="image-preview" src="#" class="w-full max-h-64 object-cover rounded-lg border border-gray-200">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 rounded-lg shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan ke Database
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan pratinjau gambar sebelum upload
    function previewImage(event) {
        const reader = new FileReader();
        const container = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');

        reader.onload = function() {
            if (reader.readyState === 2) {
                preview.src = reader.result;
                container.classList.remove('hidden');
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
