<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Perpustakaan USU')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar for Admin */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .admin-sidebar {
            background: linear-gradient(180deg, #043d1e 0%, #011f0f 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    @stack('styles')
</head>
<body class="text-slate-800 antialiased h-screen flex overflow-hidden bg-slate-50" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-slate-900/80 backdrop-blur-sm lg:hidden transition-opacity" 
         x-transition:enter="transition-opacity ease-linear duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition-opacity ease-linear duration-300" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         @click="sidebarOpen = false" x-cloak></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar fixed inset-y-0 left-0 z-50 w-72 flex flex-col transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shadow-2xl" 
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        
        <!-- Sidebar Header -->
        <div class="h-20 flex items-center px-8 border-b border-white/10 shrink-0">
            <div class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-[#fecb00] rounded-xl flex items-center justify-center shadow-lg shadow-[#fecb00]/30 group-hover:scale-105 group-hover:rotate-6 transition-all duration-300">
                    <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-white font-black text-lg tracking-wide leading-none group-hover:text-[#fecb00] transition-colors duration-300">Admin Panel</span>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mt-1">Perpustakaan USU</span>
                </div>
            </div>
            
            <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-slate-400 hover:text-white cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white font-bold border border-white/10 shadow-inner' : 'text-slate-300 hover:text-white hover:bg-white/5 font-medium transition-all' }} group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-[#fecb00]' : 'text-slate-400 group-hover:text-white transition-colors duration-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Manajemen Dokumen
            </a>
            
            <a href="{{ url('/akreditasi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 font-medium transition-all group">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Lihat Situs Publik
            </a>
        </div>

        <!-- Sidebar Footer / User Profile -->
        <div class="p-4 border-t border-white/10 shrink-0">
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 flex items-center justify-between border border-white/10 hover:border-white/20 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-600 to-[#0a7a3b] border-2 border-white/20 flex items-center justify-center text-white font-extrabold text-sm shadow-md uppercase">
                        {{ substr(auth()->user()->name ?? 'AD', 0, 2) }}
                    </div>
                    <div>
                        <div class="text-sm font-bold text-white leading-tight truncate max-w-[130px]">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[130px]">{{ auth()->user()->email ?? 'admin@usu.ac.id' }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout" class="w-9 h-9 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:shadow-red-500/20 active:scale-95 cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <!-- Topbar -->
        <header class="h-20 bg-white/70 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-4 sm:px-8 shrink-0 z-30">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                <div>
                    <h2 class="text-xl font-black text-slate-900 tracking-tight leading-none">@yield('page_title', 'Dashboard')</h2>
                    <p class="text-xs text-slate-500 font-semibold mt-1">@yield('page_subtitle', 'Panel Kendali Utama')</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 px-3.5 py-1.5 bg-green-50 text-green-700 rounded-full border border-green-200/80 text-xs font-extrabold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Sistem Online
                </div>
            </div>
        </header>

        <!-- Main Scrollable Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-8 relative bg-slate-50">
            <!-- Decorative soft glowing background orbs -->
            <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-[#0a7a3b]/5 filter blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/4 w-96 h-96 rounded-full bg-[#fecb00]/5 filter blur-[100px] pointer-events-none"></div>
            
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.015] pointer-events-none mix-blend-multiply"></div>
            <div class="relative z-10 max-w-7xl mx-auto">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl flex items-start shadow-sm" x-data="{ show: true }" x-show="show">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-bold text-green-800">Berhasil!</h3>
                            <div class="text-sm text-green-700 mt-1">{{ session('success') }}</div>
                        </div>
                        <button @click="show = false" class="ml-3 text-green-500 hover:text-green-700 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
