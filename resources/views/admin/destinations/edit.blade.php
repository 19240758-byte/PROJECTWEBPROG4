@extends('layouts.admin')

@section('title', 'Edit ' . $destination->name ?? 'Destinasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-black mb-2">Edit Destinasi</h1>
                    <p class="text-xl opacity-90">{{ $destination->name ?? 'Destinasi Baru' }}</p>
                </div>
                <a href="{{ route('admin.destinations.index') }}"
                   class="flex items-center space-x-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 px-6 py-3 rounded-2xl font-bold transition-all">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="p-8">
            <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">
                        Nama Destinasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $destination->name) }}"
                           required
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-sm text-lg"
                           placeholder="Contoh: Baturraden Paradise">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-3">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" rows="6"
                              required
                              class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-sm"
                              placeholder="Jelaskan keunikan destinasi ini...">{{ old('description', $destination->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid Kategori & Jarak -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" required class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-sm">
                            <option value="">Pilih Kategori</option>
                            <option value="gunung" {{ old('category', $destination->category ?? '') == 'gunung' ? 'selected' : '' }}>🏔️ Gunung</option>
                            <option value="air terjun" {{ old('category', $destination->category ?? '') == 'air terjun' ? 'selected' : '' }}>🌊 Air Terjun</option>
                            <option value="danau" {{ old('category', $destination->category ?? '') == 'danau' ? 'selected' : '' }}>💧 Danau</option>
                            <option value="pantai" {{ old('category', $destination->category ?? '') == 'pantai' ? 'selected' : '' }}>🏖️ Pantai</option>
                            <option value="hutan" {{ old('category', $destination->category ?? '') == 'hutan' ? 'selected' : '' }}>🌲 Hutan</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jarak -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Jarak dari Purwokerto (KM)</label>
                        <input type="number" name="distance_from_purwokerto" step="0.1"
                               value="{{ old('distance_from_purwokerto', $destination->distance_from_purwokerto ?? '') }}"
                               class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-sm"
                               placeholder="15.5">
                    </div>
                </div>

                <!-- Tingkat Kesulitan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-4">Tingkat Kesulitan <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-5 gap-4 p-6 bg-gray-50 rounded-2xl">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="relative p-6 border-2 border-gray-300 hover:border-blue-400 rounded-2xl hover:shadow-md transition-all cursor-pointer group
                                          {{ old('difficulty_level', $destination->difficulty_level ?? 3) == $i ? 'border-blue-500 bg-blue-50 shadow-lg' : '' }}">
                                <input type="radio" name="difficulty_level" value="{{ $i }}"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer peer z-10" required>
                                <div class="flex justify-center mb-3">
                                    @for($j = 1; $j <= 5; $j++)
                                        <i class="fas fa-star text-2xl {{ $j <= $i ? 'text-yellow-500' : 'text-gray-300' }} peer-hover:text-yellow-500 transition-colors"></i>
                                    @endfor
                                </div>
                                <div class="text-center">
                                    <span class="font-bold text-xl text-gray-900 block">{{ $i }}</span>
                                    <span class="text-xs text-gray-600 capitalize">{{ $i == 1 ? 'Mudah' : ($i == 5 ? 'Sulit' : 'Sedang') }}</span>
                                </div>
                            </label>
                        @endfor
                    </div>
                    @error('difficulty_level')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Upload -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-6">Foto Destinasi</label>

                    @if($destination->photo)
                    <!-- Preview Foto Lama -->
                    <div class="mb-8 p-8 bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl border-2 border-dashed border-blue-200 shadow-lg">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
                            <img src="{{ Storage::url($destination->photo) }}"
                                 class="w-64 h-48 object-cover rounded-2xl shadow-2xl flex-shrink-0 ring-4 ring-white shadow-lg mx-auto lg:mx-0"
                                 alt="{{ $destination->name }}"
                                 onerror="this.src='https://via.placeholder.com/400x300/3b82f6/ffffff?text=No+Image'">

                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-xl text-gray-900 mb-3">Foto Aktif</h4>
                                <p class="text-sm text-gray-600 bg-white px-4 py-2 rounded-xl mb-6 truncate max-w-md border">{{ $destination->photo }}</p>

                                <div class="flex flex-wrap gap-3">
                                    <!-- Ganti Foto -->
                                    <label class="flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl cursor-pointer shadow-lg hover:shadow-xl transition-all whitespace-nowrap">
                                        <i class="fas fa-camera mr-2"></i>
                                        <span>Ganti Foto</span>
                                        <input type="file" name="photo" class="hidden ml-2" accept="image/jpeg,image/png,image/jpg,gif" />
                                    </label>

                                    <!-- Hapus Foto -->
                                    <form method="POST" action="{{ route('admin.destinations.update-photo', $destination) }}"
                                          class="inline-block" onsubmit="return confirm('Yakin hapus foto ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="delete_photo" value="1">
                                        <button type="submit"
                                                class="flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all whitespace-nowrap">
                                            <i class="fas fa-trash mr-2"></i>
                                            <span>Hapus Foto</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Upload Baru -->
                    <label class="block w-full border-4 border-dashed border-gray-300 hover:border-blue-400 rounded-3xl p-16 text-center
                                  hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 transition-all cursor-pointer group relative overflow-hidden">
                                                <input type="file" name="photo"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 peer"
                               accept="image/jpeg,image/png,image/jpg,image/gif" />

                        <div class="relative z-20 pointer-events-none">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-3xl flex items-center justify-center mx-auto mb-6
                                        group-hover:scale-110 transition-all shadow-xl mx-auto">
                                <i class="fas fa-cloud-upload-alt text-2xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-700 transition-all">Upload Foto Baru</h3>
                            <p class="text-lg text-gray-600 mb-1">JPG, PNG, GIF</p>
                            <p class="text-sm text-gray-500">Maksimal 2MB - Recommended 1200x800px</p>
                        </div>
                    </label>
                    @error('photo')
                        <div class="mt-4 p-4 bg-red-50 border-l-4 border-red-400 rounded-xl">
                            <p class="text-red-700 text-sm font-medium flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <!-- Tombol Action -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 bg-gradient-to-r from-gray-50 to-blue-50 p-8 rounded-3xl -mx-8 -mb-8">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700
                                   shadow-2xl hover:shadow-3xl text-white font-black py-5 px-12 rounded-3xl text-xl uppercase tracking-wide
                                   transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 flex items-center justify-center space-x-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <span>Simpan Perubahan</span>
                    </button>

                    <a href="{{ route('admin.destinations.index') }}"
                       class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700
                              text-white font-bold py-5 px-12 rounded-3xl shadow-xl hover:shadow-2xl transition-all text-xl uppercase tracking-wide
                              flex items-center justify-center">
                        <i class="fas fa-times-circle mr-2"></i>
                        <span>Batal & Kembali</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT FIX Z-INDEX --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fix z-index conflict
    const allInputs = document.querySelectorAll('input:not([type=file]), textarea, select');
    allInputs.forEach(input => {
        input.style.position = 'relative';
        input.style.zIndex = '9999';
    });

    // Photo preview
    document.querySelector('input[type=file][name="photo"]')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                let preview = document.querySelector('.preview-photo');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.className = 'preview-photo w-32 h-24 object-cover rounded-2xl shadow-lg mt-4 mx-auto block border-4 border-dashed border-blue-300';
                    e.target.parentNode.parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
                preview.alt = 'Preview';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

<style>
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
</style>
@endsection
