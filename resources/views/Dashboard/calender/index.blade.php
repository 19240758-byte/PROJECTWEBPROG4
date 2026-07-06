@extends('layouts.app')

@section('content')
<div class="flex h-[calc(100vh-4rem)] bg-[#090d16] font-sans antialiased text-slate-300">

    <!-- KOLOM 1: SIDEBAR MENU UTAMA KHUSUS GUIDE (Paling Kiri) -->
    <div class="w-64 bg-[#0d121f] border-r border-slate-800/60 flex flex-col justify-between p-4 shrink-0">
        <div class="space-y-1">
            <div class="px-4 py-3 mb-4 bg-[#111c30]/40 rounded-xl border border-slate-800/50">
                <p class="text-[10px] text-emerald-400 font-black uppercase tracking-widest">Akun Terverifikasi</p>
                <h5 class="text-xs font-bold text-white truncate mt-0.5">{{ auth()->user()->name }}</h5>
            </div>


            <!-- Menu Jadwal Kalender Aktif -->
            <a href="{{ route('dashboard.calender.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition-all bg-emerald-500 text-white font-bold shadow-md shadow-emerald-500/10">
                <i class="fas fa-calendar-alt text-sm w-5 text-center"></i>
                <span>Jadwal Kalender</span>
            </a>

        </div>
    </div>

    <!-- AREA UTAMA KALENDER (Kolom Tengah & Kanan) -->
    <div class="flex-1 flex flex-col bg-[#090d16] overflow-y-auto">
        <!-- Header -->
        <div class="px-8 py-5 bg-[#0d121f]/90 backdrop-blur-md border-b border-slate-800/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sticky top-0 z-10">
            <div>
                <h1 class="text-xs font-black text-white uppercase tracking-wider">Kalender Sinkronisasi Trip</h1>
                <p class="text-[10px] text-slate-400 mt-0.5">Pantau plot waktu kosong dan jadwal reservasi wisatawan yang telah disetujui</p>
            </div>
            <!-- Indikator Warna -->
            <div class="flex items-center gap-4 bg-[#111c30]/60 px-4 py-2 rounded-xl border border-slate-800/80 text-[10px] uppercase font-bold tracking-wider">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 bg-amber-500 rounded-md block"></span>
                    <span class="text-slate-400">Menunggu</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-md block"></span>
                    <span class="text-emerald-400">Disetujui (Booked)</span>
                </div>
            </div>
        </div>

        <!-- Wadah Utama Dokumen Kalender -->
        <div class="p-8">
            <div class="bg-[#0d121f] p-6 rounded-2xl border border-slate-800/60 shadow-xl">
                <!-- Target Element FullCalendar -->
                <div id="guideCalendar" class="p-2 text-xs"></div>
            </div>
        </div>
    </div>
</div>

<!-- INJECT CDN FULLCALENDAR & CUSTOM CSS OVERRIDE -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<style>
    /* Custom Styling agar FullCalendar masuk ke tema Deep Dark & Emerald */
    .fc { color: #cbd5e1 !important; }
    .fc .fc-toolbar-title { font-size: 14px !important; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; }
    .fc .fc-button-primary { bg-color: #1e293b !important; border-color: #334155 !important; font-size: 11px !important; font-weight: bold; text-transform: uppercase; border-radius: 8px !important; }
    .fc .fc-button-primary:hover { bg-color: #059669 !important; border-color: #059669 !important; }
    .fc .fc-button-active { bg-color: #10b981 !important; border-color: #10b981 !important; }
    .fc-theme-standard td, .fc-theme-standard th { border: 1px solid rgba(51, 65, 85, 0.4) !important; }
    .fc .fc-col-header-cell-cushion { color: #94a3b8 !important; font-size: 10px; font-weight: 800; text-transform: uppercase; }
    .fc .fc-daygrid-day-number { color: #cbd5e1; font-weight: 600; padding: 6px !important; font-size: 11px; }
    .fc .fc-daygrid-day.fc-day-today { bg-color: rgba(16, 185, 129, 0.04) !important; }
    .fc-event { border: none !important; padding: 2px 4px !important; border-radius: 4px !important; font-size: 9px !important; font-weight: bold; cursor: pointer; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('guideCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            // Load Otomatis Data Dari Endpoint JSON Laravel
            events: "{{ route('guide.calendar.events') }}",
            eventClick: function(info) {
                // Menampilkan detail singkat saat event di dalam kotak kalender diklik
                alert('Detail Trip Wisatawan:\n' + info.event.title + '\nJam: ' + info.event.extendedProps.waktu);
            }
        });
        calendar.render();
    });
</script>
@endsection
