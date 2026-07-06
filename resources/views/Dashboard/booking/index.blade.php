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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-800 pb-4 gap-4">
            <div>
                <h1 class="text-lg font-black text-white uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-history text-emerald-500"></i> Riwayat Pemesanan
                </h1>
                <p class="text-xs text-slate-500 mt-1">Daftar eksplorasi perjalanan Anda bersama Ngapak Adventure.</p>
            </div>
            <div class="bg-[#0d121f] border border-slate-800 px-4 py-2 rounded-xl text-xs font-bold text-slate-400">
                Total: <span class="text-emerald-400">{{ isset($myTrips) ? $myTrips->count() : 0 }} Data</span>
            </div>
        </div>

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-xl flex items-center gap-3 text-emerald-400 text-xs font-bold shadow-lg">
                <i class="fas fa-check-circle text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- TABEL RIWAYAT PESANAN -->
        <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#111c30]/50 border-b border-slate-800 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Paket Wisata</th>
                            <th class="px-6 py-4">Tanggal Pelaksanaan</th>
                            <th class="px-6 py-4">Pemandu (Guide)</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Status Sistem</th>
                            <th class="px-6 py-4 text-center">Aksi Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40 text-xs">
                       @forelse($myTrips as $booking)
    <tr class="hover:bg-[#111c30]/20 transition-colors">
        <td class="px-6 py-4">
            <div class="font-bold text-white">Eksplorasi bersama {{ $booking->guide->user->name ?? 'Guide' }}</div>
            <div class="text-[10px] text-slate-500 mt-0.5">ID Booking: #{{ $booking->id }}</div>
        </td>
        <td class="px-6 py-4 text-slate-400">
            <i class="far fa-calendar-alt text-slate-600 mr-1.5"></i>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
        </td>
        <td class="px-6 py-4">
            <span class="inline-flex items-center gap-1.5 text-emerald-400 font-medium">
                <i class="fas fa-user-circle text-slate-500 text-sm"></i> {{ $booking->guide->user->name ?? 'N/A' }}
            </span>
        </td>
                                <td class="px-6 py-4 font-bold text-emerald-400">
                                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold px-2.5 py-0.5 rounded-md uppercase tracking-wider">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Tombol Cetak Dokumen -->
                                        <button class="bg-slate-800 hover:bg-slate-700 text-white p-2 rounded-lg border border-slate-700/50 transition-colors">
                                            <i class="fas fa-print text-xs"></i>
                                        </button>

                                        <!-- TOMBOL ULAS TRIP (MEMAKAI MODAL DATA TARGET) -->
                                        @php
                                            $sudahDiulas = \App\Models\Review::where('booking_id', $booking->id)->exists();
                                        @endphp

                                        @if(!$sudahDiulas)
                                            <button onclick="openModalReview({{ $booking->id }}, '{{ $booking->guide->user->name ?? 'Guide' }}')"
                                                    class="bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[10px] uppercase tracking-wider px-3 py-2 rounded-lg transition-all shadow-md shadow-emerald-500/10">
                                                Ulas Trip
                                            </button>
                                        @else
                                            <span class="text-[11px] text-slate-500 italic font-medium px-2 py-1 bg-slate-800/30 rounded-lg border border-slate-800">Sudah Diulas</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500 italic">
                                    Belum ada data perjalanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- ================= ELEMENT MODAL POP-UP (PREMIUM DARK) ================= -->
<div id="modalReview" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#0d121f] border border-slate-800 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl relative animate-fade-in">

        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <h3 class="text-sm font-black text-white uppercase tracking-wider flex items-center gap-2">
                <i class="fas fa-star text-amber-400"></i> Tulis Ulasan Perjalanan
            </h3>
            <button onclick="closeModalReview()" class="text-slate-500 hover:text-white transition-colors">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <form id="formModalReview" method="POST" class="space-y-4">
            @csrf
            <div>
                <p class="text-[11px] text-slate-400 uppercase tracking-wider font-bold">Pemandu Wisata:</p>
                <p id="modalGuideName" class="text-xs font-black text-white mt-0.5"></p>
            </div>

            <div class="space-y-1.5">
                <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Berikan Bintang Penilaian:</label>
                <select name="rating" required class="w-full bg-[#090d16] border border-slate-700/60 rounded-xl text-xs px-3 py-2.5 text-amber-400 font-bold focus:outline-none focus:border-emerald-500">
                    <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                    <option value="4">⭐⭐⭐⭐ (4 - Puas)</option>
                    <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                    <option value="2">⭐⭐ (2 - Kurang)</option>
                    <option value="1">⭐ (1 - Buruk)</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="text-[11px] text-slate-400 uppercase tracking-wider font-bold block">Tulis Catatan / Komentar:</label>
                <textarea name="comment" rows="3" required class="w-full bg-[#090d16] border border-slate-800 rounded-xl p-3 text-xs text-slate-300 focus:ring-1 focus:ring-emerald-500 focus:outline-none placeholder-slate-600" placeholder="Ceritakan pengalaman seru Anda bersama pemandu ini..."></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-slate-800">
                <button type="button" onclick="closeModalReview()" class="bg-slate-800 hover:bg-slate-700 text-white font-bold text-[10px] px-4 py-2 rounded-xl transition-all uppercase tracking-wider">
                    Batal
                </button>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-black text-[10px] px-4 py-2 rounded-xl transition-all uppercase tracking-wider shadow-md">
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JAVASCRIPT LOGIC UNTUK MODAL TRIGGER -->
<script>
    function openModalReview(bookingId, guideName) {
        const modal = document.getElementById('modalReview');
        const form = document.getElementById('formModalReview');
        const nameText = document.getElementById('modalGuideName');

        // Atur isi teks nama guide dan action rute form secara dinamis
        nameText.innerText = guideName;
        form.action = `/dashboard/reviews/store/${bookingId}`;

        // Munculkan modal
        modal.classList.remove('hidden');
    }

    function closeModalReview() {
        const modal = document.getElementById('modalReview');
        modal.classList.add('hidden');
    }
</script>
@endsection
