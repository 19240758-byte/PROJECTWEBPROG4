@extends('layouts.app')

@section('content')
{{-- HERO HEADER --}}
<div class="relative bg-slate-900 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <span class="text-emerald-400 font-bold tracking-widest uppercase text-sm mb-4 block">Ngapak Adventure</span>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6">Buat Paket Wisatamu</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">Sesuaikan destinasi, pendamping, dan perlengkapan untuk petualangan tak terlupakan di Banyumas.</p>
    </div>
</div>

<div class="min-h-screen bg-[#F8FAFC] pb-24 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <form id="booking-form" method="POST" action="{{ route('bookings.store') }}">
            @csrf
            {{-- Hidden input untuk total yang akan disimpan ke database --}}
            <input type="hidden" name="amount" id="total_amount_input" value="0">

            <div class="grid lg:grid-cols-3 gap-12">
                {{-- SELECTION SIDE (LEFT) --}}
                <div class="lg:col-span-2 space-y-12">

                    {{-- 1. DESTINASI --}}
                    <section>
                        <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center">
                            <span class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-emerald-200">1</span>
                            Pilih Destinasi
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                          @foreach($destinations as $destination)
<label class="group relative rounded-[2.5rem] overflow-hidden h-80 block border-4 border-transparent has-[:checked]:border-emerald-500 transition-all cursor-pointer shadow-sm hover:shadow-xl">
    <input type="radio" name="destination_id" value="{{ $destination->id }}" class="hidden destination-radio" required>

    {{-- Perbaikan: Gunakan $destination->image dan asset() agar foto tersinkron dari storage --}}
    <img src="{{ asset('storage/' . $destination->photo) }}"
         class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700"
         alt="{{ $destination->name }}">

    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent"></div>

    <div class="absolute bottom-6 left-6 text-white">
        <h4 class="text-xl font-black">{{ $destination->name }}</h4>
        <p class="text-xs text-slate-300">{{ $destination->distance_from_purwokerto }}km dari Pusat Kota</p>
    </div>

    <div class="absolute top-6 right-6 opacity-0 group-has-[:checked]:opacity-100 transition-opacity">
        <div class="bg-emerald-500 text-white p-2 rounded-full shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>
