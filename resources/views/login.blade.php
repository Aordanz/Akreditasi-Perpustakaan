<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login Administrator - Akreditasi Perpustakaan USU') }}</title>
    <link rel="icon" href="{{ asset('logousu.jpeg') }}" type="image/jpeg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Plus Jakarta Sans & Public Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Public+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #0f172a; 
        }
        
        .font-public {
            font-family: 'Public Sans', sans-serif;
        }

        .hero-bg-overlay {
            background: linear-gradient(135deg, rgba(4, 75, 37, 0.94) 0%, rgba(10, 122, 59, 0.88) 50%, rgba(2, 44, 21, 0.96) 100%);
        }

        .gold-glow {
            text-shadow: 0 0 25px rgba(254, 203, 0, 0.45);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .custom-input {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .custom-input:focus {
            box-shadow: 0 0 0 4px rgba(10, 122, 59, 0.12), 0 4px 16px rgba(10, 122, 59, 0.08);
        }

        /* Subtle animated background mesh */
        .bg-mesh-light {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(10, 122, 59, 0.04) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(254, 203, 0, 0.05) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(241, 245, 249, 1) 0px, transparent 100%);
        }

        @keyframes pulse-subtle {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.05); }
        }
        .animate-pulse-subtle {
            animation: pulse-subtle 8s infinite ease-in-out;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-stretch overflow-x-hidden">

    <!-- Container Full Screen Split Layout -->
    <div class="flex w-full min-h-screen">
        
        <!-- Left Side: USU Library Visual Showcase & Branding -->
        <div class="hidden lg:flex flex-col justify-between w-[52%] xl:w-[55%] relative overflow-hidden text-white p-12 xl:p-16">
            
            <!-- Real Library Background Image with Rich Overlay -->
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
                 style="background-image: url('{{ asset('kolam_perpustakaan.jpg') }}');">
            </div>
            
            <!-- Gradient & Pattern Overlay -->
            <div class="absolute inset-0 hero-bg-overlay"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-15 mix-blend-overlay"></div>

            <!-- Glowing Decorative Circles -->
            <div class="absolute top-10 right-10 w-80 h-80 bg-[#fecb00] rounded-full mix-blend-screen filter blur-[110px] animate-pulse-subtle"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-[#8dc63f] rounded-full mix-blend-screen filter blur-[130px] opacity-30"></div>

            <!-- Header Top: Official USU Library Identity -->
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="p-2 bg-white rounded-2xl shadow-xl border border-white/30 backdrop-blur-md">
                        <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-11 h-11 object-contain">
                    </div>
                    <div>
                        <span class="block font-public font-bold text-xs uppercase tracking-[0.2em] text-[#fecb00] drop-shadow">
                            Universitas Sumatera Utara
                        </span>
                        <span class="block font-black text-lg text-white tracking-tight">
                            Perpustakaan Pusat
                        </span>
                    </div>
                </div>

                <!-- Live Tag Badge -->
                <div class="glass-card px-3.5 py-1.5 rounded-full flex items-center gap-2 text-xs font-semibold text-white/90 shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-[#fecb00] animate-ping"></span>
                    <span>Sistem Akreditasi</span>
                </div>
            </div>

            <!-- Center Content: Title, Description & Feature Highlights -->
            <div class="relative z-10 my-auto py-10 max-w-xl" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 150)">
                <div x-show="loaded" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-white/10 border border-white/20 text-[#fecb00] text-xs font-bold uppercase tracking-wider mb-6 backdrop-blur-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span>Standar Nasional Perpustakaan (SNP)</span>
                    </div>

                    <h1 class="text-4xl xl:text-5xl font-black text-white leading-[1.18] tracking-tight mb-5">
                        Portal Manajemen <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fecb00] via-[#ffe066] to-[#fecb00] gold-glow">
                            Akreditasi Perpustakaan
                        </span>
                    </h1>

                    <p class="text-white/85 text-base xl:text-lg leading-relaxed mb-8 font-normal">
                        Platform terintegrasi pengelolaan portofolio instrumen, dokumen bukti fisik, dan evaluasi berkala akreditasi Perpustakaan Universitas Sumatera Utara.
                    </p>



                </div>
            </div>

            <!-- Footer Left Info -->
            <div class="relative z-10 flex items-center justify-between text-xs text-white/70 pt-6 border-t border-white/15">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Jl. Perpustakaan No. 1, Kampus USU Padang Bulan, Medan</span>
                </div>
                <a href="https://library.usu.ac.id" target="_blank" class="hover:text-[#fecb00] transition-colors flex items-center gap-1 font-semibold">
                    <span>library.usu.ac.id</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>

        </div>

        <!-- Right Side: Clean Elevated Login Card -->
        <div class="w-full lg:w-[48%] xl:w-[45%] bg-mesh-light flex flex-col justify-between p-6 sm:p-12 lg:p-14 xl:p-16 relative z-10 min-h-screen overflow-y-auto">
            
            <!-- Mobile Brand Header (Visible only on mobile/tablet) -->
            <div class="lg:hidden flex items-center justify-between pb-6 mb-4 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="p-1.5 bg-white rounded-xl shadow-md border border-slate-100">
                        <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-9 h-9 object-contain">
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-[#0a7a3b] uppercase tracking-wider">Perpustakaan USU</span>
                        <span class="block font-black text-sm text-slate-900 leading-tight">Akreditasi Online</span>
                    </div>
                </div>
                <span class="text-xs px-2.5 py-1 bg-emerald-100 text-[#0a7a3b] rounded-full font-bold">Admin</span>
            </div>

            <div class="hidden lg:block"></div> <!-- Spacer for flex layout -->

            <!-- Main Form Card Box -->
            <div class="max-w-md w-full mx-auto my-auto py-4" x-data="{ show: false }" x-init="setTimeout(() => show = true, 250)">
                <div x-show="show" x-transition:enter="transition ease-out duration-600" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                    
                    <!-- Form Container Card -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-[0_20px_50px_rgba(8,112,60,0.08)] border border-slate-100 relative">
                        
                        <!-- Top Decorative Brand Pill -->
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#0a7a3b] to-[#044b25] flex items-center justify-center text-white shadow-md shadow-emerald-900/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <span class="text-xs font-bold text-[#0a7a3b] uppercase tracking-widest">Portal Administrator</span>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-2">
                                {{ __('Selamat Datang') }}
                            </h2>
                            <p class="text-slate-500 text-sm font-medium leading-relaxed">
                                {{ __('Masukkan email dan kata sandi akun administrator Anda untuk mengelola dokumen akreditasi.') }}
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 bg-red-50/90 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm flex items-start gap-3 text-sm">
                                <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-semibold">{{ $errors->first() }}</span>
                            </div>
                        @endif

                        <form action="/login" method="POST" class="space-y-5">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="space-y-2">
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                    {{ __('Alamat Email') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                                           class="custom-input w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white text-slate-900 text-sm font-medium outline-none focus:border-[#0a7a3b]">
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="space-y-2" x-data="{ showPass: false }">
                                <div class="flex items-center justify-between">
                                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                        {{ __('Kata Sandi') }} <span class="text-red-500">*</span>
                                    </label>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <input :type="showPass ? 'text' : 'password'" name="password" id="password" required 
                                           class="custom-input w-full pl-11 pr-12 py-3.5 rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white text-slate-900 text-sm font-medium outline-none focus:border-[#0a7a3b]">
                                    
                                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#0a7a3b] focus:text-[#0a7a3b] transition-colors focus:outline-none" aria-label="Toggle password visibility">
                                        <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.29 3.29m0 0a10.05 10.05 0 015.42-2.81m5.858 2.572c1.756.96 3.22 2.44 4.08 4.21A10.05 10.05 0 0115 19.33"></path></svg>
                                        <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Remember Checkbox -->
                            <div class="flex items-center justify-between pt-1">
                                <label class="flex items-center gap-2.5 cursor-pointer select-none group">
                                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#0a7a3b] border-slate-300 focus:ring-[#0a7a3b] focus:ring-offset-0 transition-colors">
                                    <span class="text-xs font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Ingat sesi saya') }}</span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" class="w-full relative overflow-hidden bg-gradient-to-r from-[#0a7a3b] to-[#044b25] hover:from-[#086a33] hover:to-[#033c1d] text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-[0_8px_20px_rgba(10,122,59,0.28)] hover:shadow-[0_10px_25px_rgba(10,122,59,0.38)] hover:-translate-y-0.5 flex justify-center items-center gap-2.5 group cursor-pointer">
                                    <span class="tracking-wide">{{ __('Masuk ke Sistem') }}</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Bottom Copyright & Footer -->
            <div class="text-center pt-6 pb-2 text-xs text-slate-400 font-medium">
                <p>&copy; {{ date('Y') }} Perpustakaan Universitas Sumatera Utara. Seluruh hak cipta dilindungi.</p>
            </div>

        </div>

    </div>

</body>
</html>

