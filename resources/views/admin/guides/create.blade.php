@extends('layouts.admin') {{-- Atau layouts.admin tergantung nama file layout Anda --}}

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <!-- Header Navigasi -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Guide Baru</h1>
                <p class="text-sm text-gray-600">Lengkapi formulir untuk mendaftarkan pemandu wisata baru.</p>
            </div>
            <a href="{{ route('admin.guides.index') }}" class="flex items-center text-sm text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Alert Error -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-red-800 text-uppercase">Terjadi Kesalahan:</p>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Card Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8">
                <form action="{{ route('admin.guides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Nama -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Aktif</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="email@contoh.com">
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="0812xxxx">
                        </div>

                        <!-- Harga -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tarif per Jam (Rp)</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="price" value="{{ old('hourly_rate') }}" required
                                    class="block w-full rounded-md border-gray-300 pl-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="75000">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Login Akun Guide</label>
                            <input type="password" name="password" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Minimal 8 karakter">
                        </div>

                        <!-- Bio -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio & Pengalaman</label>
                            <textarea name="bio" rows="4" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Tuliskan deskripsi singkat mengenai keahlian guide...">{{ old('bio') }}</textarea>
                        </div>

                        <!-- Foto -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Profil</label>
                            <div class="mt-1 flex items-center space-x-4">
                                <input type="file" name="photo" accept="image/*" required
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                            <p class="mt-2 text-xs text-gray-400 font-italic italic">*Gunakan foto wajah yang jelas (Maks. 2MB)</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Sertifikat Kompetensi</label>
                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition">
                                <input type="file" name="certificate" accept="image/*" required
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-xs text-gray-500">Klik atau seret file gambar sertifikat di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end space-x-3">
                        <button type="button" onclick="window.history.back()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Simpan Data Guide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
