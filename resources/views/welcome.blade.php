@extends('layouts.app')

@section('content')
<div class="bg-gray-950 text-white min-h-screen font-sans relative overflow-x-hidden antialiased">

    <section class="relative h-[85vh] md:h-screen overflow-hidden flex items-center">
        <img src="https://i.ibb.co.com/5Xj4RcfX/49.jpg"
             class="absolute inset-0 w-full h-full object-cover scale-105 filter blur-[1px] opacity-60"
             alt="Hero">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-950/60 to-gray-950"></div>

        <div class="absolute top-0 left-0 w-full z-50">
            <div class="container-custom py-6 flex items-center justify-between">
                </div>
        </div>

        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold tracking-wide uppercase mb-6 backdrop-blur-md">
                        <i class="fas fa-compass"></i> Purwokerto Adventure
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-[1.15] tracking-tight bg-gradient-to-r from-white via-emerald-100 to-emerald-400 bg-clip-text text-transparent mb-6">
                        Jelajahi Keindahan <br class="hidden sm:inline">Banyumas Bersama
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-lime-400">
                            Guide Lokal Terpercaya
                        </span>
                    </h1>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-300 font-light leading-relaxed mb-8 max-w-2xl">
                        Temukan guide berpengalaman dan sewa alat outdoor terbaik untuk petualangan yang aman dan berkesan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-950 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12 border-b border-white/10 pb-5">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
                    <span class="w-2.5 h-7 bg-emerald-500 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)]"></span>
                    Guide Lokal Terbaik
                </h2>
                <a href="{{ route('guides.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-emerald-400 hover:text-emerald-300 transition-colors">
                    Lihat Semua <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($guides as $guide)
                <div class="group relative rounded-[2rem] border border-white/10 bg-gradient-to-b from-white/10 to-white/[0.02] backdrop-blur-xl p-3 shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-[1.01] hover:shadow-emerald-950/40 h-[510px] flex flex-col justify-between">

                    <div class="relative w-full h-[250px] rounded-[1.5rem] overflow-hidden bg-gray-900">
                        <img src="{{ $guide->photo ? asset('storage/' . $guide->photo) : asset('images/default-guide.jpg') }}"
                             class="w-full h-full object-cover object-top transform group-hover:scale-105 transition-transform duration-700"
                             alt="{{ $guide->name }}">

                        <div class="absolute top-4 right-4 w-8 h-8 rounded-full bg-black/40 border border-white/10 flex items-center justify-center text-gray-300 backdrop-blur-sm">
                            <i class="far fa-user text-xs"></i>
                        </div>
                    </div>

                    <div class="p-4 pt-3 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-400 uppercase tracking-wide mb-1.5">
                                <i class="fas fa-leaf text-[9px]"></i>
                                <span>{{ $guide->bio ?? 'Guide Lokal Banyumas' }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-white tracking-wide line-clamp-1 group-hover:text-emerald-300 transition-colors">
                                {{ $guide->name }}
                            </h3>

                            <p class="text-xs text-gray-400/80 font-light leading-relaxed mt-2 line-clamp-3">
                                Berpengalaman memandu tracking medan alam, ramah, komunikatif, dan siap membantu kelancaran eksplorasi liburan Anda.
                            </p>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10 mt-4">
                            <div>
                                <div class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Tarif Layanan</div>
                                <div class="text-xl font-black text-lime-400 mt-0.5">
                                    Rp {{ number_format($guide->hourly_rate ?? 0, 0, ',', '.') }}<span class="text-xs text-gray-500 font-normal">/jam</span>
                                </div>
                            </div>

                            <a href="{{ route('guides.show', $guide->id) }}"
                               class="inline-flex items-center gap-2 border border-white/20 bg-white/5 hover:bg-emerald-600 hover:border-transparent text-white px-4 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 backdrop-blur-sm">
                                <span>Profil</span>
                                <i class="fas fa-arrow-right text-[10px] text-gray-400 group-hover:text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-5 border-t border-white/10 pt-10">
                <div class="flex items-center gap-4 bg-white/[0.03] border border-white/5 p-5 rounded-2xl backdrop-blur-sm shadow-xl transition-all duration-300 hover:bg-white/[0.05]">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                        <i class="fas fa-shield-alt text-base"></i>
                    </div>
                    <div>
                        <h5 class="text-white font-bold text-sm">Terpercaya</h5>
                        <p class="text-gray-400 text-xs mt-0.5 font-light">Guide bersertifikasi dan berpengalaman penuh</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white/[0.03] border border-white/5 p-5 rounded-2xl backdrop-blur-sm shadow-xl transition-all duration-300 hover:bg-white/[0.05]">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                        <i class="fas fa-map-marker-alt text-base"></i>
                    </div>
                    <div>
                        <h5 class="text-white font-bold text-sm">Lokal Expert</h5>
                        <p class="text-gray-400 text-xs mt-0.5 font-light">Menguasai penuh jalur dan sejarah eksotis Banyumas</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white/[0.03] border border-white/5 p-5 rounded-2xl backdrop-blur-sm shadow-xl transition-all duration-300 hover:bg-white/[0.05]">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                        <i class="fas fa-heart text-base"></i>
                    </div>
                    <div>
                        <h5 class="text-white font-bold text-sm">Pelayanan Terbaik</h5>
                        <p class="text-gray-400 text-xs mt-0.5 font-light">Prioritas kenyamanan dan keamanan petualangan Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-900/40 border-t border-white/5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12 border-b border-white/10 pb-5">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
                    <span class="w-2.5 h-7 bg-emerald-500 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)]"></span>
                    Destinasi Populer
                </h2>
                <a href="{{ route('destination.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-emerald-400 hover:text-emerald-300 transition-colors">
                    Lihat Semua <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($destinations as $destination)
                <div class="group relative rounded-[2rem] border border-white/10 bg-gradient-to-b from-white/5 to-transparent backdrop-blur-xl p-3 shadow-xl transition-all duration-500 hover:-translate-y-1.5 h-[435px] flex flex-col justify-between">

                    <div class="relative h-[215px] w-full rounded-[1.5rem] overflow-hidden bg-gray-900">
                        <img src="{{ Storage::url($destination->photo) }}"
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700"
                             alt="{{ $destination->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950/60 via-transparent to-transparent"></div>
                    </div>

                    <div class="p-3 flex-grow flex flex-col justify-between">
                        <div class="mt-2">
                            <h3 class="font-extrabold text-xl text-white tracking-wide line-clamp-1 group-hover:text-emerald-400 transition-colors">
                                {{ $destination->name }}
                            </h3>
                            <p class="text-xs text-gray-400/90 mt-2 font-light leading-relaxed line-clamp-2">
                                Jelajahi keasrian destinasi wisata alam terpopuler dan terlaris di wilayah Banyumas.
                            </p>
                        </div>

                        <div class="mt-5 pt-3 border-t border-white/5">
                            <a href="{{ route('destination.show', $destination->id) }}" class="w-full inline-flex justify-center items-center py-3 rounded-xl bg-emerald-600/80 hover:bg-emerald-600 text-white font-bold text-xs tracking-wider uppercase transition-all shadow-lg shadow-emerald-950/40 border border-emerald-500/20 backdrop-blur-sm">
                                Lihat Detail Tempat
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-950 border-t border-white/5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 border-b border-white/10 pb-5">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white flex items-center gap-3">
                        <span class="w-2.5 h-7 bg-emerald-500 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)]"></span>
                        Sewa Alat Outdoor
                    </h2>
                    <p class="text-gray-400 text-sm mt-2 font-light">Peralatan standar pendakian tingkat tinggi untuk petualangan aman Anda.</p>
                </div>
                <a href="{{ route('equipments.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-emerald-400 hover:text-emerald-300 transition-colors mt-4 md:mt-0">
                    Lihat Semua <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredEquipments as $equipment)
                <div class="group bg-white/[0.02] border border-white/10 rounded-[2rem] p-4 flex flex-col justify-between shadow-xl transition-all duration-500 hover:border-white/20 hover:-translate-y-1.5">

                    <div class="w-full h-44 rounded-2xl overflow-hidden bg-gray-900 mb-4">
                        <img src="{{ asset('storage/' . $equipment->photo) }}"
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                             alt="{{ $equipment->name }}">
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block mb-1">{{ $equipment->category }}</span>
                        <h3 class="font-bold text-lg text-white line-clamp-1 group-hover:text-emerald-300 transition-colors">{{ $equipment->name }}</h3>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-white/5 mt-4">
                        <div>
                            <div class="text-[9px] text-gray-500 uppercase tracking-wider font-semibold">Sewa / Hari</div>
                            <p class="text-emerald-400 font-extrabold text-base mt-0.5">
                                Rp {{ number_format($equipment->daily_rate, 0, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('equipments.index') }}" class="px-4 py-2 bg-emerald-600/90 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-emerald-950/40 border border-emerald-500/20">
                            Sewa
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 bg-white/[0.01] border border-white/5 rounded-3xl text-gray-500 text-sm font-light">
                    <i class="fas fa-boxes text-2xl mb-2 text-gray-600 block"></i>
                    Belum ada peralatan outdoor unggulan yang tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection
