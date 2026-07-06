@extends('layouts.app')

@section('content')
<div class="bg-gray-950 text-white min-h-screen font-sans antialiased py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

    <div class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-emerald-600/10 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10">

        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-emerald-400 border border-white/5 bg-white/[0.02] hover:bg-white/5 px-4 py-2 rounded-xl backdrop-blur-sm transition-all mb-8 group">
            <span class="transform group-hover:-translate-x-1 transition-transform inline-block">←</span> Kembali
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-7 w-full">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl bg-gray-900 group/hero">
                    <img src="{{ Storage::url($destination->photo) }}"
                         class="w-full h-[350px] sm:h-[500px] object-cover transform group-hover/hero:scale-[1.02] transition-transform duration-1000"
                         alt="{{ $destination->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent"></div>

                    <div class="absolute bottom-6 left-6 right-6 lg:hidden">
                        <span class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-[10px] font-bold uppercase tracking-widest backdrop-blur-md mb-2 inline-block">
                            Wisata Alam Banyumas
                        </span>
                        <h1 class="text-3xl font-black text-white drop-shadow-md">
                            {{ $destination->name }}
                        </h1>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 w-full flex flex-col gap-6">

                <div class="rounded-[2.5rem] border border-white/10 bg-gradient-to-b from-white/10 to-white/[0.02] backdrop-blur-xl p-6 sm:p-8 shadow-2xl">

                    <div class="hidden lg:block mb-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold tracking-widest uppercase mb-3">
                            <i class="fas fa-map-marked-alt"></i> Jelajah Banyumas
                        </span>
                        <h1 class="text-4xl font-black text-white tracking-tight leading-tight">
                            {{ $destination->name }}
                        </h1>
                    </div>

                    <div class="border-t lg:border-t-0 border-white/10 pt-4 lg:pt-0">
                        <h3 class="text-xs uppercase tracking-widest text-gray-400 font-extrabold mb-3 flex items-center gap-2">
                            <span class="w-1.5 h-3 bg-emerald-500 rounded-full"></span> Tentang Destinasi
                        </h3>
                        <p class="text-sm text-gray-300 font-light leading-relaxed mb-6">
                            Destinasi ini menyuguhkan panorama alam eksotis khas lereng Gunung Slamet yang asri. Udara yang sejuk, gemercik air yang jernih, serta pepohonan rindang menjadikannya spot pelarian terbaik untuk melepas penat bersama keluarga atau rekan petualang.
                        </p>
                    </div>

                    <div class="space-y-3 mb-8">
                        <div class="flex items-center gap-3 text-xs text-gray-300 bg-white/[0.02] border border-white/5 p-3 rounded-xl">
                            <i class="fas fa-clock text-emerald-400 w-4 text-center"></i>
                            <span>Jam Operasional: <strong>07:00 - 17:00 WIB</strong></span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-300 bg-white/[0.02] border border-white/5 p-3 rounded-xl">
                            <i class="fas fa-ticket-alt text-emerald-400 w-4 text-center"></i>
                            <span>Estimasi Tiket: <strong>Rp 10.000 - Rp 25.000</strong></span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-300 bg-white/[0.02] border border-white/5 p-3 rounded-xl">
                            <i class="fas fa-campground text-emerald-400 w-4 text-center"></i>
                            <span>Aktivitas: Tracking, Fotografi, Berenang, Camping</span>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-white/10">
                        <a href="{{ route('guides.index') }}"
                           class="w-full inline-flex justify-center items-center gap-2 py-4 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 text-white font-bold text-xs tracking-wider uppercase transition-all shadow-lg shadow-emerald-950/50 border border-emerald-400/20">
                            <i class="fas fa-user-astronaut"></i> Cari Guide Untuk Tempat Ini
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