</label>
@endforeach
                        </div>
                    </section>

                    {{-- 2. GUIDES --}}
                    <section>
                        <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center">
                            <span class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-emerald-200">2</span>
                            Pilih Guide
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($guides as $guide)
                            <label class="flex items-center p-4 bg-white border-2 border-slate-100 rounded-3xl cursor-pointer hover:border-emerald-200 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 transition-all shadow-sm">
                                <input type="radio" name="guide_id" value="{{ $guide->id }}" class="hidden guide-radio">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-200">
                                    <img src="{{ $guide->photo ? asset('storage/'.$guide->photo) : 'https://ui-avatars.com/api/?name='.urlencode($guide->name).'&bg=10b981&color=fff' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-bold text-slate-800">{{ $guide->name }}</h5>
                                    <p class="text-emerald-600 font-bold text-sm guide-rate" data-rate="{{ $guide->hourly_rate }}">Rp {{ number_format($guide->hourly_rate, 0, ',', '.') }}/jam</p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </section>

                    {{-- 3. EQUIPMENT --}}
                    <section>
                        <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center">
                            <span class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-emerald-200">3</span>
                            Rental Alat
                        </h3>
                        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm space-y-4">
                            @foreach($equipments as $equipment)
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl equipment-item transition-all hover:bg-emerald-50/30">
                                <div class="flex items-center space-x-4">
                                    <input type="checkbox" name="equipment_ids[]" value="{{ $equipment->id }}" class="w-6 h-6 rounded-lg text-emerald-600 focus:ring-emerald-500 border-slate-300 equipment-checkbox">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $equipment->name }}</p>
                                        <p class="text-xs text-emerald-600 font-bold equipment-rate" data-rate="{{ $equipment->daily_rate }}">Rp {{ number_format($equipment->daily_rate, 0, ',', '.') }}/hari</p>
                                    </div>
                                </div>
                                <input type="number" name="quantities[{{ $equipment->id }}]" min="1" value="1" class="w-20 bg-white border border-slate-200 rounded-xl p-2 text-center font-bold text-slate-700 equipment-qty">
                            </div>
                            @endforeach
                        </div>
                    </section>
                </div>

                {{-- SUMMARY & PAYMENT SIDE (RIGHT) --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-10 space-y-6">
                        <div class="bg-slate-900 rounded-[3rem] p-8 text-white shadow-2xl border border-slate-800 relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl"></div>

                            <h4 class="font-black text-emerald-400 text-xs mb-8 uppercase tracking-widest">Summary Pesanan</h4>

                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Layanan Guide</span>
                                    <span id="display-guide-cost" class="font-bold text-slate-200">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-slate-400 text-sm">
                                    <span>Sewa Peralatan</span>
                                    <span id="display-equipment-cost" class="font-bold text-slate-200">Rp 0</span>
                                </div>
                                <div class="pt-6 border-t border-slate-800 flex justify-between items-end">
                                    <span class="font-black text-slate-400">TOTAL</span>
                                    <span id="display-total-cost" class="text-3xl font-black text-emerald-400">Rp 0</span>
                                </div>
                            </div>

                            {{-- PAYMENT & DATE --}}
                            <div class="space-y-4 mb-8">
                                <div>
                                    <label class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-2 block">Tanggal Wisata</label>
                                    <input type="date" name="booking_date" class="w-full bg-slate-800 rounded-2xl p-4 border-none text-white focus:ring-2 focus:ring-emerald-500 transition-all" required>
                                </div>

                                <div class="flex items-center justify-between bg-slate-800 p-4 rounded-2xl">
                                    <span class="text-xs font-bold text-slate-400">Durasi Guide</span>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" id="duration_hours" name="duration_hours" value="4" class="w-12 bg-transparent text-center font-black text-emerald-400 outline-none">
                                        <span class="text-xs text-slate-500">Jam</span>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-2 block">Metode Pembayaran</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="payment_method" value="cash" class="hidden peer" checked>
                                            <div class="bg-slate-800 p-4 rounded-2xl text-center text-xs font-black peer-checked:bg-emerald-600 peer-checked:text-white text-slate-400 transition-all">CASH</div>
                                        </label>
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="payment_method" value="e-wallet" class="hidden peer">
                                            <div class="bg-slate-800 p-4 rounded-2xl text-center text-xs font-black peer-checked:bg-emerald-600 peer-checked:text-white text-slate-400 transition-all">E-WALLET</div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submit-btn" disabled class="w-full py-6 bg-emerald-600 hover:bg-emerald-500 disabled:opacity-20 disabled:grayscale rounded-2xl font-black text-xl transition-all shadow-xl shadow-emerald-900/20 active:scale-95">
                                KONFIRMASI PESANAN
                            </button>
                            <p class="text-center text-[10px] text-slate-500 mt-4 italic">*Pilih destinasi untuk memproses</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calculate = () => {
        let guideTotal = 0, equipTotal = 0;
        const formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

        // Hitung Guide
        const selectedGuide = document.querySelector('.guide-radio:checked');
        if (selectedGuide) {
            const rate = parseInt(selectedGuide.closest('label').querySelector('.guide-rate').dataset.rate);
            const hours = parseInt(document.getElementById('duration_hours').value) || 0;
            guideTotal = rate * hours;
        }

        // Hitung Alat
        document.querySelectorAll('.equipment-item').forEach(item => {
            if (item.querySelector('.equipment-checkbox').checked) {
                const rate = parseInt(item.querySelector('.equipment-rate').dataset.rate);
                const qty = parseInt(item.querySelector('.equipment-qty').value) || 0;
                equipTotal += (rate * qty);
            }
        });

        const grandTotal = guideTotal + equipTotal;

        // Update UI
        document.getElementById('display-guide-cost').innerText = formatter.format(guideTotal);
        document.getElementById('display-equipment-cost').innerText = formatter.format(equipTotal);
        document.getElementById('display-total-cost').innerText = formatter.format(grandTotal);
        document.getElementById('total_amount_input').value = grandTotal;

        // Button State
        document.getElementById('submit-btn').disabled = !document.querySelector('.destination-radio:checked');
    };

    document.querySelectorAll('input').forEach(i => i.addEventListener('change', calculate));
    document.getElementById('duration_hours').addEventListener('input', calculate);
    calculate();
});
</script>
@endsection
