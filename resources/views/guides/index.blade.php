@extends('layouts.app')

@section('content')
{{-- Hero Section sesuai image_ca7adf.png --}}
<div class="bg-[#0B1120] pt-24 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
            Daftar Guide Lokal
        </h1>
        <p class="text-xl text-gray-400 max-w-2xl mx-auto">
            Pilih guide berpengalaman untuk petualangan Anda di Purwokerto dan sekitarnya.
        </p>
    </div>
</div>

{{-- Content Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 mb-20">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($guides as $guide)
        <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 group hover:shadow-2xl transition-all duration-300 flex flex-col h-full">

            {{-- Image Container --}}
            <div class="h-72 overflow-hidden relative">
                @if($guide->photo)
                    <img src="{{ Storage::url($guide->photo) }}"
                        alt="{{ $guide->name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80"
                        alt="Default Photo"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @endif

                {{-- Badge Tersertifikasi --}}
                @if($guide->is_certified)
                <div class="absolute top-4 right-4 bg-emerald-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black shadow-lg flex items-center tracking-wider uppercase">
                    <i class="fas fa-certificate mr-1.5 text-yellow-300"></i> Tersertifikasi
                </div>
                @endif
            </div>

            {{-- Body --}}
            <div class="p-8 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">
                        {{ $guide->name }}
                    </h3>
                    <span class="px-3 py-1 {{ $guide->status === 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} rounded-full text-[10px] font-bold uppercase tracking-widest">
                        {{ $guide->status === 'active' ? 'Tersedia' : 'Sibuk' }}
                    </span>
                </div>

                <p class="text-gray-500 mb-6 line-clamp-3 text-sm leading-relaxed">
                    {{ $guide->bio }}
                </p>

                <div class="mt-auto pt-6 border-t border-gray-50">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em]">Tarif Per Jam</p>
                            <p class="text-xl font-black text-emerald-800">
                                Rp{{ number_format($guide->hourly_rate, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-right">
                             <p class="text-[10px] text-gray-400 uppercase font-bold tracking-[0.2em]">Kontak</p>
                             <p class="text-sm font-bold text-gray-700">{{ $guide->phone }}</p>
                        </div>
                    </div>

                    @auth
                    <a href="{{ route('packages.create', ['guide_id' => $guide->id]) }}" class="w-full block text-center bg-emerald-700 hover:bg-emerald-800 text-white py-4 rounded-2xl font-bold transition-all shadow-lg active:scale-95 shadow-emerald-200">
                        Tambah ke Paket
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="w-full block text-center bg-gray-100 text-gray-600 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all">
                        Login untuk Booking
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
            <p class="text-gray-500 font-medium">Belum ada guide lokal yang terdaftar.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-16 flex justify-center">
        {{ $guides->links() }}
    </div>
</div>
@endsection
