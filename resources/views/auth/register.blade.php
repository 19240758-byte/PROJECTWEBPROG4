@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 relative overflow-hidden">
    <!-- Dekorasi Background -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-100/40 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-slate-200/50 rounded-full blur-[120px] translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-5xl w-full relative z-10">
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-emerald-900/10 border border-slate-100 overflow-hidden flex flex-col md:flex-row min-h-[750px]">

            <!-- Sisi Kiri: Branding & Experience -->
            <div class="hidden md:flex md:w-[45%] bg-[#0F172A] p-12 flex-col justify-between text-white relative">
                <!-- Overlay Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="bg-emerald-500 p-3 rounded-2xl shadow-lg shadow-emerald-500/20">
                            <i class="fas fa-mountain text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-black tracking-tighter uppercase">Ngapak Adventure</span>
                    </div>

                    <h1 class="text-4xl font-black leading-tight mb-8 tracking-tight">
                        Siap Jelajahi <br>
                        <span class="text-emerald-400 font-extrabold italic text-5xl">Banyumas?</span>
                    </h1>

                    <div class="space-y-6">
                        <div class="group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                            <div class="w-10 h-10 rounded-xl bg-emerald-400/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-hiking text-emerald-400"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-300">Ratusan Guide Profesional</p>
                        </div>
                        <div class="group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                            <div class="w-10 h-10 rounded-xl bg-emerald-400/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-box-open text-emerald-400"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-300">Rental Alat Terintegrasi</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Simple -->
                <div class="relative z-10 mt-12 pt-8 border-t border-white/5">
                    <p class="text-xs italic text-slate-400 leading-relaxed font-medium">
                        "Proses pendaftaran cepat dan sistem pembayarannya sangat aman. Recomended!"
                    </p>
                    <div class="flex items-center gap-3 mt-4">
                        <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-[10px] font-bold">A</div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Verified Member</span>
                    </div>
                </div>
            </div>

            <!-- Sisi Kanan: Form Pendaftaran -->
            <div class="w-full md:w-[55%] p-8 md:p-14 bg-white flex flex-col justify-center">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Daftar Akun</h2>
                    <p class="text-slate-400 text-sm font-medium">Lengkapi data untuk memulai perjalanan Anda</p>
                </div>

                <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama & Email (Grid di Desktop) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none font-bold text-slate-700 text-sm"
                                   placeholder="John Doe">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none font-bold text-slate-700 text-sm"
                                   placeholder="john@example.com">
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-4 rounded-l-2xl bg-slate-100 text-slate-500 font-black text-xs border border-r-0 border-slate-100">+62</span>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-r-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none font-bold text-slate-700 text-sm"
                                   placeholder="812345678">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="password" required
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none font-bold text-slate-700 text-sm"
                               placeholder="••••••••">
                    </div>

                    <!-- Syarat & Ketentuan -->
                    <div class="flex items-center gap-3 py-2">
                        <input type="checkbox" id="agree" required class="w-5 h-5 rounded-lg border-slate-200 text-emerald-600 focus:ring-emerald-500">
                        <label for="agree" class="text-[11px] text-slate-500 font-semibold">
                            Saya setuju dengan <a href="#" class="text-emerald-600 hover:underline">Ketentuan & Kebijakan Privasi</a>.
                        </label>
                    </div>

                    <!-- Button Submit -->
                    <button type="submit"
                            class="w-full bg-[#0F172A] hover:bg-slate-800 text-white font-black py-4 rounded-2xl shadow-xl shadow-slate-900/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-3 uppercase tracking-widest text-xs">
                        Buat Akun Sekarang
                        <i class="fas fa-arrow-right text-[10px] opacity-50"></i>
                    </button>
                </form>

                <p class="mt-8 text-center text-slate-400 text-sm font-medium">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-[#3F6239] font-black hover:underline underline-offset-4 ml-1">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
