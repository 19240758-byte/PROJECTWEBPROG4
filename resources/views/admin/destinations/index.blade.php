@extends('layouts.admin')

@section('title', 'Kelola Destinasi')

@section('content')
<div class="space-y-8">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Destinasi Wisata</h1>
            <p class="text-slate-500 mt-1">Kelola daftar lokasi petualangan dan objek wisata</p>
        </div>
        <a href="{{ route('admin.destinations.create') }}" 
           class="bg-[#3F6239] hover:bg-[#2d4629] text-white px-6 py-3 rounded-2xl shadow-lg shadow-emerald-900/20 transition-all flex items-center gap-3 font-bold text-sm">
            <i class="fas fa-plus"></i>
            Tambah Destinasi
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Gambar</th>
                        <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Destinasi</th>
                        <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Kategori & Jarak</th>
                        <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Kesulitan</th>
                        <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($destinations as $destination)
                    <tr class="hover:bg-slate-50/80 transition-all group">
                        <td class="px-8 py-5">
                            <div class="relative w-20 h-20 overflow-hidden rounded-2xl shadow-sm border-2 border-white transition-transform group-hover:scale-105">
                                <img src="{{ asset('storage/' . $destination->photo) }}" 
                                     class="w-full h-full object-cover" 
                                     alt="{{ $destination->name }}"
                                     onerror="this.src='https://placehold.co/400x400?text=No+Image'">
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="font-bold text-slate-800 text-base mb-1">{{ $destination->name }}</div>
                            <div class="flex items-center text-xs text-slate-400 italic font-medium">
                                <i class="fas fa-map-marker-alt mr-1 text-emerald-500"></i> Banyumas Region
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider rounded-lg border border-emerald-100">
                                    {{ str_replace('_', ' ', $destination->category) }}
                                </span>
                                <span class="text-sm font-bold text-slate-600">
                                    {{ $destination->distance_from_purwokerto }} <span class="text-[10px] text-slate-400 uppercase">Km</span>
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <div class="flex flex-col items-center gap-1">
                                <div class="flex text-[10px] gap-0.5">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fas fa-star {{ $i > $destination->difficulty_level ? 'text-slate-200' : 'text-amber-400' }}"></i>
                                    @endfor
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Level {{ $destination->difficulty_level }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.destinations.edit', $destination) }}" 
                                   class="w-10 h-10 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all shadow-sm" 
                                   title="Edit Destinasi">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form method="POST" action="{{ route('admin.destinations.destroy', $destination) }}" class="inline" onsubmit="return confirm('Yakin hapus {{ $destination->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm" 
                                            title="Hapus Destinasi">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4 border border-slate-100">
                                    <i class="fas fa-map-marked-alt text-3xl"></i>
                                </div>
                                <h3 class="text-slate-800 font-bold text-lg">Destinasi Kosong</h3>
                                <p class="text-slate-400 text-sm mt-1 max-w-xs mx-auto">Anda belum menambahkan destinasi wisata ke dalam sistem "Ngapak Adventure".</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($destinations->hasPages())
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $destinations->links() }}
        </div>
        @endif
    </div>
</div>
@endsection