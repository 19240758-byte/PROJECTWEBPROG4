@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen -m-8">
    <!-- MAIN CONTENT SECTION -->
    <div class="flex-1 bg-[#F8FAFC]">
        <!-- TOP HEADER -->
        <header class="bg-white border-b border-slate-200 px-10 py-5 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h2 class="text-xl font-black text-slate-800">Dashboard Overview</h2>
                <p class="text-xs text-slate-400 font-medium">Kelola semua data dalam satu pintu.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-emerald-600 font-bold uppercase mt-1">Super Admin</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3F6239&color=fff" class="w-11 h-11 rounded-2xl border-2 border-emerald-50 object-cover">
            </div>
        </header>

        <div class="p-10 space-y-12">

            <!-- 1. STATISTIC CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $cards = [
                        ['label' => 'Total Guide', 'count' => \App\Models\Guide::count(), 'icon' => 'fa-users', 'color' => 'emerald'],
                        ['label' => 'Alat Tersedia', 'count' => \App\Models\Equipment::count(), 'icon' => 'fa-tools', 'color' => 'blue'],
                        ['label' => 'Destinasi', 'count' => \App\Models\Destination::count(), 'icon' => 'fa-map-signs', 'color' => 'orange'],
                        ['label' => 'Pesanan Baru', 'count' => \App\Models\Booking::where('status', 'pending')->count(), 'icon' => 'fa-shopping-cart', 'color' => 'purple']
                    ];
                @endphp
                @foreach($cards as $c)
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $c['label'] }}</p>
                        <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $c['count'] }}</h3>
                    </div>
                    <div class="h-14 w-14 flex items-center justify-center rounded-2xl bg-{{ $c['color'] }}-50 text-{{ $c['color'] }}-600">
                        <i class="fas {{ $c['icon'] }} text-xl"></i>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- 2. MANAJEMEN GUIDE LOKAL -->
            <section>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter">Manajemen Guide Lokal</h2>
                    <a href="{{ route('admin.guides.index') }}" class="bg-[#059669] hover:bg-[#047857] text-white px-6 py-2.5 rounded-xl text-xs font-bold transition">
                        Tambah Guide
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach(\App\Models\Guide::latest()->take(4)->get() as $guide)
                    <div class="bg-white rounded-[2rem] border border-slate-50 overflow-hidden group hover:shadow-xl transition duration-300">
                        <div class="relative h-48 bg-slate-100">
                            <img src="{{ asset('storage/' . $guide->photo) }}" class="w-full h-full object-cover">
                            <span class="absolute top-4 right-4 bg-[#059669] text-white text-[9px] font-bold px-3 py-1 rounded-full uppercase">Aktif</span>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-slate-800">{{ $guide->name }}</h4>
                            <a href="{{ route('admin.guides.edit', $guide->id) }}" class="block w-full mt-4 bg-[#059669] text-white py-2.5 rounded-xl text-xs font-bold hover:bg-[#047857]">
                                Edit Profil
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- 3. PENGELOLAAN DESTINASI (Bentuk Card seperti Guide) -->
            <section>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter">Pengelolaan Destinasi</h2>
                    <a href="{{ route('admin.destinations.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-xl text-xs font-bold transition">
                        Tambah Destinasi
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach(\App\Models\Destination::latest()->take(4)->get() as $dest)
                    <div class="bg-white rounded-[2rem] border border-slate-50 overflow-hidden group hover:shadow-xl transition duration-300">
                        <div class="relative h-48 bg-slate-100">
                            <img src="{{ asset('storage/' . $dest->photo) }}" class="w-full h-full object-cover">
                            <span class="absolute top-4 right-4 bg-orange-500 text-white text-[9px] font-bold px-3 py-1 rounded-full uppercase">Populer</span>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-slate-800">{{ $dest->name }}</h4>
                            <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="block w-full mt-4 bg-slate-800 text-white py-2.5 rounded-xl text-xs font-bold hover:bg-slate-900">
                                Kelola Destinasi
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- 4. MANAJEMEN SEWA ALAT (Bentuk Card seperti Guide) -->
            <section>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter">Inventaris Sewa Alat</h2>
                    <a href="{{ route('admin.equipments.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-xs font-bold transition">
                        Tambah Alat
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach(\App\Models\Equipment::latest()->take(4)->get() as $item)
                    <div class="bg-white rounded-[2rem] border border-slate-50 overflow-hidden group hover:shadow-xl transition duration-300">
                        <div class="relative h-48 bg-slate-100">
                            <img src="{{ asset('storage/' . $item->photo) }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg">
                                <p class="text-[10px] font-bold text-slate-800 uppercase">Stok: {{ $item->stock }}</p>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-slate-800">{{ $item->name }}</h4>
                            <a href="{{ route('admin.equipments.edit', $item->id) }}" class="block w-full mt-4 bg-blue-600 text-white py-2.5 rounded-xl text-xs font-bold hover:bg-blue-700">
                                Edit Alat
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
