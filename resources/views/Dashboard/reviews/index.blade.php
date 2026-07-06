@extends('layouts.app')

@section('content')
<div class="flex h-[calc(100vh-4rem)] bg-[#090d16] font-sans antialiased text-slate-300">

      <!-- SIDEBAR LEFT (DYNAMIC NAV) -->
    <aside class="w-64 bg-[#0d121f] hidden lg:flex flex-col border-r border-slate-800/60 shrink-0">
        <div class="p-6 border-b border-slate-800/60">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-mountain text-xs"></i>
                </div>
                <div>
                    <h1 class="text-white font-black text-xs tracking-tight leading-none">NGAPAK ADVENTURE</h1>
                    <span class="text-emerald-400 text-[9px] font-bold uppercase tracking-widest mt-1 block">Explorer Panel</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <!-- Beranda -->
            <a href="/dashboard" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
                <i class="fas fa-home text-sm w-5 text-center {{ Request::is('dashboard') ? 'text-white' : 'text-slate-500' }}"></i>
                <span>Beranda</span>
            </a>

            <!-- Riwayat Pemesanan (Aktif di halaman ini atau ulasan) -->
            <a href="{{ route('trips.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard/reviews') || Request::is('dashboard/trips') || Request::is('reviews*') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
                <i class="fas fa-star text-sm w-5 text-center {{ Request::is('dashboard/reviews') || Request::is('dashboard/trips') || Request::is('reviews*') ? 'text-amber-300' : 'text-slate-500' }}"></i>
                <span>Riwayat Pemesanan</span>
            </a>

            <!-- Pesan -->
            <a href="{{ route('messages.index')}}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard/messages*') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
                <i class="fas fa-comment-dots text-sm w-5 text-center {{ Request::is('dashboard/messages*') ? 'text-white' : 'text-slate-500' }}"></i>
                <span>Pesan</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profile.index')}}" class="flex items-center gap-3.5 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-xl font-semibold text-xs uppercase tracking-wider transition-all">
                <i class="fas fa-user-circle text-sm w-5 text-center text-slate-500"></i>
                <span>Profil</span>
            </a>
             <a href="{{ route ('tourist.reviews.index')}}" class="flex items-center gap-3.5 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-xl font-semibold text-xs uppercase tracking-wider transition-all">
        <i class="fas fa-user-circle text-sm w-5 text-center text-slate-500"></i>
        <span>Ulasan</span>
            </a>
        </nav>
    </aside>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div>
            <h1 class="text-xl font-black text-white uppercase tracking-wider flex items-center gap-2">
                <i class="fas fa-star text-emerald-500"></i> Ulasan Saya
            </h1>
            <p class="text-xs text-slate-500 mt-1">Daftar ulasan dan penilaian yang pernah Anda berikan kepada pemandu wisata Ngapak Adventure.</p>
        </div>

        <div class="space-y-4">
            @forelse($myReviews as $review)
                <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-5 shadow-xl">
                    <div class="flex items-center justify-between border-b border-slate-800/40 pb-3 mb-3">
                        <div class="text-xs">
                            <span class="text-slate-500">Ulasan untuk Guide:</span>
                            <span class="font-bold text-white ml-1">{{ $review->guide->user->name ?? 'Pemandu' }}</span>
                        </div>
                        <div class="flex text-amber-400 text-[11px] gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-slate-300 italic">" {{ $review->comment }} "</p>
                    <div class="text-[10px] text-slate-600 text-right mt-2">{{ $review->created_at->format('d M Y H:i') }}</div>
                </div>
            @empty
                <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-12 text-center text-xs text-slate-500">
                    <i class="fas fa-comment-slash text-xl text-slate-700 block mb-2"></i>
                    Belum ada ulasan yang Anda kirimkan.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
