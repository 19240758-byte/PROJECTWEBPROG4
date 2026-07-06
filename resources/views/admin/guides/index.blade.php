@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Kelola Guide</h1>
            <p class="text-slate-500 mt-1">Daftar pemandu wisata lokal yang terdaftar dalam sistem</p>
        </div>
        <a href="{{ route('admin.guides.create') }}" 
           class="bg-[#3F6239] hover:bg-[#2d4629] text-white px-6 py-3 rounded-2xl shadow-lg shadow-emerald-900/20 transition-all flex items-center gap-3 font-bold text-sm">
            <i class="fas fa-plus"></i>
            Tambah Guide Baru
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm flex items-center gap-3" role="alert">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Foto</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Informasi Guide</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Harga / Jam</th>
                    <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($guides as $guide)
                <tr class="hover:bg-slate-50/80 transition-all group">
                    <td class="px-8 py-5">
                        <div class="relative w-14 h-14">
                            <img src="{{ asset('storage/' . $guide->photo) }}"
                                 alt="{{ $guide->name }}"
                                 class="w-full h-full rounded-2xl object-cover shadow-md border-2 border-white transition-transform group-hover:scale-110"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($guide->name) }}&background=3F6239&color=fff'">
                            @if($guide->is_certified)
                                <div class="absolute -top-2 -right-2 bg-emerald-500 text-white text-[8px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="font-bold text-slate-800 text-base">{{ $guide->name }}</div>
                        <div class="text-xs text-slate-400 font-medium mt-0.5 flex items-center gap-2">
                            <i class="fas fa-envelope text-[10px]"></i>
                            {{ $guide->email }}
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 font-bold text-sm border border-emerald-100">
                            Rp{{ number_format($guide->price, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.guides.edit', $guide->id) }}" 
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all shadow-sm" 
                               title="Edit Guide">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guide ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm" 
                                        title="Hapus Guide">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                                <i class="fas fa-user-slash text-3xl"></i>
                            </div>
                            <h3 class="text-slate-800 font-bold">Belum Ada Guide</h3>
                            <p class="text-slate-400 text-sm mt-1">Mulai tambahkan pemandu wisata pertama Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection