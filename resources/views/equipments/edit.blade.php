@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#090d16] font-sans antialiased text-slate-300 pt-24 pb-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex items-center gap-3 border-b border-slate-800 pb-4">
            <a href="{{ route('admin.equipments.index') }}" class="w-8 h-8 bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white rounded-xl transition-all flex items-center justify-center border border-slate-700/50">
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-lg font-black text-white uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-edit text-emerald-500"></i> Edit Alat Rental
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi, harga, atau ketersediaan stok perlengkapan.</p>
            </div>
        </div>

        <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-6 shadow-2xl">
            <form action="{{ route('admin.equipments.update', $equipment->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT') {{-- PENTING: Laravel butuh method PUT/PATCH untuk proses update --}}

                <div class="space-y-1.5">
                    <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Nama Alat Perlengkapan:</label>
                    <input type="text" name="name" value="{{ old('name', $equipment->name) }}" required
                           class="w-full bg-[#090d16] border border-slate-800 rounded-xl p-3 text-xs text-white focus:ring-1 focus:ring-emerald-500 focus:outline-none placeholder-slate-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Kategori:</label>
                        <select name="category" required
                                class="w-full bg-[#090d16] border border-slate-700/60 rounded-xl text-xs px-3 py-3 text-slate-300 font-medium focus:outline-none focus:border-emerald-500">
                            <option value="CAMPING" {{ $equipment->category == 'CAMPING' ? 'selected' : '' }}>⛺ CAMPING</option>
                            <option value="SEPEDA" {{ $equipment->category == 'SEPEDA' ? 'selected' : '' }}>🚲 SEPEDA</option>
                            <option value="HIKING" {{ $equipment->category == 'HIKING' ? 'selected' : '' }}>🥾 HIKING</option>
                            <option value="LAINNYA" {{ $equipment->category == 'LAINNYA' ? 'selected' : '' }}>📦 LAINNYA</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Harga / Hari (Rp):</label>
                        <input type="number" name="price" value="{{ old('price', $equipment->price) }}" required
                               class="w-full bg-[#090d16] border border-slate-800 rounded-xl p-3 text-xs text-emerald-400 font-bold focus:ring-1 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Total Stok Gudang:</label>
                        <input type="number" name="stock" value="{{ old('stock', $equipment->stock) }}" required
                               class="w-full bg-[#090d16] border border-slate-800 rounded-xl p-3 text-xs text-white focus:ring-1 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Status Alat:</label>
                        <select name="status" required
                                class="w-full bg-[#090d16] border border-slate-700/60 rounded-xl text-xs px-3 py-3 text-slate-300 font-medium focus:outline-none focus:border-emerald-500">
                            <option value="AVAILABLE" {{ $equipment->status == 'AVAILABLE' ? 'selected' : '' }}>🟢 AVAILABLE</option>
                            <option value="EMPTY" {{ $equipment->status == 'EMPTY' ? 'selected' : '' }}>🔴 EMPTY</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Deskripsi Singkat Alat:</label>
                    <textarea name="description" rows="3"
                              class="w-full bg-[#090d16] border border-slate-800 rounded-xl p-3 text-xs text-slate-300 focus:ring-1 focus:ring-emerald-500 focus:outline-none placeholder-slate-600"
                              placeholder="Tulis spesifikasi singkat alat... Max 255 karakter.">{{ old('description', $equipment->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-800/60">
                    <a href="{{ route('admin.equipments.index') }}"
                       class="bg-slate-800 hover:bg-slate-700 text-white font-bold text-[10px] px-4 py-2.5 rounded-xl transition-all uppercase tracking-wider">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[10px] px-5 py-2.5 rounded-xl transition-all uppercase tracking-wider shadow-md shadow-emerald-500/10">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
