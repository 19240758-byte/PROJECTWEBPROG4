<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Ngapak Adventure') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>

        body{
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8FAFC;
            overflow-x: hidden;
        }

        .container-custom{
            max-width: 1280px;
            margin: auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        .card-hover{
            transition: all .3s ease;
        }

        .card-hover:hover{
            transform: translateY(-6px);
        }

        .navbar-blur{
            backdrop-filter: blur(14px);
            background: rgba(0,0,0,.25);
        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 navbar-blur">

    <div class="container-custom">

        <div class="flex items-center justify-between py-5">

            <!-- LOGO -->
            <a href="/"
               class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-2xl bg-white-700 flex items-center justify-center text-white shadow-lg">

                   <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain p-1">

                </div>

                <div>

                    <h1 class="text-white font-bold text-xl leading-none">
                        Ngapak Adventure
                    </h1>

                    <p class="text-green-200 text-xs">
                        Explore Banyumas
                    </p>

                </div>

            </a>

            <!-- MENU -->
            <div class="hidden lg:flex items-center gap-8 text-white font-medium">

                <a href="/" class="hover:text-green-300 transition">
                    Beranda
                </a>

                <a href="/guides" class="hover:text-green-300 transition">
                    Guide
                </a>

                <a href="/equipments" class="hover:text-green-300 transition">
                    Sewa Alat
                </a>

                <a href="/packages" class="hover:text-green-300 transition">
                    Paket
                </a>

                <a href="/destinations" class="hover:text-green-300 transition">
                    Destinasi
                </a>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                @auth

                    <!-- ADMIN -->
                    @if(auth()->user()->profile?->role === 'admin')

                    <a href="/admin/dashboard"
                       class="w-11 h-11 rounded-2xl bg-yellow-400 hover:bg-yellow-500
                              flex items-center justify-center text-white shadow-lg transition hover:scale-105">

                        <i class="fas fa-crown"></i>

                    </a>

                    @endif

                    <!-- PROFILE -->
                    <div class="relative"
                         x-data="{ open:false }">

                        <button @click="open = !open"
                                class="flex items-center gap-3">

                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                            alt="Profil {{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full object-cover border border-slate-700 shadow-md">

                            <div class="hidden lg:block text-left">

                                <h4 class="text-white font-semibold leading-none">

                                    {{ auth()->user()->name }}

                                </h4>

                                <p class="text-xs text-green-200 capitalize mt-1">

                                    {{ auth()->user()->profile?->role ?? 'tourist' }}

                                </p>

                            </div>

                        </button>

                        <!-- DROPDOWN -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-4 w-64 bg-white rounded-3xl shadow-2xl overflow-hidden">

                            <div class="p-3">

                                <a href="/dashboard"
                                   class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-100 transition">

                                    <i class="fas fa-chart-line text-green-700"></i>

                                    Dashboard

                                </a>

                                @if(auth()->user()->profile?->role === 'guide')

                                <a href="/guide/bookings"
                                   class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-100 transition">

                                    <i class="fas fa-map-marked-alt text-green-700"></i>

                                    Booking Guide

                                </a>

                                @endif

                                @if(auth()->user()->profile?->role === 'admin')

                                <a href="/admin/dashboard"
                                   class="flex items-center gap-3 p-4 rounded-2xl hover:bg-yellow-50 transition">

                                    <i class="fas fa-crown text-yellow-500"></i>

                                    Admin Panel

                                </a>

                                @endif

                                <form action="/logout"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="w-full text-left flex items-center gap-3 p-4 rounded-2xl hover:bg-red-50 transition text-red-500">

                                        <i class="fas fa-sign-out-alt"></i>

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @else

                    <!-- LOGIN -->
                    <a href="/login"
                       class="text-white border border-white/30 px-5 py-2.5 rounded-2xl hover:bg-white/10 transition">

                        Masuk

                    </a>

                    <!-- REGISTER -->
                    <a href="/register"
                       class="bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-2xl shadow-xl transition">

                        Daftar

                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>

<!-- CONTENT -->
<main>

    @yield('content')

</main>

<!-- FOOTER -->
<footer class="bg-[#0F172A] text-white pt-24 pb-10">

    <div class="container-custom">

        <div class="grid lg:grid-cols-4 gap-12 mb-20">

            <!-- BRAND -->
            <div>

                <h2 class="text-2xl font-bold mb-5">
                    Ngapak Adventure
                </h2>

                <p class="text-gray-400 leading-relaxed mb-6">

                    Platform booking guide lokal dan sewa alat outdoor
                    terpercaya di Banyumas.

                </p>

                <div class="flex gap-4">

                    <a href="#"
                       class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-700 transition">

                        <i class="fab fa-instagram"></i>

                    </a>

                    <a href="#"
                       class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-700 transition">

                        <i class="fab fa-facebook-f"></i>

                    </a>

                    <a href="#"
                       class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-700 transition">

                        <i class="fab fa-whatsapp"></i>

                    </a>

                </div>

            </div>

            <!-- MENU -->
            <div>

                <h3 class="font-bold text-lg mb-5">
                    Menu
                </h3>

                <ul class="space-y-3 text-gray-400">

                    <li><a href="/" class="hover:text-white">Beranda</a></li>
                    <li><a href="/guides" class="hover:text-white">Guide</a></li>
                    <li><a href="/equipments" class="hover:text-white">Sewa Alat</a></li>
                    <li><a href="/packages" class="hover:text-white">Paket</a></li>

                </ul>

            </div>

            <!-- DESTINASI -->
            <div>

                <h3 class="font-bold text-lg mb-5">
                    Destinasi
                </h3>

                <ul class="space-y-3 text-gray-400">

                    <li>Baturraden</li>
                    <li>Curug Cipendok</li>
                    <li>Telaga Sunyi</li>
                    <li>Gunung Slamet</li>

                </ul>

            </div>

            <!-- CONTACT -->
            <div>

                <h3 class="font-bold text-lg mb-5">
                    Kontak
                </h3>

                <div class="space-y-4 text-gray-400">

                    <div class="flex gap-3">

                        <i class="fas fa-phone text-green-500 mt-1"></i>

                        <p>+62 857-1234-5678</p>

                    </div>

                    <div class="flex gap-3">

                        <i class="fas fa-envelope text-green-500 mt-1"></i>

                        <p>hello@ngapakadventure.com</p>

                    </div>

                    <div class="flex gap-3">

                        <i class="fas fa-map-marker-alt text-green-500 mt-1"></i>

                        <p>Purwokerto, Banyumas</p>

                    </div>

                </div>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="border-t border-white/10 pt-8">

            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">

                <p class="text-gray-500 text-sm">

                    © 2026 Ngapak Adventure.
                    All rights reserved.

                </p>

                <div class="flex gap-6 text-sm text-gray-500">

                    <a href="#" class="hover:text-white">
                        Privacy Policy
                    </a>

                    <a href="#" class="hover:text-white">
                        Terms
                    </a>

                    <a href="#" class="hover:text-white">
                        Support
                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>

</body>
</html>
