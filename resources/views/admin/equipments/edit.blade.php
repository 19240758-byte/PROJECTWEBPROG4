@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.equipments.index') }}" class="w-10 h-10 bg-white border border-slate-200 hover:bg-slate-50 text-slate-500 hover:text-[#3F6239] rounded-xl transition-all flex items-center justify-center shadow-sm">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-[#0F172A] tracking-tighter">Edit Alat Rental</h1>
            <p class="text-slate-400 font-medium text-xs mt-0.5">Perbarui rincian, harga sewa, atau ketersediaan stok perlengkapan Ngapak Adventure.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
        <form action="{{ route('admin.equipments.update', $equipment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Nama Perlengkapan</label>
                <input type="text" name="name" value="{{ old('name', $equipment->name) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm text-[#0F172A] font-medium focus:ring-2 focus:ring-[#3F6239]/20 focus:border-[#3F6239] focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Kategori</label>
                    <select name="category" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm p-3.5 text-slate-700 font-medium focus:outline-none focus:border-[#3F6239] focus:ring-2 focus:ring-[#3F6239]/20 transition-all">
                        <option value="CAMPING" {{ old('category', $equipment->category) == 'CAMPING' ? 'selected' : '' }}>⛺ CAMPING</option>
                        <option value="SEPEDA" {{ old('category', $equipment->category) == 'SEPEDA' ? 'selected' : '' }}>🚲 SEPEDA</option>
                        <option value="HIKING" {{ old('category', $equipment->category) == 'HIKING' ? 'selected' : '' }}>🥾 HIKING</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Harga / Hari (Rp)</label>
                    <input type="number" name="daily_rate" value="{{ old('daily_rate', $equipment->daily_rate) }}" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm text-[#3F6239] font-bold focus:outline-none focus:border-[#3F6239] focus:ring-2 focus:ring-[#3F6239]/20 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Total Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $equipment->stock) }}" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm text-[#0F172A] font-medium focus:outline-none focus:border-[#3F6239] transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Stok Tersedia (Ready)</label>
                    <input type="number" name="available_stock" value="{{ old('available_stock', $equipment->available_stock) }}" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm text-emerald-600 font-bold focus:outline-none focus:border-[#3F6239] transition-all">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Status Sistem</label>
                <select name="status" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm p-3.5 text-slate-700 font-medium focus:outline-none focus:border-[#3F6239] transition-all">
                    <option value="available" {{ old('status', $equipment->status) == 'available' ? 'selected' : '' }}>🟢 Available (Tersedia)</option>
                    <option value="empty" {{ old('status', $equipment->status) == 'empty' ? 'selected' : '' }}>🔴 Empty (Habis)</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Foto Perlengkapan Alat</label>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <div class="shrink-0">
                        <p class="text-[9px] text-slate-400 font-black uppercase mb-1">Foto Saat Ini:</p>
                        @if($equipment->photo)
                            <img src="{{ asset('storage/' . $equipment->photo) }}" class="w-20 h-20 rounded-xl object-cover border border-slate-200 bg-white shadow-sm">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400 text-[10px] font-black">NO PHOTO</div>
                        @endif
                    </div>
                    <div class="flex-grow w-full">
                        <p class="text-[9px] text-slate-400 font-black uppercase mb-1">Unggah Foto Baru (Opsional):</p>
                        <input type="file" name="photo" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#3F6239]/10 file:text-[#3F6239] hover:file:bg-[#3F6239]/20 file:cursor-pointer transition-all">
                        <p class="text-[10px] text-slate-400 mt-1.5 italic">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak diubah.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] text-slate-400 uppercase tracking-widest font-black block">Deskripsi Singkat</label>
                <textarea name="description" rows="3" required
                          class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3.5 text-sm text-slate-600 focus:outline-none focus:border-[#3F6239] transition-all" placeholder="Tulis rincian singkat barang...">{{ old('description', $equipment->description) }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.equipments.index') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs py-3.5 px-6 rounded-xl transition-all uppercase tracking-wider">
                    Batal
                </a>
                <button type="submit"
                        class="bg-[#3F6239] hover:bg-[#2d4629] text-white font-black text-xs py-3.5 px-7 rounded-xl transition-all uppercase tracking-wider shadow-md shadow-[#3F6239]/10">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
