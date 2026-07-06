@extends('layouts.admin')

@section('title', 'Tambah Destinasi')

@section('content')
<div class="max-w-2xl">
    <div class="card p-8">
        <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">Nama Destinasi</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-primary-200 focus:border-primary-500 transition-all text-lg @error('name') border-red-500 @enderror"
                       placeholder="Contoh: Baturraden Waterfall Paradise" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">Deskripsi</label>
                <textarea name="description" rows="5"
                          class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-primary-200 focus:border-primary-500 transition-all @error('description') border-red-500 @enderror"
                          placeholder="Jelaskan keunikan destinasi ini...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Kategori</label>
                    <select name="category"
                            class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-primary-200 focus:border-primary-500 @error('category') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="gunung" {{ old('category') == 'gunung' ? 'selected' : '' }}>Gunung</option>
                        <option value="air terjun" {{ old('category') == 'air terjun' ? 'selected' : '' }}>Air Terjun</option>
                        <option value="danau" {{ old('category') == 'danau' ? 'selected' : '' }}>Danau</option>
                        <option value="pantai" {{ old('category') == 'pantai' ? 'selected' : '' }}>Pantai</option>
                        <option value="hutan" {{ old('category') == 'hutan' ? 'selected' : '' }}>Hutan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Jarak dari Purwokerto (KM)</label>
                    <input type="number" name="distance_from_purwokerto" step="0.1"
                           value="{{ old('distance_from_purwokerto') }}"
                           class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-primary-200 focus:border-primary-500 transition-all @error('distance_from_purwokerto') border-red-500 @enderror"
                           placeholder="15.5">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">Tingkat Kesulitan (1-5)</label>
                <div class="flex items-center space-x-4">
                    @for($i=1; $i<=5; $i++)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="difficulty_level" value="{{ $i }}"
                                   class="w-6 h-6 text-primary-600 border-gray-300 focus:ring-primary-500"
                                   {{ old('difficulty_level') == $i ? 'checked' : '' }}>
                            <span class="text-lg font-bold text-gray-700">{{ $i }}</span>
                            <div class="flex text-yellow-400">
                                @for($j=1; $j<=5; $j++)
                                    <i class="fas fa-star {{ $j <= $i ? '' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                        </label>
                    @endfor
                </div>
                @error('difficulty_level')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-3">
                    Foto Destinasi
                    <span class="text-xs text-gray-500 block mt-1">(JPG, PNG, max 2MB)</span>
                </label>
               <div class="relative">
    <input type="file" name="photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">

    <div class="border-2 border-dashed p-6 text-center">
        <p>Klik untuk upload foto</p>
    </div>
</div>
                @error('photo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all text-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Destinasi
                </button>
                <a href="{{ route('admin.destinations.index') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-4 px-8 rounded-2xl text-center shadow-md hover:shadow-lg transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
