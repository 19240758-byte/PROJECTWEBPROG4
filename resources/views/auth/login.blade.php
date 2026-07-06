@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-white">
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center p-12">

    <div class="absolute inset-0 z-0">
        <img src="https://i.ibb.co.com/DDzyTSMs/657fef5564472.jpg"
             class="w-full h-full object-cover" alt="Background">
        {{-- Overlay Gelap agar teks dan logo terbaca jelas --}}
        <div class="absolute inset-0 bg-gradient-to-b from-[#0F172A]/80 via-[#0F172A]/60 to-[#3F6239]/80"></div>
    </div>

    <div class="relative z-10 max-w-lg text-center">

        <div class="inline-flex items-center justify-center w-28 h-28 bg-white/10 backdrop-blur-xl rounded-[2.5rem] border border-white/20 mb-8 shadow-2xl overflow-hidden group">
            <img src="{{ asset('images/logo.png') }}"
                 alt="Logo"
                 class="w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-110">
        </div>

        <h2 class="text-5xl font-black text-white leading-tight tracking-tighter mb-6">
            Selamat Datang <br> di <span class="text-emerald-400">Ngapak Adventure</span>
        </h2>

        <p class="text-slate-200 text-lg leading-relaxed font-medium opacity-90">
            Temukan keajaiban alam Banyumas, pilih pemandu terbaik, dan siapkan perlengkapan petualanganmu dalam satu genggaman."
        </p>

        <div class="mt-12 flex items-center justify-center gap-4 bg-white/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10 inline-flex">
            <div class="flex -space-x-3">
                <img class="w-10 h-10 rounded-full border-2 border-[#0F172A] object-cover" src="https://i.pravatar.cc/150?u=1" alt="user">
                <img class="w-10 h-10 rounded-full border-2 border-[#0F172A] object-cover" src="https://i.pravatar.cc/150?u=2" alt="user">
                <img class="w-10 h-10 rounded-full border-2 border-[#0F172A] object-cover" src="https://i.pravatar.cc/150?u=3" alt="user">
            </div>
            <span class="text-sm font-bold text-white uppercase tracking-widest">+1.2k Penjelajah Bergabung</span>
        </div>
    </div>

    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-emerald-500/20 rounded-full blur-[120px] z-0"></div>
</div>

    <!-- Sisi Kanan: Form Login -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-16 bg-slate-50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center justify-center gap-3 mb-12">
                <div class="bg-[#3F6239] p-3 rounded-2xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain p-1">
                </div>
                <span class="text-2xl font-black text-slate-800 tracking-tighter">Ngapak Adventure</span>
            </div>

            <div class="mb-10">
                <h1 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Selamat Datang</h1>
                <p class="text-slate-500 font-medium">Silahkan masuk ke akun Ngapak Adventure Anda</p>
            </div>

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none text-slate-700 font-semibold shadow-sm placeholder:text-slate-300"
                           placeholder="name@example.com" required>
                    @error('email')
                        <p class="text-[11px] font-bold text-red-500 mt-1 ml-1 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Password</label>
                        <a href="#" class="text-[11px] font-bold text-emerald-600 hover:text-[#3F6239] transition-colors">Forgot Password?</a>
                    </div>
                    <input type="password" name="password"
                           class="w-full px-6 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/5 focus:border-[#3F6239] transition-all outline-none text-slate-700 font-semibold shadow-sm placeholder:text-slate-300"
                           placeholder="••••••••" required>
                </div>

                <div class="flex items-center px-1">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 border-slate-300 rounded-lg text-[#3F6239] focus:ring-[#3F6239] transition-all">
                        <span class="ml-3 text-sm font-bold text-slate-500 group-hover:text-slate-700 transition-colors">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-[#0F172A] hover:bg-[#1E293B] text-white font-black py-5 rounded-2xl shadow-xl shadow-slate-900/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-3 tracking-widest text-sm uppercase">
                    Masuk Sekarang
                    <i class="fas fa-arrow-right text-xs opacity-50"></i>
                </button>
            </form>

            <p class="mt-8 text-center text-slate-500 font-medium">
                Belum punya akun?
                <a href="/register" class="text-[#3F6239] font-black hover:underline underline-offset-4">Daftar Sekarang</a>
            </p>

            <!-- Admin Shortcut Panel (Clean Version) -->
            <div class="mt-12 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-3 opacity-10">
                    <i class="fas fa-user-shield text-4xl"></i>
                </div>
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Quick Access Admin
                </h4>
                <div class="grid grid-cols-1 gap-2">
                    <div class="flex justify-between items-center group cursor-pointer hover:bg-slate-50 p-1 rounded-lg transition-all" onclick="copyEmail('admin@purwoguide.com')">
                        <span class="text-xs font-bold text-slate-600">Super Admin</span>
                        <code class="text-[11px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-black">admin@purwoguide.com</code>
                    </div>
                    <div class="flex justify-between items-center group cursor-pointer hover:bg-slate-50 p-1 rounded-lg transition-all" onclick="copyEmail('budi@guide.com')">
                        <span class="text-xs font-bold text-slate-600">Guide</span>
                        <code class="text-[11px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-black">budi@guide.com</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyEmail(email) {
        navigator.clipboard.writeText(email);
        alert('Email copied to clipboard!');
    }
</script>
@endsection
