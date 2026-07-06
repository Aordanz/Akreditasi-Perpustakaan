<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumen Akreditasi - Perpustakaan USU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6; /* light gray/blue background */
        }
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #94a3b8;
        }
        
        /* Radio button custom styling to match standard accent */
        input[type="radio"] {
            accent-color: #0a7a3b;
        }
    </style>
</head>
<body class="text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40 border-b-[4px] border-[#0a7a3b]">
        <div class="max-w-[1400px] mx-auto px-4 flex justify-between items-center h-20">
            <div class="flex items-center gap-4">
                <!-- Hamburger Menu -->
                <button @click="sidebarOpen = true" class="text-slate-600 hover:text-[#0a7a3b] transition-colors focus:outline-none p-2 rounded-lg hover:bg-slate-100 lg:hidden">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <button @click="sidebarOpen = true" class="text-slate-600 hover:text-[#0a7a3b] transition-colors focus:outline-none p-2 rounded-lg hover:bg-slate-100 hidden lg:block">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 md:w-14 md:h-14 object-contain group-hover:scale-105 transition duration-300">
                    <span class="font-bold text-lg md:text-2xl text-black tracking-tight hidden sm:block">Perpustakaan Universitas Sumatera Utara</span>
                </a>
            </div>
            <nav class="hidden md:flex gap-6 font-semibold text-sm text-[#0a7a3b]">
                <a href="/" class="relative hover:text-[#044b25] transition-colors py-2">Beranda</a>
                <a href="/akreditasi" class="text-[#044b25] font-bold relative after:absolute after:bottom-0 after:left-0 after:h-[3px] after:w-full after:bg-[#0a7a3b] after:rounded-t-md py-2">Akreditasi</a>
                <a href="#" class="relative hover:text-[#044b25] transition-colors py-2">Profil</a>
                <a href="#" class="relative hover:text-[#044b25] transition-colors py-2">Layanan</a>
                <a href="#" class="relative hover:text-[#044b25] transition-colors py-2">Koleksi</a>
            </nav>
        </div>
    </header>

    <!-- Offcanvas Drawer -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-50 flex" x-cloak>
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Drawer Content -->
        <div class="relative flex w-full max-w-[320px] flex-col bg-white overflow-y-auto h-full shadow-2xl"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            
            <div class="flex items-center justify-between bg-[#044b25] text-white px-5 py-4 shrink-0 shadow-md">
                <h2 class="text-base font-bold tracking-wide">Instrumen Akreditasi</h2>
                <button @click="sidebarOpen = false" class="text-white hover:text-[#fecb00] focus:outline-none transition-transform hover:rotate-90">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="p-4 flex-1 overflow-y-auto custom-scrollbar" x-data="{ openMenu: 1 }">
                <!-- Accordion 1 -->
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 1 ? null : 1" class="w-full flex items-center justify-between p-3.5 border rounded-xl bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 font-semibold text-[13px] transition-all shadow-sm"
                            :class="openMenu === 1 ? 'border-slate-300' : 'border-slate-100'">
                        <span class="truncate">1. Komponen Koleksi Perpu...</span>
                        <svg class="w-4 h-4 transform transition-transform text-slate-400" :class="openMenu === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 1" x-collapse>
                        <div class="py-2 pl-5 pr-2 space-y-1 border-l-2 border-slate-100 ml-4 mt-2 mb-2 relative">
                            <div class="absolute w-2 h-2 rounded-full bg-slate-200 -left-[5px] top-4"></div>
                            <a href="#komponen-1-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">1.1 Pengembangan Koleksi</a>
                            <div class="absolute w-2 h-2 rounded-full bg-slate-200 -left-[5px] top-[50px]"></div>
                            <a href="#komponen-1-2" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">1.2 Pengorganisasian Bahan<br>Perpustakaan</a>
                            <div class="absolute w-2 h-2 rounded-full bg-slate-200 -left-[5px] top-[108px]"></div>
                            <a href="#komponen-1-3" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">1.3 Perawatan Koleksi<br>Perpustakaan</a>
                        </div>
                    </div>
                </div>

                <!-- Accordion 2 -->
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 2 ? null : 2" class="w-full flex items-center justify-between p-3.5 border rounded-xl bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 font-semibold text-[13px] transition-all shadow-sm"
                            :class="openMenu === 2 ? 'border-slate-300' : 'border-slate-100'">
                        <span class="truncate">2. Komponen Sarana dan Pra...</span>
                        <svg class="w-4 h-4 transform transition-transform text-slate-400" :class="openMenu === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 2" x-collapse>
                        <div class="py-2 pl-5 pr-2 space-y-1 border-l-2 border-slate-100 ml-4 mt-2 mb-2 relative">
                            <div class="absolute w-2 h-2 rounded-full bg-slate-200 -left-[5px] top-4"></div>
                            <a href="#komponen-2-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">2.1 Prasarana</a>
                        </div>
                    </div>
                </div>

                <!-- Accordion 3 (Active Example from Screenshot 1) -->
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 3 ? null : 3" class="w-full flex items-center justify-between p-3.5 border rounded-xl text-[#0a7a3b] border-[#0a7a3b]/30 bg-[#0a7a3b]/5 hover:bg-[#0a7a3b]/10 font-semibold text-[13px] transition-all shadow-sm"
                            :class="openMenu === 3 ? 'border-[#0a7a3b]/50' : ''">
                        <span class="truncate">3. Komponen Pelayanan Per...</span>
                        <svg class="w-4 h-4 transform transition-transform" :class="openMenu === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 3" x-collapse>
                        <div class="py-2 pl-5 pr-2 space-y-1 border-l-2 border-slate-100 ml-4 mt-2 mb-2 relative">
                            <a href="#komponen-3-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.1 Jenis Pelayanan</a>
                            <a href="#komponen-3-2" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.2 Jam Buka</a>
                            <a href="#komponen-3-3" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.3 Sarana Akses/Penelusuran</a>
                            <a href="#komponen-3-4" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.4 Keanggotaan</a>
                            <a href="#komponen-3-5" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.5 Jumlah Pengunjung dan<br>Buku yang Dipinjam</a>
                            <a href="#komponen-3-6" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.6 Promosi</a>
                            <a href="#komponen-3-7" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">3.7 Literasi Informasi</a>
                        </div>
                    </div>
                </div>
                
                <!-- Accordion 4, 5, 6 -->
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 4 ? null : 4" class="w-full text-left flex items-center justify-between p-3.5 border rounded-xl bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 font-semibold text-[13px] transition-all shadow-sm">
                        <span class="pr-2 leading-tight">4. Komponen Tenaga Perpustakaan</span>
                        <svg class="w-4 h-4 shrink-0 transform transition-transform text-slate-400" :class="openMenu === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 4" x-collapse>
                        <div class="p-2 bg-slate-50 border border-t-0 rounded-b-xl border-slate-100 space-y-1">
                            <a href="#komponen-4-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">4.1 Kualifikasi Tenaga</a>
                            <a href="#komponen-4-2" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">4.2 Jumlah Tenaga Perpustakaan</a>
                            <a href="#komponen-4-3" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">4.3 Pembinaan dan Pengembangan Kompetensi</a>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 5 ? null : 5" class="w-full text-left flex items-center justify-between p-3.5 border rounded-xl bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 font-semibold text-[13px] transition-all shadow-sm">
                        <span class="pr-2 leading-tight">5. Komponen Penyelenggaraan Perpustakaan</span>
                        <svg class="w-4 h-4 shrink-0 transform transition-transform text-slate-400" :class="openMenu === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 5" x-collapse>
                        <div class="p-2 bg-slate-50 border border-t-0 rounded-b-xl border-slate-100 space-y-1">
                            <a href="#komponen-5-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.1 Status Organisasi</a>
                            <a href="#komponen-5-2" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.2 Kelengkapan Perangkat Aturan Organisasi</a>
                            <a href="#komponen-5-3" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.3 Kelengkapan Perangkat Manajemen</a>
                            <a href="#komponen-5-4" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.4 Kelengkapan Struktur Organisasi</a>
                            <a href="#komponen-5-5" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.5 Pelibatan Sivitas Akademika dalam Penyelenggaraan</a>
                            <a href="#komponen-5-6" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.6 Komitmen Pimpinan Universitas</a>
                            <a href="#komponen-5-7" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">5.7 Pengakuan-Rekognisi Kinerja</a>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button @click="openMenu = openMenu === 6 ? null : 6" class="w-full text-left flex items-center justify-between p-3.5 border rounded-xl bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-300 font-semibold text-[13px] transition-all shadow-sm">
                        <span class="pr-2 leading-tight">6. Komponen Pengelolaan Perpustakaan</span>
                        <svg class="w-4 h-4 shrink-0 transform transition-transform text-slate-400" :class="openMenu === 6 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openMenu === 6" x-collapse>
                        <div class="p-2 bg-slate-50 border border-t-0 rounded-b-xl border-slate-100 space-y-1">
                            <a href="#komponen-6-1" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">6.1 Anggaran Perpustakaan</a>
                            <a href="#komponen-6-2" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">6.2 Kelengkapan Perangkat Teknologi</a>
                            <a href="#komponen-6-3" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">6.3 Kerja Sama Perpustakaan</a>
                            <a href="#komponen-6-4" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">6.4 Inovasi dalam Pengelolaan Perpustakaan</a>
                            <a href="#komponen-6-5" class="block py-2 px-3 text-[13px] text-slate-600 hover:bg-slate-50 hover:text-[#0a7a3b] font-medium rounded-lg transition-colors">6.5 Dukungan Perpustakaan dalam Akreditasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-8 xl:gap-12 items-start relative">
            
            <!-- Left Sidebar (Desktop Navigation) -->
            <aside class="w-full lg:w-[320px] shrink-0 sticky top-28 max-h-[calc(100vh-8rem)] overflow-y-auto custom-scrollbar hidden lg:block pb-10">
                <div class="bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-[#0a7a3b] text-white p-5 flex items-center gap-4">
                        <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center shrink-0 border border-white/30 backdrop-blur-sm shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-lg leading-tight tracking-tight">Navigasi Cepat</h3>
                            <p class="text-[11px] text-white/90 font-bold uppercase tracking-widest mt-1">DAFTAR ISI</p>
                        </div>
                    </div>
                    
                    <div class="p-6 relative bg-white" x-data="{ activeSection: '1.1', openMenu: 1 }">
                        <!-- connecting vertical line -->
                        <div class="absolute top-10 bottom-8 left-10 w-[2px] bg-slate-200 z-0"></div>
                        
                        <!-- Item 1 -->
                        <div class="relative z-10 mb-8">
                            <button @click="openMenu = openMenu === 1 ? null : 1" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 1 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#0a7a3b] text-white font-bold flex items-center justify-center text-sm shrink-0 shadow-md">1</div>
                                    <span class="font-bold text-[#0a7a3b] text-sm leading-tight">Komponen Koleksi Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <div x-show="openMenu === 1" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                <!-- Sub item active -->
                                <a href="#komponen-1-1" @click="activeSection = '1.1'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '1.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '1.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>1.1 Pengembangan Koleksi</span>
                                </a>
                                
                                <!-- Sub item inactive -->
                                <a href="#komponen-1-2" @click="activeSection = '1.2'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '1.2' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '1.2' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>1.2 Pengorganisasian Bahan<br>Perpustakaan</span>
                                </a>
                                
                                <!-- Sub item inactive -->
                                <a href="#komponen-1-3" @click="activeSection = '1.3'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '1.3' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '1.3' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>1.3 Perawatan Koleksi<br>Perpustakaan</span>
                                </a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="relative z-10 mb-8">
                            <button @click="openMenu = openMenu === 2 ? null : 2" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 2 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#fecb00] text-[#044b25] font-bold flex items-center justify-center text-sm shrink-0 shadow-md">2</div>
                                    <span class="font-bold text-slate-700 text-sm leading-tight">Komponen Sarana dan Prasarana Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu === 2" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                <a href="#komponen-2-1" @click="activeSection = '2.1'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '2.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '2.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>2.1 Prasarana</span>
                                </a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="relative z-10 mb-8">
                            <button @click="openMenu = openMenu === 3 ? null : 3" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 3 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#fecb00] text-[#044b25] font-bold flex items-center justify-center text-sm shrink-0 shadow-md">3</div>
                                    <span class="font-bold text-slate-700 text-sm leading-tight">Komponen Pelayanan Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu === 3" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                <a href="#komponen-3-1" @click="activeSection = '3.1'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '3.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '3.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>3.1 Jenis Pelayanan</span>
                                </a>
                                <a href="#komponen-3-2" @click="activeSection = '3.2'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '3.2' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '3.2' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>3.2 Jam Buka</span>
                                </a>
                                <a href="#komponen-3-3" @click="activeSection = '3.3'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '3.3' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '3.3' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>3.3 Sarana Akses/Penelusuran</span>
                                </a>
                                <a href="#komponen-3-4" @click="activeSection = '3.4'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '3.4' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '3.4' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>3.4 Keanggotaan</span>
                                </a>
                                <a href="#komponen-3-5" @click="activeSection = '3.5'" 
                                   class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group"
                                   :class="activeSection === '3.5' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                    <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors"
                                         :class="activeSection === '3.5' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                    <span>3.5 Jumlah Pengunjung dan Buku</span>
                                </a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="relative z-10 mb-8">
                            <button @click="openMenu = openMenu === 4 ? null : 4" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 4 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#fecb00] text-[#044b25] font-bold flex items-center justify-center text-sm shrink-0 shadow-md">4</div>
                                    <span class="font-bold text-slate-700 text-sm leading-tight">Komponen Tenaga Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu === 4" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                    <a href="#komponen-4-1" @click="activeSection = '4.1'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '4.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '4.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>4.1 Kualifikasi Tenaga</span>
                                    </a>
                                    <a href="#komponen-4-2" @click="activeSection = '4.2'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '4.2' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '4.2' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>4.2 Jumlah Tenaga Perpustakaan</span>
                                    </a>
                                    <a href="#komponen-4-3" @click="activeSection = '4.3'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '4.3' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '4.3' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>4.3 Pembinaan dan Pengembangan Kompetensi</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 5 -->
                        <div class="relative z-10 mb-8">
                            <button @click="openMenu = openMenu === 5 ? null : 5" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 5 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#fecb00] text-[#044b25] font-bold flex items-center justify-center text-sm shrink-0 shadow-md">5</div>
                                    <span class="font-bold text-slate-700 text-sm leading-tight">Komponen Penyelenggaraan Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu === 5" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                    <a href="#komponen-5-1" @click="activeSection = '5.1'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.1 Status Organisasi</span>
                                    </a>
                                    <a href="#komponen-5-2" @click="activeSection = '5.2'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.2' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.2' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.2 Kelengkapan Perangkat Aturan Organisasi</span>
                                    </a>
                                    <a href="#komponen-5-3" @click="activeSection = '5.3'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.3' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.3' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.3 Kelengkapan Perangkat Manajemen</span>
                                    </a>
                                    <a href="#komponen-5-4" @click="activeSection = '5.4'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.4' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.4' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.4 Kelengkapan Struktur Organisasi</span>
                                    </a>
                                    <a href="#komponen-5-5" @click="activeSection = '5.5'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.5' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.5' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.5 Pelibatan Sivitas Akademika dalam Penyelenggaraan</span>
                                    </a>
                                    <a href="#komponen-5-6" @click="activeSection = '5.6'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.6' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.6' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.6 Komitmen Pimpinan Universitas</span>
                                    </a>
                                    <a href="#komponen-5-7" @click="activeSection = '5.7'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '5.7' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '5.7' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>5.7 Pengakuan-Rekognisi Kinerja</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 6 -->
                        <div class="relative z-10">
                            <button @click="openMenu = openMenu === 6 ? null : 6" class="w-full text-left flex items-center justify-between bg-white py-2 pl-2 pr-4 rounded-xl mb-4 shadow-sm border hover:bg-slate-50 transition-colors z-10 relative focus:outline-none" :class="openMenu === 6 ? 'border-slate-200' : 'border-slate-50'">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-[#fecb00] text-[#044b25] font-bold flex items-center justify-center text-sm shrink-0 shadow-md">6</div>
                                    <span class="font-bold text-slate-700 text-sm leading-tight">Komponen Pengelolaan Perpustakaan</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transform transition-transform" :class="openMenu === 6 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="openMenu === 6" x-collapse>
                                <div class="pl-4 space-y-2 relative pb-2">
                                    <a href="#komponen-6-1" @click="activeSection = '6.1'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '6.1' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '6.1' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>6.1 Anggaran Perpustakaan</span>
                                    </a>
                                    <a href="#komponen-6-2" @click="activeSection = '6.2'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '6.2' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '6.2' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>6.2 Kelengkapan Perangkat Teknologi</span>
                                    </a>
                                    <a href="#komponen-6-3" @click="activeSection = '6.3'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '6.3' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '6.3' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>6.3 Kerja Sama Perpustakaan</span>
                                    </a>
                                    <a href="#komponen-6-4" @click="activeSection = '6.4'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '6.4' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '6.4' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>6.4 Inovasi dalam Pengelolaan Perpustakaan</span>
                                    </a>
                                    <a href="#komponen-6-5" @click="activeSection = '6.5'" class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm font-semibold transition-all relative group" :class="activeSection === '6.5' ? 'bg-[#f0f7f3] text-[#0a7a3b]' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800'">
                                        <div class="absolute -left-[20px] top-1/2 -translate-y-1/2 w-[18px] border-t-2 border-dashed transition-colors" :class="activeSection === '6.5' ? 'border-[#0a7a3b]' : 'border-slate-300 group-hover:border-slate-400'"></div>
                                        <span>6.5 Dukungan Perpustakaan dalam Akreditasi</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area (Questionnaire) -->
            <div class="flex-1 space-y-8 w-full max-w-4xl mx-auto xl:mx-0 pb-20">
                
                <div id="komponen-1-1-1" class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                    <div class="p-6 md:p-8 pb-4">
                        <div class="flex items-start gap-4">
                            <h2 class="font-bold text-lg md:text-xl text-[#0a7a3b] leading-tight">1.1.1 Ada kebijakan pengembangan koleksi tertulis yang disahkan pimpinan.</h2>
                        </div>
                    </div>
                    <div class="px-6 md:px-8 pb-8 pt-2">
                        <div class="space-y-4">
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_1" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">A.</span> Ada kebijakan pengembangan koleksi tertulis yang ditinjau setiap tahun</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_1" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">B.</span> Ada kebijakan pengembangan koleksi tertulis yang ditinjau empat tahun sekali</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_1" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">C.</span> Ada kebijakan pengembangan koleksi tertulis yang ditinjau lima tahun sekali</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_1" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">D.</span> Ada kebijakan pengembangan koleksi tertulis yang ditinjau kurang dari tiga tahun atau lebih dari lima tahun</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_1" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">E.</span> Ada kebijakan tetapi tidak tertulis</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div id="komponen-1-1-2" class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                    <div class="p-6 md:p-8 pb-4">
                        <div class="flex items-start gap-4">
                            <h2 class="font-bold text-lg md:text-xl text-[#0a7a3b] leading-tight">1.1.2 Pelaksanaan kebijakan (jenis, jumlah, bentuk, subjek koleksi, kemutakhiran, dll)</h2>
                        </div>
                    </div>
                    <div class="px-6 md:px-8 pb-8 pt-2">
                        <div class="space-y-4">
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_2" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">A.</span> 7 komponen kebijakan atau lebih dilaksanakan</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_2" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">B.</span> 6 komponen kebijakan atau lebih dilaksanakan</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_2" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">C.</span> 5 komponen kebijakan atau lebih dilaksanakan</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_2" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">D.</span> 4 komponen kebijakan atau lebih dilaksanakan</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_2" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">E.</span> Kurang dari 4 komponen kebijakan dilaksanakan</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div id="komponen-1-1-5" class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                    <div class="p-6 md:p-8 pb-4">
                        <div class="flex items-start gap-4">
                            <h2 class="font-bold text-lg md:text-xl text-[#0a7a3b] leading-tight">1.1.5 Jumlah buku tercetak (diluar skripsi, tesis, disertasi, dan laporan penelitian)</h2>
                        </div>
                    </div>
                    <div class="px-6 md:px-8 pb-8 pt-2">
                        <div class="space-y-4">
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_5" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">A.</span> 15.000 judul atau lebih</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_5" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">B.</span> 10.000 - 14.999 judul</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_5" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">C.</span> 5.000 - 9.999 judul</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_5" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">D.</span> 2.500 - 4.999 judul</span>
                            </label>
                            <label class="flex items-start gap-4 p-4 rounded-xl border border-slate-100 cursor-pointer hover:bg-slate-50 hover:border-[#0a7a3b]/30 transition-all shadow-sm">
                                <input type="radio" name="q_1_1_5" class="mt-1 w-5 h-5 text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-slate-700 leading-relaxed"><span class="font-bold text-slate-800 mr-2">E.</span> Kurang dari 2.500 judul</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
