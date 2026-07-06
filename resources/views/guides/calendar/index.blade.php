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

        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-xl font-black text-white uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-emerald-500"></i> Kalender Agenda Kerja
                </h1>
                <p class="text-xs text-slate-500 mt-1">Pantau tanggal pelaksanaan trip biar jadwal memandumu tidak bentrok.</p>
            </div>

            <div class="flex items-center gap-4 bg-[#0d121f] px-4 py-2 rounded-xl border border-slate-800 text-[11px] font-semibold">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-md bg-emerald-500 shadow-md shadow-emerald-500/20"></span>
                    <span class="text-slate-400">Trip Disetujui</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-md bg-teal-500 shadow-md shadow-teal-500/20"></span>
                    <span class="text-slate-400">Selesai (Completed)</span>
                </div>
            </div>
        </div>

        <div class="bg-[#0d121f] rounded-2xl border border-slate-800/60 p-6 shadow-2xl">
            <div id="calendar" class="text-sm text-slate-200"></div>
        </div>

    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<style>
    /* Kustomisasi Tema Gelap FullCalendar biar klop dengan Emerald & Dark Navy */
    .fc { --fc-border-color: #1e293b; --fc-page-bg-color: #0d121f; }
    .fc .fc-toolbar-title { font-size: 14px !important; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; }
    .fc .fc-button-primary { bg-color: #1e293b; border-color: #334155; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .fc .fc-button-primary:hover { background-color: #10b981 !important; border-color: #10b981 !important; }
    .fc .fc-button-active { background-color: #059669 !important; border-color: #059669 !important; }
    .fc th { background-color: #111c30; padding: 10px 0 !important; font-size: 11px; font-weight: 800; text-transform: uppercase; color: #94a3b8; }
    .fc-theme-standard td, .fc-theme-standard th { border: 1px solid #1e293b !important; }
    .fc-event { padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; border: none !important; cursor: pointer; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Mengambil data PHP array events yang di-passing dari CalendarController
        var bookingEvents = @json($events);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id', // Set bahasa Indonesia
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            // Mapping warna event berdasarkan status bookingan
            events: bookingEvents.map(function(item) {
                return {
                    title: item.title,
                    start: item.start,
                    backgroundColor: item.status === 'completed' ? '#14b8a6' : '#10b981', // Teal jika completed, Emerald jika approved
                    extendedProps: {
                        location: item.location
                    }
                };
            }),
            eventClick: function(info) {
                alert(info.event.title + '\nLokasi: ' + info.event.extendedProps.location + '\nTanggal: ' + info.event.start.toLocaleDateString('id-ID'));
            }
        });

        calendar.render();
    });
</script>
@endsection
