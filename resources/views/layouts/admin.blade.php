<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Explore Banyumas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Warna hijau sesuai referensi image_39be9a.jpg */
        .sidebar-item-active { background-color: #3F6239; color: white !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased">

    <div class="flex min-h-screen">
        <!-- SIDEBAR (Dark Navy - Referensi 8e0ea4ee-fb07-4e60-9802-a6f9340a4e41.jpg) -->
        <aside class="w-72 bg-[#0F172A] text-slate-400 flex-shrink-0 hidden md:flex flex-col sticky top-0 h-screen shadow-2xl">
            <div class="p-8 flex flex-col h-full">
                <!-- Logo Section -->
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-10 h-10 rounded-xl bg-[#3F6239] flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-mountain text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg leading-none">Explore</h1>
                        <h1 class="text-white font-bold text-lg leading-none mt-1">Banyumas</h1>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-6 px-4">Menu Utama</p>

                <!-- Navigation -->
                <nav class="space-y-2 flex-1">
                    <!-- Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-home-alt w-5"></i>
                            <span class="font-medium text-sm">Dashboard</span>
                        </div>
                    </a>

                    <!-- Destinasi Link (Berfungsi) -->
                    <a href="{{ route('admin.destinations.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.destinations.*') ? 'sidebar-item-active' : 'hover:bg-white/5 hover:text-white group' }}">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-map-marker-alt w-5"></i>
                            <span class="font-medium text-sm">Destinasi</span>
                        </div>
                        <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded-md group-hover:bg-emerald-600 transition-colors">{{ \App\Models\Destination::count() }}</span>
                    </a>

                    <!-- Guides Link (Diperbaiki) -->
                    <a href="{{ route('admin.guides.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.guides.*') ? 'sidebar-item-active' : 'hover:bg-white/5 hover:text-white group' }}">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium text-sm">Guides</span>
                        </div>
                        <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded-md group-hover:bg-emerald-600 transition-colors">{{ \App\Models\Guide::count() }}</span>
                    </a>

                    <!-- Equipments Link -->
                    <a href="{{ route('admin.equipments.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.equipments.*') ? 'sidebar-item-active' : 'hover:bg-white/5 hover:text-white group' }}">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-briefcase w-5"></i>
                            <span class="font-medium text-sm">Equipments</span>
                        </div>
                        <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded-md group-hover:bg-emerald-600 transition-colors">{{ \App\Models\Equipment::count() }}</span>
                    </a>
                </nav>

                <!-- Footer Sidebar -->
                <div class="mt-auto pt-6 border-t border-slate-800/50">
                    <div class="p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30 text-center">
                        <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest mb-1">Status Sistem</p>
                        <p class="text-[11px] text-slate-400 italic">Online & Aktif</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Header Atas (Modern White) -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-10 py-5 flex justify-between items-center sticky top-0 z-20">
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight">Super Admin</h2>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Manajemen Platform</p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-emerald-600 font-bold uppercase mt-1">Administrator</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3F6239&color=fff"
                             class="w-11 h-11 rounded-2xl border-2 border-emerald-50 shadow-sm object-cover">
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                            <i class="fas fa-power-off"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Bagian Content Utama -->
            <main class="p-10">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
