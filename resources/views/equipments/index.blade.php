@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pb-20">
    <!-- Header Hero Section -->
    <div class="bg-[#0f172a] pt-16 pb-24 px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4">Rental Alat Wisata</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">Pilih peralatan terbaik untuk petualangan Anda di Purwokerto dan sekitarnya.</p>
    </div>

    <!-- Filter Category Section (Sinkron dengan image_e97e5f.jpg) -->
    <div class="max-w-7xl mx-auto px-4 -mt-10">
        <div class="bg-white p-6 rounded-2xl shadow-xl mb-12 border border-gray-100">
            <form action="{{ route('equipments.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-center gap-4">
                <div class="relative w-full md:w-80">
                    <select name="category" class="w-full appearance-none bg-gray-50 border border-gray-200 text-slate-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">Semua Kategori</option>
                        <option value="sepeda" {{ request('category') == 'sepeda' ? 'selected' : '' }}>Sepeda</option>
                        <option value="camping" {{ request('category') == 'camping' ? 'selected' : '' }}>Camping</option>
                        <option value="trekking" {{ request('category') == 'trekking' ? 'selected' : '' }}>Trekking</option>
                        <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-1">
                    Filter
                </button>
            </form>
        </div>

        <!-- Product Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredEquipments as $item)
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100 flex flex-col group hover:shadow-2xl transition-all duration-300">
                <!-- Image Header -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('images/default-equipment.jpg') }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         alt="{{ $item->name }}">
                    <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-full">
                        {{ $item->available_stock }} tersisa
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-extrabold text-slate-800 leading-tight">{{ $item->name }}</h3>
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2.5 py-1 rounded-lg uppercase tracking-wider">
                            {{ $item->category }}
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm mb-6 line-clamp-2">{{ $item->description }}</p>

                    <div class="flex items-center gap-1 mb-6">
                        <span class="text-blue-600 text-3xl font-black">Rp{{ number_format($item->daily_rate, 0, ',', '.') }}</span>
                        <span class="text-slate-400 font-medium">/hari</span>
                        <div class="flex text-yellow-400 ml-auto gap-0.5">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-slate-200"></i>
                        </div>
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2 active:scale-95">
                        <i class="fas fa-plus-circle"></i> Tambah ke Paket
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="text-slate-300 text-6xl mb-4"><i class="fas fa-search"></i></div>
                <h3 class="text-xl font-bold text-slate-800">Alat Tidak Ditemukan</h3>
                <p class="text-slate-500">Maaf, kategori yang Anda cari belum tersedia saat ini.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination (Fix Error image_1cbdda.png) -->
        <div class="mt-16 flex justify-center">
            {{ $featuredEquipments->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
    /* Styling tambahan untuk pagination agar sesuai tema */
    .pagination { @apply flex gap-2; }
    .page-item.active .page-link { @apply bg-blue-600 border-blue-600; }
    .page-link { @apply rounded-xl border-none shadow-sm text-slate-600 font-bold px-4 py-2; }
</style>
@endsection
