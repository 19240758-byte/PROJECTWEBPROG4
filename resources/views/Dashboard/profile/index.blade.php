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

    <!-- AREA UTAMA: FORM EDIT PROFIL (Gabungan Kolom 2 & 3 untuk kelegaan input) -->
    <div class="flex-1 flex flex-col bg-[#090d16] overflow-y-auto">
        <!-- HEADER HALAMAN -->
        <div class="px-8 py-5 bg-[#0d121f]/90 backdrop-blur-md border-b border-slate-800/50 flex items-center justify-between sticky top-0 z-10">
            <div>
                <h3 class="text-xs font-black text-white uppercase tracking-wider">Pengaturan Akun Profil</h3>
                <p class="text-[10px] text-slate-400 mt-0.5">Kelola informasi data personal dan keamanan sandi akun Anda</p>
            </div>
            <span class="text-[9px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-1.5 rounded-xl font-black uppercase tracking-wider">
                {{ Auth::user()->role ?? 'Wisatawan' }}
            </span>
        </div>

        <div class="p-8 max-w-3xl w-full mx-auto space-y-6">

            <!-- NOTIFIKASI SUKSES / ERROR -->
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-xs font-bold text-emerald-400 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl text-xs font-semibold text-rose-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <p><i class="fas fa-exclamation-circle mr-1"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- FORM UTAMA -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- BAGIAN FOTO PROFIL (AVATAR) -->
                <div class="bg-[#0d121f] p-6 rounded-2xl border border-slate-800/60 flex items-center gap-6">
                    <div class="relative group">
                        <!-- Preview Foto -->
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-2xl object-cover border-2 border-emerald-500/40 shadow-lg">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-xl uppercase shadow-md shadow-emerald-500/20">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-white uppercase tracking-wider">Foto Profil</label>
                        <input type="file" name="avatar" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-wider file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700 file:transition-all cursor-pointer">
                        <p class="text-[10px] text-slate-500">Format: JPG, JPEG, PNG. Maksimal ukuran file 2MB.</p>
                    </div>
                </div>

                <!-- BAGIAN INFORMASI UTAMA -->
                <div class="bg-[#0d121f] p-6 rounded-2xl border border-slate-800/60 space-y-4">
                    <h4 class="text-[11px] font-black text-white uppercase tracking-wider border-b border-slate-800/60 pb-3 flex items-center gap-2">
                        <i class="fas fa-id-card text-emerald-500"></i> Informasi Personal
                    </h4>

                    <!-- Input Nama -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-[#090d16] border border-slate-800/85 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 font-semibold transition-all">
                    </div>

                    <!-- Input Email -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-[#090d16] border border-slate-800/85 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 font-semibold transition-all">
                    </div>
                </div>

                <!-- BAGIAN UBAH PASSWORD -->
                <div class="bg-[#0d121f] p-6 rounded-2xl border border-slate-800/60 space-y-4">
                    <div>
                        <h4 class="text-[11px] font-black text-white uppercase tracking-wider border-b border-slate-800/60 pb-3 flex items-center gap-2">
                            <i class="fas fa-lock text-emerald-500"></i> Keamanan & Sandi
                        </h4>
                        <p class="text-[9px] text-slate-500 mt-1">Kosongkan kolom di bawah jika Anda tidak ingin mengubah password lama Anda.</p>
                    </div>

                    <!-- Input Password Baru -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Password Baru</label>
                        <input type="password" name="password" placeholder="••••••••"
                               class="w-full bg-[#090d16] border border-slate-800/85 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500 font-semibold transition-all">
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="w-full bg-[#090d16] border border-slate-800/85 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500 font-semibold transition-all">
                    </div>
                </div>

                <!-- TOMBOL SIMPAN -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-xs uppercase tracking-wider rounded-xl transition-all shadow-md shadow-emerald-500/20 flex items-center gap-2 active:scale-95">
                        <i class="fas fa-save text-[10px]"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
