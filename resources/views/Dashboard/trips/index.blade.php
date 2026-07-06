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
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- HEADER -->
        <header class="bg-[#0d121f]/80 backdrop-blur-md sticky top-0 z-20 border-b border-slate-800/50 px-8 py-5">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="text-sm font-black text-white uppercase tracking-wider">Arsip Riwayat Perjalanan</h2>
                    <p class="text-slate-400 text-[11px] font-medium mt-0.5">Kelola informasi seluruh petualangan, cetak nota transaksi, dan berikan ulasan layanan.</p>
                </div>
            </div>
        </header>

        <!-- CONTAINER CONTENT -->
        <div class="max-w-7xl w-full mx-auto px-8 py-8 space-y-6">

            <!-- PREMIUM TABLE CARD -->
            <div class="bg-[#0e1626]/70 backdrop-blur-md rounded-2xl border border-slate-800/60 shadow-xl overflow-hidden">
                <!-- PANEL HEADER -->
                <div class="p-6 border-b border-slate-800/60 flex items-center justify-between bg-[#111c30]/40">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full shadow-lg shadow-emerald-500/40 animate-pulse"></div>
                        <h3 class="text-xs font-black text-white uppercase tracking-wider">DAFTAR EKSPLORASI ANDA</h3>
                    </div>
                    <span class="text-[10px] bg-slate-800/80 text-slate-400 font-bold px-3 py-1 rounded-full border border-slate-700/40">
                        Total: {{ $myTrips->count() }} Data
                    </span>
                </div>

                <!-- TABLE WRAPPER -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-slate-800/80 text-slate-400 text-[10px] font-black uppercase tracking-widest bg-[#0b111e]/90">
                                <th class="py-4.5 px-6">Paket Wisata</th>
                                <th class="py-4.5 px-5">Tanggal Pelaksanaan</th>
                                <th class="py-4.5 px-5">Pemandu (Guide)</th>
                                <th class="py-4.5 px-5">Total Biaya</th>
                                <th class="py-4.5 px-5 text-center">Status Sistem</th>
                                <th class="py-4.5 px-6 text-right">Aksi Dokumen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/30 font-semibold">
                            @forelse($myTrips as $trip)
                                @php
                                    $statusText = strtoupper($trip->status ?? 'APPROVED');
                                @endphp
                                <tr class="hover:bg-slate-800/30 transition-all duration-150">

                                    <!-- 1. PAKET WISATA -->
                                    <td class="py-5 px-6">
                                        <div class="font-bold text-white text-sm tracking-tight">
                                            @if($trip->destination && $trip->destination->name)
                                                {{ $trip->destination->name }}
                                            @elseif($trip->guide && $trip->guide->name)
                                                Eksplorasi bersama {{ $trip->guide->name }}
                                            @else
                                                Ngapak Adventure Trip
                                            @endif
                                        </div>
                                        <span class="text-[10px] text-slate-500 font-medium block mt-0.5">ID Booking: #{{ $trip->id }}</span>
                                    </td>

                                    <!-- 2. TANGGAL PELAKSANAAN -->
                                    <td class="py-5 px-5 text-slate-300 font-medium">
                                        <div class="flex items-center gap-2">
                                            <i class="far fa-calendar text-slate-500 text-[11px]"></i>
                                            <span>{{ \Carbon\Carbon::parse($trip->booking_date ?? now())->translatedFormat('d M Y') }}</span>
                                        </div>
                                    </td>

                                    <!-- 3. PEMANDU (GUIDE) -->
                                    <td class="py-5 px-5">
                                        @if($trip->guide && $trip->guide->name)
                                            <div class="flex items-center gap-2 text-emerald-400 font-medium">
                                                <div class="w-5 h-5 bg-emerald-500/10 rounded-md flex items-center justify-center text-[10px]">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <span class="truncate max-w-[150px]">{{ $trip->guide->name }}</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                                <i class="fas fa-user-slash text-[11px]"></i>
                                                <span>Belum Diatur</span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- 4. TOTAL BIAYA -->
                                    <td class="py-5 px-5 font-bold text-emerald-400 text-sm">
                                        @php
                                            $nominalUang = $trip->guide_cost ?? 0;
                                        @endphp
                                        @if($nominalUang > 0)
                                            Rp{{ number_format($nominalUang, 0, ',', '.') }}
                                        @else
                                            <span class="text-slate-500 text-xs font-normal italic">Free / Belum Diisi</span>
                                        @endif
                                    </td>

                                    <!-- 5. STATUS SISTEM -->
                                    <td class="py-5 px-5 text-center">
                                        @if($statusText == 'APPROVED' || $statusText == 'SELESAI' || $statusText == 'SUKSES')
                                            <span class="inline-flex items-center gap-1.5 text-[9px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-1 rounded-md font-black uppercase tracking-wider">
                                                <span class="w-1 h-1 bg-emerald-400 rounded-full animate-pulse"></span>
                                                {{ $statusText }}
                                            </span>
                                        @elseif($statusText == 'PENDING' || $statusText == 'PROCESS')
                                            <span class="inline-flex items-center gap-1.5 text-[9px] bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2.5 py-1 rounded-md font-black uppercase tracking-wider">
                                                <span class="w-1 h-1 bg-amber-400 rounded-full"></span>
                                                DIPROSES
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-[9px] bg-red-500/10 text-red-400 border border-red-500/20 px-2.5 py-1 rounded-md font-black uppercase tracking-wider">
                                                <span class="w-1 h-1 bg-red-400 rounded-full"></span>
                                                {{ $statusText }}
                                            </span>
                                        @endif
                                    </td>

                                    <!-- 6. AKSI DOKUMEN -->
                                    <td class="py-5 px-6 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <!-- Tombol Cetak -->
                                            <button class="w-8 h-8 bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg transition-all flex items-center justify-center border border-slate-700/45" title="Cetak Nota">
                                                <i class="fas fa-print text-xs"></i>
                                            </button>

                                          <!-- Tombol Ulas menggunakan Tag A HREF (Sesuaikan jika perulanganmu bernama $trip) -->
@if($statusText == 'APPROVED' || $statusText == 'SELESAI' || $statusText == 'SUKSES')
    @php
        // Ganti $booking->id menjadi $trip->id sesuai variabel perulangan tabelmu
        $sudahDiulas = \App\Models\Review::where('booking_id', $trip->id)->exists();
    @endphp

    @if(!$sudahDiulas)
        <a href="{{ route('tourist.booking.index') }}?booking_id={{ $trip->id }}"
           class="inline-block px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-black uppercase tracking-wider rounded-lg transition-all shadow-md shadow-emerald-500/20 active:scale-95 text-center">
            Ulas Trip
        </a>
    @else
        <span class="inline-block px-3 py-1.5 bg-slate-800 text-slate-500 text-[10px] font-black uppercase tracking-wider rounded-lg border border-slate-700/50 text-center">
            Sudah Diulas
        </span>
    @endif
@else
    <button class="px-3 py-1.5 bg-slate-850 text-slate-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-slate-800/80 cursor-not-allowed" disabled>
        Terkunci
    </button>
@endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-20 text-center text-slate-500 font-bold uppercase tracking-widest text-[10px]">
                                        <i class="fas fa-folder-open text-2xl mb-3 block text-slate-700"></i>
                                        Belum ada riwayat transaksi pemesanan trip
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
