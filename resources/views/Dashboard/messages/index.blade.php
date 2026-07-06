@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#090d16] font-sans antialiased text-slate-300">

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

    <div class="w-80 bg-[#0b111e] border-r border-slate-800/60 flex flex-col shrink-0">
        <div class="p-5 border-b border-slate-800/60 bg-[#111c30]/40 flex items-center gap-2">
            <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full shadow-lg shadow-emerald-500/40 animate-pulse"></div>
            <h3 class="text-xs font-black text-white uppercase tracking-wider">Kotak Masuk Pesan</h3>
        </div>

        <div class="flex-1 overflow-y-auto divide-y divide-slate-800/30opp">
            @forelse($activeChats as $chat)
                @php
                    $isMeTourist = ($chat->user_id == Auth::id());
                    $lawanBicara = $isMeTourist ? ($chat->guide->name ?? 'Pemandu Belum Diatur') : ($chat->user->name ?? 'Wisatawan');
                    $subText = $isMeTourist ? 'Personal Guide Anda' : 'Pelanggan Trip';
                @endphp

                <a href="{{ route('messages.index', ['booking_id' => $chat->id]) }}"
                   class="flex items-start gap-3.5 p-4 transition-all duration-150 hover:bg-slate-800/30 {{ ($currentChat && $currentChat->id == $chat->id) ? 'bg-slate-800/50 border-l-4 border-emerald-500' : '' }}">

                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-xs uppercase shadow-md shadow-emerald-500/20 shrink-0">
                        {{ substr($lawanBicara, 0, 2) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-white truncate">{{ $lawanBicara }}</h4>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-0.5 truncate font-medium">Trip ID: #{{ $chat->id }}</p>
                        <span class="inline-block mt-1 text-[9px] px-2 py-0.5 bg-slate-900/60 border border-slate-800 text-emerald-400 rounded-md font-bold uppercase tracking-wider">
                            {{ $subText }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-slate-500 font-bold text-[10px] uppercase tracking-widest py-16">
                    <i class="fas fa-comments text-2xl mb-3 block text-slate-700"></i>
                    Belum ada riwayat obrolan trip
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex-1 flex flex-col bg-[#090d16]">
        @if($currentChat)
            @php
                $isMeTourist = ($currentChat->user_id == Auth::id());
                $namaLawan = $isMeTourist ? ($currentChat->guide->name ?? 'Personal Guide') : ($currentChat->user->name ?? 'Wisatawan');
            @endphp

            <div class="px-6 py-4 bg-[#0d121f]/90 backdrop-blur-md border-b border-slate-800/50 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-black text-white uppercase tracking-wider">{{ $namaLawan }}</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Koordinasi Perjalanan Lapangan untuk Booking ID #{{ $currentChat->id }}</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/dashboard/bookings"
                       class="flex items-center gap-2 px-3.5 py-1.5 bg-slate-800/80 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-700/50 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all active:scale-95">
                        <i class="fas fa-arrow-left text-[9px]"></i>
                        <span>Kembali</span>
                    </a>

                    <span class="text-[9px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-1.5 rounded-xl font-black uppercase tracking-wider">
                        Terhubung
                    </span>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-[#0a0f1a]">
                @forelse($messages as $msg)
                    @php $isSenderMe = ($msg->sender_id == Auth::id()); @endphp

                    <div class="flex {{ $isSenderMe ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[65%]">
                            <div class="p-3.5 rounded-2xl text-xs font-semibold tracking-wide leading-relaxed shadow-md
                                {{ $isSenderMe ? 'bg-emerald-500 text-white rounded-tr-none shadow-emerald-500/10' : 'bg-[#0d121f] text-slate-200 border border-slate-800/60 rounded-tl-none' }}">
                                {{ $msg->message }}
                            </div>
                            <span class="block text-[9px] text-slate-500 mt-1.5 font-medium {{ $isSenderMe ? 'text-right' : 'text-left' }}">
                                {{ $msg->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center text-slate-600 font-bold text-[10px] uppercase tracking-widest py-24">
                        <i class="far fa-paper-plane text-2xl mb-3 text-slate-700 animate-bounce"></i>
                        Ketik pesan di bawah untuk memulai obrolan langsung!
                    </div>
                @endforelse
            </div>

            <div class="p-4 bg-[#0d121f] border-t border-slate-800/60">
                <form action="{{ route('messages.send') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $currentChat->id }}">
                    <input type="text" name="message" required autocomplete="off"
                           placeholder="Ketik pesan koordinasi meeting point atau jadwal di sini..."
                           class="flex-1 bg-[#090d16] border border-slate-800/80 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 font-semibold transition-all">
                    <button type="submit" class="px-5 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-xs uppercase tracking-wider rounded-xl transition-all shadow-md shadow-emerald-500/20 flex items-center gap-2 active:scale-95">
                        <span>Kirim</span>
                        <i class="fas fa-paper-plane text-[10px]"></i>
                    </button>
                </form>
            </div>
        @else
            <div class="flex-1 flex flex-col items-center justify-center text-slate-500 font-bold text-[10px] uppercase tracking-widest">
                <i class="fas fa-comments text-4xl mb-4 text-slate-800 animate-pulse"></i>
                Silakan pilih salah satu daftar trip aktif di sebelah kiri untuk memulai pesan
            </div>
        @endif
    </div>
</div>
@endsection
