@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-black text-[#0F172A] tracking-tighter mb-1">Inventaris Alat</h1>
            <p class="text-slate-500 font-medium">Kelola ketersediaan alat rental Ngapak Adventure.</p>
        </div>
        <a href="{{ route('admin.equipments.create') }}" class="bg-[#3F6239] hover:bg-[#2d4629] text-white font-black py-4 px-8 rounded-2xl shadow-lg transition-all flex items-center gap-3">
            <i class="fas fa-plus"></i> Tambah Alat Baru
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alat</th>
                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga / Hari</th>
                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Stok (Tersedia)</th>
                    <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
    @foreach($equipments as $item)
    <tr class="hover:bg-slate-50/50 transition-colors">
        <td class="px-8 py-6">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $item->photo) }}" class="w-12 h-12 rounded-xl object-cover bg-slate-100">
                <div>
                    <p class="font-bold text-[#0F172A]">{{ $item->name }}</p>
                    <p class="text-xs text-slate-400 truncate max-w-[200px]">{{ $item->description }}</p>
                </div>
            </div>
        </td>
        <td class="px-6 py-6">
            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold uppercase tracking-tighter italic">
                {{ $item->category }}
            </span>
        </td>
        <td class="px-6 py-6 font-bold text-[#3F6239]">
            Rp{{ number_format($item->daily_rate, 0, ',', '.') }}
        </td>
        <td class="px-6 py-6 font-bold text-slate-700">
            {{ $item->stock }} <span class="text-slate-300 font-medium">/</span> <span class="text-emerald-600">{{ $item->available_stock }}</span>
        </td>
        <td class="px-6 py-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $item->status === 'available' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $item->status === 'available' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                {{ $item->status }}
            </span>
        </td>

        <td class="px-8 py-6 text-right space-x-2">

            <a href="{{ route('admin.equipments.edit', $item->id) }}"
               class="text-slate-400 hover:text-[#3F6239] transition-colors inline-block align-middle"
               title="Edit Alat">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('admin.equipments.destroy', $item->id) }}"
                  method="POST"
                  class="inline-block align-middle"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat {{ $item->name }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors" title="Hapus Alat">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
