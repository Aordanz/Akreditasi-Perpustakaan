<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan USU')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        [x-cloak] { display: none !important; }
        
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #0a7a3b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #044b25; }
    </style>
    @stack('styles')
</head>
<body class="text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Topbar -->
    <div class="bg-[#044b25] text-white py-1.5 px-4 text-[11px] md:text-xs flex justify-center md:justify-end gap-3 md:gap-6 font-medium tracking-wide z-50 relative shadow-inner">
        <a href="#" class="hover:text-[#fecb00] transition-colors duration-300">USU Official</a>
        <a href="#" class="hover:text-[#fecb00] transition-colors duration-300">MBKM</a>
        <a href="#" class="hover:text-[#fecb00] transition-colors duration-300">DIGILIB</a>
        <a href="#" class="hover:text-[#fecb00] transition-colors duration-300">Repositori USU</a>
        <span class="border-l border-white/20 pl-3 md:pl-6 flex items-center gap-1.5 cursor-pointer hover:text-[#fecb00] transition-colors duration-300">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
            EN
        </span>
    </div>

    <!-- Header / Navbar (Glassmorphism) -->
    <header class="sticky top-0 z-40 transition-all duration-300 backdrop-blur-md bg-white/80 border-b border-slate-200/50" 
            x-data="{ scrolled: false, mobileMenu: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 10)" 
            :class="{ 'shadow-lg border-b-[#0a7a3b] border-b-[3px] py-1': scrolled, 'py-3': !scrolled }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300 h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 md:gap-4 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#0a7a3b] rounded-full blur-md opacity-0 group-hover:opacity-40 transition duration-500"></div>
                        <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 md:w-14 md:h-14 object-contain relative z-10 transform group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="font-black text-lg md:text-xl text-slate-900 tracking-tight leading-tight">Perpustakaan</span>
                        <span class="font-bold text-xs md:text-sm text-[#0a7a3b] tracking-wide uppercase">Universitas Sumatera Utara</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center gap-8 font-semibold text-sm">
                    <a href="/" class="group relative py-2">
                        <span class="{{ request()->is('/') ? 'text-[#0a7a3b]' : 'text-slate-600 group-hover:text-[#0a7a3b]' }} transition-colors duration-300">Beranda</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#0a7a3b] rounded-full transform origin-left transition-transform duration-300 {{ request()->is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    
                    <a href="/profil" class="group relative py-2">
                        <span class="{{ request()->is('profil') ? 'text-[#0a7a3b]' : 'text-slate-600 group-hover:text-[#0a7a3b]' }} transition-colors duration-300">Profil</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#0a7a3b] rounded-full transform origin-left transition-transform duration-300 {{ request()->is('profil') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    


                    <a href="/akreditasi" class="group relative py-2">
                        <span class="{{ request()->is('akreditasi') ? 'text-[#0a7a3b]' : 'text-slate-600 group-hover:text-[#0a7a3b]' }} transition-colors duration-300">Akreditasi</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#0a7a3b] rounded-full transform origin-left transition-transform duration-300 {{ request()->is('akreditasi') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    
                    @auth
                        <div class="w-px h-6 bg-slate-300"></div>
                        <a href="{{ route('admin.dashboard') }}" class="bg-[#0a7a3b] hover:bg-[#044b25] text-white px-5 py-2 rounded-full font-bold transition-colors text-sm shadow-md shadow-[#0a7a3b]/20 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Dashboard Admin
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-5 py-2 rounded-full transition-all duration-300 font-bold shadow-sm hover:shadow-md border border-red-100 hover:border-red-500 flex items-center gap-2">
                                <span>Logout</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    @endauth
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-slate-600 hover:text-[#0a7a3b] focus:outline-none">
                    <svg x-show="!mobileMenu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenu" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation (Alpine) -->
        <div x-show="mobileMenu" x-collapse x-cloak class="lg:hidden bg-white border-t border-slate-100 shadow-xl absolute w-full">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="/" class="block px-4 py-3 rounded-xl {{ request()->is('/') ? 'bg-green-50 text-[#0a7a3b] font-bold' : 'text-slate-600 hover:bg-slate-50' }}">Beranda</a>
                <a href="/profil" class="block px-4 py-3 rounded-xl {{ request()->is('profil') ? 'bg-green-50 text-[#0a7a3b] font-bold' : 'text-slate-600 hover:bg-slate-50' }}">Profil</a>

                <a href="/akreditasi" class="block px-4 py-3 rounded-xl {{ request()->is('akreditasi') ? 'bg-green-50 text-[#0a7a3b] font-bold' : 'text-slate-600 hover:bg-slate-50' }}">Akreditasi</a>
                    @auth
                        <div class="border-t border-slate-100 my-2 pt-2">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl bg-[#0a7a3b]/10 text-[#0a7a3b] font-bold mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Dashboard Admin
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-bold">Logout</button>
                            </form>
                        </div>
                    @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Sleek Dark Footer -->
    <footer class="bg-[#044b25] text-green-50 pt-16 pb-8 border-t-4 border-[#fecb00] mt-auto relative overflow-hidden">
        <!-- Abstract shape in footer -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-[#fecb00] opacity-10 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-[#0a7a3b] opacity-20 blur-3xl pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="/" class="flex items-center gap-3 mb-6 group">
                        <div class="rounded-full group-hover:shadow-[0_0_15px_rgba(254,203,0,0.5)] transition duration-300">
                            <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 object-cover rounded-full bg-white">
                        </div>
                        <div>
                            <span class="block font-bold text-white text-lg leading-tight group-hover:text-[#fecb00] transition duration-300">Perpustakaan</span>
                            <span class="block font-medium text-[#0a7a3b] text-xs uppercase tracking-wider">Universitas Sumatera Utara</span>
                        </div>
                    </a>
                    <p class="text-green-100/80 text-sm leading-relaxed mb-6 max-w-md">
                        Menjadi pusat sumber belajar dan informasi yang unggul untuk mendukung pencapaian visi Universitas Sumatera Utara sebagai institusi bereputasi internasional.
                    </p>
                    <div class="flex gap-4">
                        <!-- X (Twitter) -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-black hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#E1306C] hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF0000] hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase tracking-wider text-sm border-b border-white/20 pb-2">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-green-100/80 hover:text-[#fecb00] hover:translate-x-1 inline-block transition-all duration-300">Profil Perpustakaan</a></li>
                        <li><a href="#" class="text-green-100/80 hover:text-[#fecb00] hover:translate-x-1 inline-block transition-all duration-300">Layanan Anggota</a></li>
                        <li><a href="/akreditasi" class="text-green-100/80 hover:text-[#fecb00] hover:translate-x-1 inline-block transition-all duration-300">Akreditasi & Mutu</a></li>
                        <li><a href="#" class="text-green-100/80 hover:text-[#fecb00] hover:translate-x-1 inline-block transition-all duration-300">Repositori Institusi</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase tracking-wider text-sm border-b border-white/20 pb-2">Kontak Kami</h3>
                    <ul class="space-y-4 text-green-100/80">
                        <li class="flex items-start gap-3 hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5 text-[#fecb00] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm">Jl. Perpustakaan No.1, Kampus USU Padang Bulan, Medan 20155</span>
                        </li>
                        <li class="flex items-center gap-3 hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5 text-[#fecb00] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-sm">+62 61 8218666</span>
                        </li>
                        <li class="flex items-center gap-3 hover:text-white transition-colors duration-300">
                            <svg class="w-5 h-5 text-[#fecb00] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-sm">library@usu.ac.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-white/10 text-center md:flex md:justify-between md:items-center text-xs md:text-sm text-green-100/60">
                <p>&copy; {{ date('Y') }} Perpustakaan Universitas Sumatera Utara. All rights reserved.</p>
                <div class="mt-4 md:mt-0 space-x-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: false,
                offset: 50
            });
        });
    </script>
</body>
</html>
