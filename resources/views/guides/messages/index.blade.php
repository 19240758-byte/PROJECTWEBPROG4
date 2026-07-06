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
<div class="min-h-screen bg-[#090d16] font-sans antialiased text-slate-300 pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-[calc(100vh-12rem)] flex gap-6">

        <div class="w-80 bg-[#0d121f] rounded-2xl border border-slate-800/60 p-4 flex flex-col overflow-y-auto shrink-0 shadow-xl">
            <h3 class="text-xs font-black text-white uppercase tracking-wider mb-4 px-2 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Percakapan Aktif
            </h3>
            <div class="space-y-2">
                @foreach($recentChats as $chat)
                    <a href="{{ route('guide.messages.index', ['booking_id' => $chat->booking_id]) }}"
                       class="flex items-center gap-3 p-3 rounded-xl border transition-all {{ $activeBookingId == $chat->booking_id ? 'bg-emerald-500/10 border-emerald-500/30 text-white' : 'bg-[#111c30]/40 border-transparent hover:bg-[#111c30] hover:border-slate-800' }}">
                        <div class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center font-bold text-xs text-emerald-400 border border-slate-700 uppercase">
                            {{ substr($chat->tourist_name, 0, 2) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-xs truncate">{{ $chat->tourist_name }}</div>
                            <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $chat->last_message }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex-1 bg-[#0d121f] rounded-2xl border border-slate-800/60 flex flex-col overflow-hidden shadow-2xl">
            @if($activeBooking)
                <div class="px-6 py-4 border-b border-slate-800/50 bg-[#111c30]/50 flex items-center justify-between">
                    <div>
                        <div class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Koneksi Pemandu</div>
                        <h4 class="text-sm font-black text-white mt-0.5">{{ $activeBooking->user->name }}</h4>
                    </div>
                    <div class="text-right">
                        <span class="px-2.5 py-1 bg-slate-800 text-slate-400 font-bold text-[10px] rounded-md border border-slate-700">
                            Trip: {{ $activeBooking->booking_date->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-[#090d16]/20">
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[65%] rounded-2xl px-4 py-2.5 text-xs shadow-md
                                {{ $msg->sender_id === auth()->id() ? 'bg-emerald-600 text-white rounded-tr-none' : 'bg-[#111c30] text-slate-200 border border-slate-800/80 rounded-tl-none' }}">
                                <p class="leading-relaxed break-words">{{ $msg->message }}</p>
                                <span class="block text-[9px] text-right mt-1 opacity-50">{{ $msg->created_at->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 border-t border-slate-800/60 bg-[#111c30]/30">
                    <form action="{{ route('guide.messages.store') }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $activeBooking->id }}">
                        <input type="text" name="message" required autofocus autocomplete="off"
                               placeholder="Ketik pesan instruksi koordinasi ke wisatawan..."
                               class="flex-1 bg-[#090d16] border border-slate-800 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <button type="submit" class="px-6 bg-[#ea580c] hover:bg-[#c2410c] text-white font-black text-xs uppercase tracking-wider rounded-xl transition-all active:scale-95 shadow-lg shadow-orange-600/10">
                            KIRIM
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center bg-[#090d16]/10">
                    <div class="text-4xl p-4 bg-[#111c30] rounded-2xl border border-slate-800 mb-4 animate-bounce">💬</div>
                    <h4 class="text-xs font-black text-white uppercase tracking-wider">Ruang Komunikasi Lapangan</h4>
                    <p class="text-[11px] text-slate-500 mt-1.5 max-w-xs mx-auto leading-relaxed">
                        Silakan pilih nama wisatawan di panel kiri atau klik tombol <strong class="text-emerald-400">"BALAS CHAT"</strong> di dashboard utama untuk memulai koordinasi.
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
