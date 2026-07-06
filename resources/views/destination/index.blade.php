@extends('layouts.app')

@section('content')
<div class="bg-gray-950 min-h-screen text-white antialiased relative overflow-hidden font-sans">

    <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-emerald-500/5 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[130px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-5xl font-black tracking-tight text-white mb-4">
                Daftar Destinasi Alam
            </h1>
            <p class="text-gray-400 text-sm md:text-base font-light leading-relaxed">
                Pilih tempat petualangan alam terbaik dan terpopuler untuk rencana liburan seru Anda di Purwokerto, Banyumas, dan sekitarnya.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($destinations as $dest)
            <div class="group relative rounded-[2rem] border border-white/10 bg-white/[0.02] backdrop-blur-xl p-4 shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col justify-between min-h-[420px]">

                <div>
                    <div class="relative h-[210px] w-full rounded-[1.5rem] overflow-hidden bg-gray-900 border border-white/5 shadow-inner">
                        <img src="{{ $dest->photo ? asset('storage/' . $dest->photo) : asset('images/default-destination.jpg') }}"
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700"
                             alt="{{ $dest->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950/40 via-transparent to-transparent"></div>
                    </div>

                    <div class="mt-5 px-1">
                        <h3 class="font-extrabold text-xl text-white tracking-wide group-hover:text-emerald-400 transition-colors line-clamp-1">
                            {{ $dest->name }}
                        </h3>
                        <p class="text-xs text-gray-400/90 mt-2.5 font-light leading-relaxed line-clamp-3">
                            {{ $dest->description ?? 'Jelajahi keasrian destinasi wisata alam terpopuler dan terlaris di wilayah Banyumas.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-white/5 px-1">
                    <a href="{{ route('destination.show', $dest->id) }}"
                       class="w-full inline-flex justify-center items-center py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs tracking-wider uppercase transition-all shadow-lg shadow-emerald-950/50 border border-emerald-400/20">
                        Lihat Detail Tempat
                    </a>
                </div>

            </div>
            @empty
            <div class="col-span-full text-center py-20 text-gray-500 italic font-light">
                <i class="fas fa-map-marked-alt text-3xl mb-3 text-gray-700 block"></i>
                Belum ada data destinasi alam yang terdaftar di database.
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
