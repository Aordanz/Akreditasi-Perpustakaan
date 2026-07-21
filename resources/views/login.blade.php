<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login Admin - Perpustakaan USU') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        
        .floating-input {
            border: 2px solid transparent;
            background-color: #f1f5f9;
            transition: all 0.3s ease;
        }
        .floating-input:focus {
            background-color: white;
            border-color: #0a7a3b;
            box-shadow: 0 4px 20px rgba(10, 122, 59, 0.1);
        }
        .floating-label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            transition: all 0.3s ease;
            pointer-events: none;
            font-size: 1rem;
        }
        .floating-input:focus ~ .floating-label,
        .floating-input:not(:placeholder-shown) ~ .floating-label {
            top: 0;
            transform: translateY(-50%) scale(0.85);
            background-color: white;
            padding: 0 0.5rem;
            color: #0a7a3b;
            font-weight: 700;
        }

        .bg-pattern {
            background-color: #044b25;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(141, 198, 63, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(254, 203, 0, 0.2) 0%, transparent 50%);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center relative overflow-hidden bg-white">

    <!-- Split Layout Container -->
    <div class="flex w-full min-h-screen">
        
        <!-- Left Side: Branding / Imagery -->
        <div class="hidden lg:flex flex-col w-1/2 bg-pattern text-white relative overflow-hidden items-center justify-center p-12">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#fecb00] rounded-full mix-blend-screen filter blur-[100px] opacity-20 -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#0a7a3b] rounded-full mix-blend-screen filter blur-[100px] opacity-40 -ml-20 -mb-20"></div>
            
            <div class="relative z-10 w-full max-w-md" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">
                <div x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-3xl inline-block mb-8 border border-white/20 shadow-xl">
                        <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-16 h-16 object-contain rounded-xl bg-white p-1">
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-black mb-4 leading-tight">
                        {{ __('Sistem Informasi') }} <br>
                        <span class="text-[#fecb00]">{{ __('Akreditasi') }}</span>
                    </h1>
                    <p class="text-white/80 text-lg leading-relaxed mb-12">
                        {{ __('Portal admin Perpustakaan Universitas Sumatera Utara untuk mengelola dokumen dan instrumen akreditasi secara terpusat.') }}
                    </p>
                    
                    <div class="flex items-center gap-4 bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-sm">
                        <div class="w-12 h-12 rounded-full bg-[#0a7a3b] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold">{{ __('Akses Aman') }}</h4>
                            <p class="text-sm text-white/70">{{ __('Sistem dilindungi enkripsi terkini') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white relative z-10">
            
            <div class="max-w-md w-full mx-auto" x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)">
                <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
                    
                    <!-- Mobile Logo (hides on desktop) -->
                    <div class="lg:hidden flex items-center gap-3 mb-10">
                        <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 object-contain rounded-lg shadow-sm border border-slate-100">
                        <div>
                            <span class="block font-black text-slate-800 leading-tight">{{ __('Perpustakaan') }}</span>
                            <span class="block text-xs font-bold text-[#0a7a3b] uppercase tracking-wider">{{ __('Universitas Sumatera Utara') }}</span>
                        </div>
                    </div>

                    <div class="mb-10">
                        <h2 class="text-3xl font-black text-slate-900 mb-2">{{ __('Selamat Datang') }}</h2>
                        <p class="text-slate-500 font-medium">{{ __('Silakan login untuk mengakses panel administrator.') }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl shadow-sm flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-semibold">{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="relative group">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder=" " 
                                   class="floating-input w-full px-4 py-4 rounded-xl outline-none text-slate-800 font-medium z-10 relative bg-transparent">
                            <label for="email" class="floating-label z-20">{{ __('Alamat Email') }}</label>
                            
                            <!-- Icon inside input -->
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 group-focus-within:text-[#0a7a3b] transition-colors z-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                        </div>

                        <div class="relative group" x-data="{ showPass: false }">
                            <input :type="showPass ? 'text' : 'password'" name="password" id="password" required placeholder=" " 
                                   class="floating-input w-full px-4 py-4 rounded-xl outline-none text-slate-800 font-medium z-10 relative bg-transparent pr-12">
                            <label for="password" class="floating-label z-20">{{ __('Kata Sandi') }}</label>
                            
                            <button type="button" @click="showPass = !showPass" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-[#0a7a3b] focus:text-[#0a7a3b] transition-colors z-20 focus:outline-none">
                                <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.29 3.29m0 0a10.05 10.05 0 015.42-2.81m5.858 2.572c1.756.96 3.22 2.44 4.08 4.21A10.05 10.05 0 0115 19.33"></path></svg>
                                <svg x-show="showPass" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-[#0a7a3b] rounded border-slate-300 focus:ring-[#0a7a3b]">
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-800 transition-colors">{{ __('Ingat Saya') }}</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-[#0a7a3b] hover:bg-[#044b25] text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-[0_4px_14px_0_rgba(10,122,59,0.39)] hover:shadow-[0_6px_20px_rgba(10,122,59,0.23)] hover:-translate-y-0.5 flex justify-center items-center gap-2 group">
                            {{ __('Masuk ke Sistem') }}
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                    
                    <div class="mt-10 pt-8 border-t border-slate-100 text-center">
                        <a href="/akreditasi" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-[#0a7a3b] transition-colors group">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-[#0a7a3b] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </div>
                            {{ __('Kembali ke Halaman Publik') }}
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>
