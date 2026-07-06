@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-950 text-white antialiased font-sans relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[120px] pointer-events-none"></div>

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
        <a href="/dashboard"
       class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
        <i class="fas fa-home text-sm w-5 text-center {{ Request::is('dashboard') ? 'text-white' : 'text-slate-500' }}"></i>
        <span>Beranda</span>
        </a>

    <a href="{{ route('messages.index') }}"
   class="flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ request()->routeIs('tourist.messages') ? 'bg-emerald-500 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
    <div class="flex items-center gap-3.5">
        <i class="fas fa-envelope text-sm w-5 text-center"></i>
        <span>Pesan Masuk</span>
    </div>

    <!-- PENGKONDISIAN JIKA ADA NOTIFIKASI PESAN BELUM DIBACA -->
    @php
        // Mengambil jumlah pesan masuk khusus untuk user ini yang berstatus belum dibaca (is_read = false)
        $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())
                                          ->where('is_read', false)
                                          ->count();
    @endphp

    @if($unreadCount > 0)
        <span class="flex h-5 min-w-[20px] px-1.5 items-center justify-center bg-rose-500 text-white font-black text-[10px] rounded-full animate-pulse shadow-md shadow-rose-500/30">
            {{ $unreadCount }}
        </span>
    @endif
        <a href="{{ route('guide.calendar.index') }}"
       class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
        <i class="fas fa-home text-sm w-5 text-center {{ Request::is('dashboard') ? 'text-white' : 'text-slate-500' }}"></i>
        <span>Jadwal Guide</span>
        </a>
        <a href="{{ route('guide.reviews.index') }}"
       class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
        <i class="fas fa-home text-sm w-5 text-center {{ Request::is('dashboard') ? 'text-white' : 'text-slate-500' }}"></i>
        <span>Ulasan Wisatawan</span>
        </a>
</nav>
    </aside>



    <div class="flex-1 p-6 md:p-8 overflow-y-auto">

        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl font-black text-white uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-star text-amber-400"></i> Ulasan & Reputasi Anda
                </h1>
                <p class="text-xs text-slate-500 mt-1">Dengar langsung masukan jujur dari para wisatawan yang telah Anda pandu.</p>
            </div>

            <div class="bg-[#0d121f] border border-slate-800/60 px-4 py-2.5 rounded-2xl flex items-center gap-3 shadow-xl">
                <div class="w-9 h-9 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400">
                    <i class="fas fa-award text-lg"></i>
                </div>
                <div>
                    <div class="text-[10px] uppercase font-black tracking-wider text-slate-500">Rating Kumulatif</div>
                    <div class="text-sm font-black text-white flex items-center gap-1">
                        {{ number_format($averageRating, 1) }} <span class="text-amber-400">★</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-5 shadow-xl transition-all duration-200 hover:border-slate-700/60">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center font-bold text-xs text-emerald-400 border border-slate-700 uppercase">
                                {{ substr($review->user->name, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-white">{{ $review->user->name }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex text-amber-400 text-xs gap-0.5 bg-amber-500/5 px-2 py-1 rounded-lg border border-amber-500/10">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>

                    <p class="text-xs text-slate-300 mt-3.5 bg-[#111c30]/20 p-3 rounded-xl border border-slate-800/40 italic leading-relaxed">
                        " {{ $review->comment ?? 'Wisatawan tidak meninggalkan komentar teks.' }} "
                    </p>
                </div>
            @empty
                <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-12 text-center shadow-2xl">
                    <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-600 mx-auto mb-3">
                        <i class="fas fa-comment-slash text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider">Belum Ada Ulasan</h3>
                    <p class="text-[11px] text-slate-500 mt-1 max-w-xs mx-auto">Selesaikan trip pemanduan Anda dengan pelayanan terbaik agar mendapatkan ulasan bintang 5 pertama Anda!</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
