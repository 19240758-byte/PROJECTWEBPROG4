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

    <a href="{{ route('trips.index') }}"
       class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all {{ Request::is('dashboard/trips') || Request::is('dashboard/reviews') ? 'bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 font-semibold' }}">
        <i class="fas fa-route text-sm w-5 text-center {{ Request::is('trips.index') || Request::is('dashboard/reviews') ? 'text-amber-300' : 'text-slate-500' }}"></i>
        <span>Riwayat Pemesanan</span>
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
</a>
    <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-xl font-semibold text-xs uppercase tracking-wider transition-all">
        <i class="fas fa-user-circle text-sm w-5 text-center text-slate-500"></i>
        <span>Profil</span>
    </a>
    <a href="{{ route ('tourist.reviews.index')}}" class="flex items-center gap-3.5 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-xl font-semibold text-xs uppercase tracking-wider transition-all">
        <i class="fas fa-user-circle text-sm w-5 text-center text-slate-500"></i>
        <span>Ulasan</span>
    </a>
</nav>
    </aside>

    <main class="flex-1 overflow-y-auto relative z-10">

        <header class="bg-gray-950/40 backdrop-blur-md sticky top-0 z-20 border-b border-white/5 px-8 py-5">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-black text-white tracking-tight">Beranda</h2>
                    <p class="text-gray-400 text-xs font-light mt-0.5">Selamat datang kembali, {{ auth()->user()->name }}!</p>
                </div>
                <div class="flex items-center gap-6">
                    <button class="relative text-gray-400 hover:text-emerald-400 transition-colors">
                        <i class="far fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    </button>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden md:block">
                            <p class="text-xs font-black text-white leading-none">{{ auth()->user()->name }}</p>
                            <span class="text-[9px] font-black text-emerald-400 uppercase tracking-wider mt-0.5 block">Tourist</span>
                        </div>
                        <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?background=059669&color=fff&name='.urlencode(auth()->user()->name) }}"
                             class="w-9 h-9 rounded-xl object-cover border border-white/10" alt="Profile">
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-8 py-10 space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-xl shadow-2xl">
                        <h3 class="text-sm font-black text-emerald-400 uppercase tracking-widest mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                            Paket Mendatang
                        </h3>

                        @php
                            $upcoming = $bookings->whereIn('status', ['approved', 'disetujui'])
                                                 ->sortByDesc('id')
                                                 ->first();
                        @endphp

                        @if($upcoming)
                        <div class="group relative bg-white/[0.01] border border-white/5 rounded-3xl p-6 transition-all hover:border-white/10">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="relative w-full md:w-56 h-40 overflow-hidden rounded-2xl bg-gray-900 border border-white/5 shadow-md">
                                    @if($upcoming->destination && $upcoming->destination->photo)
                                        <img src="{{ Storage::url($upcoming->destination->photo) }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                             alt="{{ $upcoming->destination->name }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-700">
                                            <i class="fas fa-image text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 flex flex-col justify-between py-1">
                                    <div>
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="px-2 py-0.5 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[9px] font-black rounded-md uppercase tracking-wider">
                                                Dikonfirmasi
                                            </span>
                                        </div>

                                        <h4 class="text-xl font-black text-white tracking-wide">
                                            {{ $upcoming->destination->name ?? 'Destinasi Belum Diatur' }}
                                        </h4>

                                        <div class="flex flex-col sm:flex-row sm:items-center gap-x-6 gap-y-2 mt-4 text-xs text-gray-400 font-light">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-user-tie text-emerald-400 text-[11px]"></i>
                                                <span class="font-medium">{{ $upcoming->guide->name ?? 'Tanpa Pemandu' }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar-alt text-emerald-400 text-[11px]"></i>
                                                <span class="font-medium">
                                                    {{ \Carbon\Carbon::parse($upcoming->booking_date)->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex flex-wrap items-center justify-between border-t border-white/5 pt-4 gap-4">
                                        <div>
                                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Total Pembayaran</p>
                                            <p class="text-xl font-black text-emerald-400 mt-0.5">
                                                Rp{{ number_format($upcoming->total_cost, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('incomes.print', $upcoming->id) }}" target="_blank" class="p-3 bg-white/5 border border-white/10 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all">
                                                <i class="fas fa-print text-xs"></i>
                                            </a>
                                            <button class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black rounded-xl transition-all uppercase tracking-wider border border-emerald-500/20 shadow-lg shadow-emerald-950/40">
                                                Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="py-12 flex flex-col items-center justify-center bg-white/[0.01] rounded-3xl border border-dashed border-white/10">
                            <i class="fas fa-map-marked-alt text-3xl text-gray-700 mb-3"></i>
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-[10px]">Belum ada petualangan aktif</p>
                        </div>
                        @endif
                    </div>

                    <div class="bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-xl shadow-2xl">
                        <h3 class="text-sm font-black text-emerald-400 uppercase tracking-widest mb-6 flex items-center gap-3">
                            <i class="fas fa-history text-xs"></i>
                            Riwayat Pemesanan
                        </h3>
                        <div class="overflow-x-auto text-xs">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-[9px] font-black uppercase tracking-[0.15em] text-gray-400 border-b border-white/10">
                                        <th class="pb-4">Paket Wisata</th>
                                        <th class="pb-4">Tanggal</th>
                                        <th class="pb-4 text-right">Biaya</th>
                                        <th class="pb-4 text-center">Status & Nota</th>
                                        <th class="pb-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-gray-300">
                                    @foreach($bookings->take(5) as $book)
                                    <tr class="group hover:bg-white/[0.01] transition-colors">
                                        <td class="py-4 font-bold text-white group-hover:text-emerald-400 transition-colors">{{ $book->destination->name ?? 'Wisata Alam' }}</td>
                                        <td class="py-4 font-light text-gray-400">
                                            {{ \Carbon\Carbon::parse($book->booking_date)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-4 text-right font-extrabold text-emerald-400">Rp{{ number_format($book->total_cost, 0, ',', '.') }}</td>
                                        <td class="py-4 text-center">
                                            <div class="flex items-center justify-center gap-3">
                                                <span class="px-2 py-0.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold text-[9px] uppercase rounded-md tracking-wider">
                                                    {{ $book->status == 'approved' ? 'Selesai' : $book->status }}
                                                </span>
                                                @if($book->status == 'approved')
                                                <a href="{{ route('incomes.print', $book->id) }}" target="_blank" class="w-6 h-6 flex items-center justify-center bg-white/5 border border-white/10 text-gray-400 rounded-lg hover:text-emerald-400 hover:border-emerald-500/40 transition-all shadow-sm" title="Cetak Nota">
                                                    <i class="fas fa-print text-[9px]"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 text-right">
                                            <button class="text-gray-600 group-hover:text-emerald-400 transform group-hover:translate-x-0.5 transition-all">
                                                <i class="fas fa-chevron-right text-[10px]"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">

                    <div class="bg-white/[0.02] border border-white/10 p-8 rounded-[2.5rem] backdrop-blur-xl relative overflow-hidden shadow-2xl">
                        <h3 class="text-sm font-black text-white mb-6 italic tracking-wide">Ringkasan Eksplorasi</h3>
                        <div class="space-y-4">
                            @foreach([
                                ['Total Booking', $bookings->count(), 'text-white bg-white/5'],
                                ['Trip Selesai', $bookings->where('status', 'approved')->count(), 'text-emerald-400 bg-emerald-500/5'],
                                ['Dibatalkan', $bookings->where('status', 'cancelled')->count(), 'text-red-400 bg-red-500/5']
                            ] as $stat)
                            <div class="flex justify-between items-center p-4 rounded-2xl border border-white/5 bg-white/[0.01]">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $stat[0] }}</span>
                                <span class="text-lg font-black px-2.5 py-0.5 rounded-lg {{ $stat[2] }} border border-white/5">{{ $stat[1] }}</span>
                            </div>
                            @endforeach

                            <div class="pt-5 border-t border-white/10">
                                <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                                <p class="text-2xl font-black text-emerald-400 tracking-wide">Rp{{ number_format($bookings->sum('total_cost'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @foreach([
                            ['Cari Guide', 'fas fa-search-location', '/guides'],
                            ['Sewa Alat', 'fas fa-campground', '/equipments'],
                            ['Paket Wisata', 'fas fa-map-marked-alt', '/destinations'],
                            ['Bantuan', 'fas fa-headset', '#']
                        ] as $quick)
                        <a href="{{ $quick[2] }}" class="flex items-center justify-between p-4 bg-white/[0.01] border border-white/10 rounded-2xl hover:border-emerald-500/40 hover:bg-white/5 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white/5 text-gray-400 border border-white/5 rounded-xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white group-hover:border-transparent transition-all shadow-md">
                                    <i class="{{ $quick[1] }} text-xs"></i>
                                </div>
                                <span class="text-xs font-black text-gray-300 uppercase tracking-widest group-hover:text-white transition-colors">{{ $quick[0] }}</span>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] text-gray-600 group-hover:text-emerald-400 transform group-hover:translate-x-0.5 transition-all"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
@endsection
