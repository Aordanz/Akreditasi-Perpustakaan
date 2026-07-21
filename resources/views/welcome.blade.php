@extends('layouts.app')
@section('title', __('Akreditasi Perpustakaan USU'))

@push('styles')
<style>
    .hero-bg {
        background: linear-gradient(135deg, #044b25 0%, #0a7a3b 50%, #1e8749 100%);
        position: relative;
        overflow: hidden;
    }
    .hero-bg::before {
        content: "";
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle at 50% 50%, rgba(141,198,63,0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(254,203,0,0.1) 0%, transparent 40%);
        z-index: 0;
        animation: pulse-slow 15s infinite alternate;
    }
    @keyframes pulse-slow {
        0% { transform: scale(1) rotate(0deg); opacity: 0.7; }
        100% { transform: scale(1.1) rotate(5deg); opacity: 1; }
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .float-anim {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    /* Counter animation style */
    .counter-value {
        font-variant-numeric: tabular-nums;
    }
</style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="hero-bg text-white pt-24 pb-32 px-4 relative">
        <div class="max-w-7xl mx-auto relative z-10 flex flex-col-reverse lg:flex-row items-center gap-16">
            
            <!-- Text Content -->
            <div class="flex-1 space-y-8">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <span class="inline-block py-1 px-3 rounded-full bg-[#fecb00] text-[#044b25] text-sm font-bold tracking-wider uppercase mb-4 shadow-lg shadow-[#fecb00]/20">{{ __('Standar Nasional') }}</span>
                    <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight mb-4 drop-shadow-xl">
                        {{ __('Akreditasi Unggul') }} <br>
                        <span class="text-[#8dc63f]">{{ __('Perpustakaan USU') }}</span>
                    </h1>
                    <p class="text-lg md:text-xl text-white/80 max-w-xl leading-relaxed">
                        {{ __('Mewujudkan layanan prima dan infrastruktur berstandar nasional menuju universitas bereputasi global.') }}
                    </p>
                </div>
                
                <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <a href="/akreditasi" class="bg-[#fecb00] text-[#044b25] px-8 py-3.5 rounded-full font-extrabold hover:bg-white hover:text-[#0a7a3b] transition duration-300 shadow-[0_0_20px_rgba(254,203,0,0.4)] hover:shadow-[0_0_30px_rgba(255,255,255,0.6)] transform hover:-translate-y-1 flex items-center gap-2">
                        {{ __('Lihat Instrumen') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <button class="glass-card text-white px-8 py-3.5 rounded-full font-bold hover:bg-white/10 transition duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ __('Tonton Video Profil') }}
                    </button>
                </div>
            </div>
            
            <!-- Hero Illustration/Element -->
            <div class="flex-1 relative w-full max-w-lg mx-auto">
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400" class="relative">
                    
                    <!-- Decorative glowing orb -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-[#fecb00] rounded-full mix-blend-screen filter blur-[80px] opacity-40"></div>
                    
                    <!-- Main Card -->
                    <div class="glass-card p-6 md:p-8 rounded-3xl shadow-2xl relative z-10 border-t border-l border-white/20 float-anim">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">{{ __('Kategori "A"') }}</h3>
                                    <p class="text-white/70 text-sm">{{ __('Perpusnas RI') }}</p>
                                </div>
                            </div>
                            <span class="bg-green-400/20 text-green-300 text-xs font-bold px-2 py-1 rounded-lg">{{ __('Terakreditasi') }}</span>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-[#fecb00] w-[95%]"></div>
                            </div>
                            <div class="flex justify-between text-sm text-white/80">
                                <span>{{ __('Kesesuaian Standar') }}</span>
                                <span class="font-bold text-white">95%</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- Bottom Curve/Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-[calc(100%+1.3px)] h-[50px] md:h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.98,131,201.2,122.9,243.6,118,283.4,103.5,321.39,56.44Z" class="fill-[#f8fafc]"></path>
            </svg>
        </div>
    </section>

    <!-- Animated Counters Section -->
    <section class="py-12 -mt-10 relative z-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-slate-100 flex flex-wrap justify-between gap-8 md:gap-4 items-center">
                
                <div class="text-center w-full md:w-auto flex-1" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-4xl md:text-5xl font-black text-[#0a7a3b] mb-2 flex justify-center items-baseline" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < 9) count++; else clearInterval(interval); }, 150)">
                        <span x-text="count">0</span><span class="text-2xl">+</span>
                    </div>
                    <p class="text-slate-500 font-semibold">{{ __('Tahun Pengalaman') }}</p>
                </div>
                
                <div class="hidden md:block w-px h-16 bg-slate-200"></div>
                
                <div class="text-center w-full md:w-auto flex-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl md:text-5xl font-black text-[#0a7a3b] mb-2 flex justify-center items-baseline" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < 42) count += 2; else clearInterval(interval); }, 50)">
                        <span x-text="count">0</span><span class="text-2xl">K</span>
                    </div>
                    <p class="text-slate-500 font-semibold">{{ __('Koleksi Digital & Cetak') }}</p>
                </div>
                
                <div class="hidden md:block w-px h-16 bg-slate-200"></div>

                <div class="text-center w-full md:w-auto flex-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl md:text-5xl font-black text-[#0a7a3b] mb-2 flex justify-center items-baseline" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < 6) count++; else clearInterval(interval); }, 200)">
                        <span x-text="count">0</span>
                    </div>
                    <p class="text-slate-500 font-semibold">{{ __('Komponen Akreditasi') }}</p>
                </div>
                
                <div class="hidden md:block w-px h-16 bg-slate-200"></div>
                
                <div class="text-center w-full md:w-auto flex-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl md:text-5xl font-black text-[#0a7a3b] mb-2 flex justify-center items-baseline" x-data="{ count: 0 }" x-intersect.once="let interval = setInterval(() => { if(count < 100) count += 5; else clearInterval(interval); }, 50)">
                        <span x-text="count">0</span><span class="text-2xl">%</span>
                    </div>
                    <p class="text-slate-500 font-semibold">{{ __('Standar Operasional') }}</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Highlighted Feature: Bento Box Style -->
    <section class="py-20 bg-[#f8fafc]" x-data="{ activeAccordion: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <span class="text-[#0a7a3b] font-bold tracking-widest uppercase text-sm mb-2 block">{{ __('Pencapaian Terbaik') }}</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-6">{{ __('Fokus Komponen 5: Administrasi') }}</h2>
                <p class="text-slate-600 text-lg">{{ __('Penyelenggaraan dan Pengelolaan Perpustakaan yang mencapai skor maksimal berdasarkan instrumen Perka PNRI No. 10/2018.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Large Featured Box -->
                <div data-aos="fade-up" data-aos-duration="1000" class="md:col-span-2 bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group overflow-hidden relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-green-50 rounded-full filter blur-3xl -mr-20 -mt-20 opacity-50 group-hover:opacity-100 transition duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-[#0a7a3b] text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-[#0a7a3b]/30 group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-3 group-hover:text-[#0a7a3b] transition-colors">{{ __('Kebijakan & Manajemen Mutu') }}</h3>
                        <p class="text-slate-600 leading-relaxed mb-4">{!! __('Sertifikasi <strong>ISO 9001:2015</strong> membuktikan implementasi Sistem Manajemen Mutu secara tertulis, terstruktur, dan dievaluasi rutin.') !!}</p>
                        
                        <!-- Extra Info on Hover -->
                        <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mb-6">
                            <p class="text-slate-500 text-sm leading-relaxed italic">{{ __('Kejelasan struktur tata kelola ini memastikan setiap layanan (Mulai dari sirkulasi hingga digitalisasi) memenuhi standar baku yang disyaratkan oleh Perpustakaan Nasional RI dan audit PTN-BH.') }}</p>
                        </div>

                        <a href="/akreditasi" class="inline-flex items-center text-[#0a7a3b] font-bold hover:gap-2 transition-all">
                            {{ __('Lihat Dokumen Bukti') }} <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Small Box 1 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="bg-gradient-to-br from-[#0a7a3b] to-[#044b25] rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-500 text-white group relative overflow-hidden">
                    <!-- Decor -->
                    <svg class="absolute bottom-0 right-0 text-white/10 w-40 h-40 transform translate-x-10 translate-y-10 group-hover:scale-110 transition duration-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    
                    <div class="relative z-10 h-full flex flex-col justify-center">
                        <h3 class="text-4xl font-black text-[#fecb00] mb-2 text-shadow">{{ __('Skor 4') }}</h3>
                        <p class="font-bold text-lg mb-2">{{ __('Nilai Maksimal') }}</p>
                        <p class="text-white/80 text-sm">{{ __('Diraih pada seluruh sub-komponen Administrasi, menunjukkan standar tertinggi tata kelola.') }}</p>
                        
                        <!-- Extra Info on Hover -->
                        <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-white/20">
                            <p class="text-[#fecb00] text-xs leading-relaxed italic">{{ __('Skor ini adalah bukti pengakuan resmi Asesor atas komitmen institusi dalam merawat aset bernilai sejarah dan fungsi intelektual.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Small Box 2 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group">
                    <div class="w-12 h-12 bg-[#fecb00] text-[#044b25] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-[#0a7a3b] transition-colors">{{ __('Evaluasi Rutin') }}</h3>
                    <p class="text-slate-500 text-sm">{{ __('Monitoring berkala fasilitas dan layanan sesuai Rencana Strategis.') }}</p>
                    
                    <!-- Extra Info on Hover -->
                    <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-slate-100">
                        <p class="text-slate-500 text-xs leading-relaxed italic">{{ __('Laporan triwulanan diterbitkan secara publik sebagai wujud transparansi dan peningkatan kualitas berkesinambungan.') }}</p>
                    </div>
                </div>

                <!-- Small Box 3 -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">{{ __('Dukungan Anggaran') }}</h3>
                    <p class="text-slate-500 text-sm">{{ __('Alokasi lebih dari 5% operasional mendukung layanan 42 jam/minggu.') }}</p>
                    
                    <!-- Extra Info on Hover -->
                    <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-slate-100">
                        <p class="text-slate-500 text-xs leading-relaxed italic">{{ __('Anggaran mandiri memberikan fleksibilitas ekstra untuk pengadaan ribuan eksemplar buku mutakhir setiap tahunnya.') }}</p>
                    </div>
                </div>

                <!-- Call to action block -->
                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="bg-slate-900 rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex items-center justify-between group overflow-hidden relative">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-xl text-white mb-1">{{ __('Eksplorasi Lengkap') }}</h3>
                        <p class="text-slate-400 text-sm">{{ __('Lihat ke-6 komponen lainnya') }}</p>
                    </div>
                    <a href="/akreditasi" class="relative z-10 w-14 h-14 bg-white/10 rounded-full flex items-center justify-center text-white backdrop-blur-sm hover:bg-[#fecb00] hover:text-[#044b25] transition duration-300 transform group-hover:translate-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
