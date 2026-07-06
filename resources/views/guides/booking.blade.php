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

<!-- Menambahkan padding top (pt-24) agar konten turun dan tidak kehalang navbar utama -->
<div class="min-h-screen bg-[#090d16] font-sans antialiased text-slate-300 pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- HEADER DASHBOARD UTAMA -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-800/60 pb-6 gap-4">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight uppercase">Dashboard Guide</h1>
                <p class="text-xs text-slate-400 mt-1">Kelola reservasi perjalanan, data wisatawan, dan monitoring honor pemandu</p>
            </div>

            <!-- WIDGET RINGKASAN PENDAPATAN (Gaya Minimalis Mengikuti Gambar Lama) -->
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl shadow-emerald-500/10 min-w-[240px] text-right">
                <div class="text-xs font-bold opacity-80 uppercase tracking-wider mb-0.5">Pendapatan Bulan Ini</div>
                <div class="text-2xl font-black tracking-tight">Rp{{ number_format($monthlyIncome ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- REKAP LAPORAN BULANAN & ACTION FILTER -->
        <div class="bg-[#0d121f] rounded-2xl border border-slate-800/80 p-6 shadow-xl">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <span class="text-xl">📊</span>
                    <h2 class="text-sm font-black text-white uppercase tracking-wider">Laporan Pendapatan</h2>
                </div>

                <!-- Form Filter & Cetak PDF -->
                <form method="GET" action="{{ route('guide.bookings') }}" class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <div class="flex items-center gap-2 bg-[#111c30] p-1.5 rounded-xl border border-slate-800 w-full sm:w-auto justify-between sm:justify-start">
                        <input type="month" name="month" value="{{ request('month', now()->format('Y-m')) }}"
                               class="bg-[#090d16] border border-slate-800/80 px-3 py-1.5 rounded-lg text-xs text-white font-bold focus:outline-none focus:border-emerald-500">

                        <button type="submit" class="px-5 py-1.5 bg-[#1e293b] hover:bg-slate-700 text-white font-black text-xs uppercase tracking-wider rounded-lg transition-all active:scale-95">
                            FILTER
                        </button>
                    </div>

                    <!-- TOMBOL CETAK PDF ORANGE (IKONIK) -->
                    <a href="{{ route('guide.income.export_pdf', ['month' => request('month', now()->format('Y-m'))]) }}"
                       class="flex items-center justify-center gap-2 px-6 py-3 bg-[#ea580c] hover:bg-[#c2410c] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-orange-600/20 transition-all active:scale-95 w-full sm:w-auto">
                        <i class="fas fa-file-pdf text-sm"></i>
                        <span>DOWNLOAD PDF</span>
                    </a>
                </form>
            </div>
        </div>

        <!-- TABEL DAFTAR KONTRAK EKSPLORASI -->
        <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 bg-[#111c30]/80 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            <th class="px-6 py-4.5">Pelanggan</th>
                            <th class="px-6 py-4.5">Tanggal</th>
                            <th class="px-6 py-4.5">Durasi</th>
                            <th class="px-6 py-4.5 text-right">Biaya</th>
                            <th class="px-6 py-4.5 text-center">Status</th>
                            <th class="px-6 py-4.5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-[#111c30]/30 transition-all group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white group-hover:text-emerald-400 transition-colors">{{ $booking->user->name }}</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">{{ $booking->user->phone }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-300">
                                <div>{{ $booking->booking_date->format('d M Y') }}</div>
                                @if($booking->start_time && $booking->end_time)
                                <div class="text-[11px] text-slate-500 mt-0.5">
                                    {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-blue-400 font-semibold">{{ $booking->duration_hours }} jam</span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-emerald-500 text-sm">
                                Rp{{ number_format($booking->guide_cost, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @switch($booking->status)
                                    @case('pending')
                                        <span class="px-3 py-1 bg-amber-500/10 border border-amber-500/20 text-amber-400 rounded-full text-[11px] font-medium">Menunggu</span>
                                        @break
                                    @case('approved')
                                        <span class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-full text-[11px] font-medium">disetujui</span>
                                        @break
                                    @case('rejected')
                                        <span class="px-3 py-1 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-full text-[11px] font-medium">Ditolak</span>
                                        @break
                                    @case('completed')
                                        <span class="px-3 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-full text-[11px] font-medium">Selesai</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('guide.bookings.approve', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-emerald-400 hover:text-emerald-300 font-bold tracking-wide">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('guide.bookings.reject', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-rose-400 hover:text-rose-300 font-bold tracking-wide" onclick="return confirm('Tolak booking?')">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('messages.index', ['booking_id' => $booking->id]) }}" class="flex items-center gap-1.5 text-slate-400 hover:text-emerald-400 font-bold tracking-wide transition-colors">
                                            <i class="fas fa-comment-dots text-xs"></i> BALAS CHAT
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="text-3xl mb-2">📭</div>
                                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Belum Ada Agenda Booking</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Seluruh data pesanan eksplorasi lapangan dari wisatawan akan muncul di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION BAR -->
            @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-800 bg-[#111c30]/30 text-xs">
                {{ $bookings->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
