@extends('layouts.app')

@section('content')
<div class="bg-gray-950 text-white min-h-screen font-sans antialiased py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-emerald-400 transition-colors mb-8 group">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Kembali
        </a>

        <div class="rounded-[2.5rem] border border-white/10 bg-gradient-to-b from-white/10 to-white/[0.02] backdrop-blur-xl p-6 md:p-10 shadow-2xl flex flex-col md:flex-row gap-8 items-center md:items-start">

            <div class="w-full md:w-1/3 max-w-[280px]">
                <div class="relative rounded-[2rem] overflow-hidden border border-white/10 aspect-square md:aspect-[3/4] bg-gray-900 shadow-xl">
                    <img src="{{ $guide->photo ? asset('storage/' . $guide->photo) : asset('images/default-guide.jpg') }}"
                         class="w-full h-full object-cover"
                         alt="{{ $guide->name }}">
                </div>
            </div>

            <div class="w-full md:w-2/3 flex flex-col justify-between h-full">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold tracking-wide uppercase mb-4">
                        <i class="fas fa-certificate text-[10px]"></i> Verified Guide
                    </span>

                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white mb-2">
                        {{ $guide->name }}
                    </h1>

                    <p class="text-emerald-400 text-sm font-semibold tracking-wide uppercase mb-6">
                        {{ $guide->bio ?? 'Guide Lokal Profesional Banyumas' }}
                    </p>

                    <div class="border-t border-white/10 pt-4 mb-6">
                        <h4 class="text-xs uppercase tracking-wider text-gray-400 font-bold mb-2">Tentang Saya</h4>
                        <p class="text-sm md:text-base text-gray-300 font-light leading-relaxed">
                            Halo! Saya siap memandu petualangan Anda mengeksplorasi keindahan alam tersembunyi di Banyumas dengan aman, seru, dan berkesan. Berpengalaman dalam navigasi medan, tracking curug, maupun wisata keluarga ramah anak.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-6 border-t border-white/10 bg-white/[0.01] p-4 rounded-2xl border border-white/5">
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Tarif Sewa Guide</div>
                        <div class="text-2xl font-black text-lime-400 mt-0.5">
                            Rp {{ number_format($guide->hourly_rate ?? 0, 0, ',', '.') }} <span class="text-sm text-gray-400 font-normal">/ jam</span>
                        </div>
                    </div>

                    <a href="https://wa.me/628xxxxxxxxxx?text=Halo%20{{ urlencode($guide->name) }},%20saya%20tertarik%20untuk%20booking%20layanan%20guide%20Anda."
                       target="_blank"
                       class="inline-flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm px-6 py-3.5 rounded-xl transition-all shadow-lg shadow-emerald-950/50 border border-emerald-400/20">
                        <i class="fab fa-whatsapp text-base"></i> Hubungi Guide Sekarang
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
