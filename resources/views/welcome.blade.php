@extends('layouts.app')
@section('title', __('Instrumen Akreditasi - Perpustakaan USU'))

@push('styles')
<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .timeline-line {
        position: absolute;
        left: 2.25rem;
        top: 4rem;
        bottom: 1rem;
        width: 2px;
        background: linear-gradient(to bottom, #0a7a3b, rgba(10, 122, 59, 0.1));
        z-index: 0;
    }
    
    .glow-hover:hover {
        box-shadow: 0 0 20px rgba(10, 122, 59, 0.15);
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    body.modal-fullscreen header {
        display: none !important;
    }
</style>
@endpush

@section('content')

    <!-- Header Section -->
    <section class="relative pt-24 pb-32 overflow-hidden" style="background-color: #094726;">
        <!-- Dynamic Gradient Background -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <!-- Animated glowing orbs -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[50%] rounded-full mix-blend-screen filter blur-[120px] opacity-40 animate-blob" style="background-color: #0a7a3b;"></div>
            <div class="absolute top-[20%] right-[-10%] w-[50%] h-[60%] rounded-full mix-blend-screen filter blur-[150px] opacity-10 animate-blob animation-delay-2000" style="background-color: #fecb00;"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-[60%] h-[60%] rounded-full mix-blend-screen filter blur-[150px] opacity-40 animate-blob animation-delay-4000" style="background-color: #044b25;"></div>
            
            <!-- Subtle Grid Pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)]"></div>
        </div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div data-aos="fade-down" data-aos-duration="1000" class="mb-6 relative inline-flex items-center justify-center">
                <div class="absolute inset-0 rounded-full animate-ping opacity-20" style="border: 1px solid rgba(254,203,0,0.5);"></div>
                <div class="absolute -inset-2 rounded-full animate-pulse" style="border: 1px solid rgba(10,122,59,0.5);"></div>
                <span class="relative inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/10 border border-white/20 text-xs font-bold tracking-[0.15em] uppercase backdrop-blur-md shadow-2xl" style="color: #fecb00;">
                    <svg class="w-4 h-4" style="color: #4ade80;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    {{ __('Direktori Dokumen') }}
                </span>
            </div>
            
            <h1 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200" class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight mb-4 sm:mb-6 drop-shadow-2xl">
                {{ __('Instrumen Akreditasi') }}
            </h1>
            
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="text-slate-300 mt-2 sm:mt-4 max-w-2xl mx-auto text-sm sm:text-lg leading-relaxed font-light px-2 sm:px-0">
                {!! __('Jelajahi struktur hierarki standar akreditasi dan akses seluruh dokumen bukti yang mensyaratkan pencapaian <strong class="text-white font-semibold">Perpustakaan USU</strong>.') !!}
            </p>
            
            <!-- Quick Decor/Stats info (Not showing progress) -->
            @php
                $totalSlot   = 0;
                $slotTerisi  = 0;

                foreach ($komponens as $komp) {
                    foreach ($komp->subKomponens as $sub) {
                        if ($sub->indikators->count() > 0) {
                            foreach ($sub->indikators as $ind) {
                                if ($ind->subIndikators->count() > 0) {
                                    foreach ($ind->subIndikators as $si) {
                                        $totalSlot++;
                                        if ($si->dokumenBuktis->count() > 0) $slotTerisi++;
                                    }
                                } else {
                                    $totalSlot++;
                                    if ($ind->dokumenBuktis->count() > 0) $slotTerisi++;
                                }
                            }
                        } else {
                            $totalSlot++;
                            if ($sub->dokumenBuktis->count() > 0) $slotTerisi++;
                        }
                    }
                }

                $persentase  = $totalSlot > 0 ? round(($slotTerisi / $totalSlot) * 100) : 0;
                $totalSub    = $komponens->sum(fn($k) => $k->subKomponens->count());
                $totalFiles  = $komponens->flatMap->subKomponens->flatMap->dokumenBuktis->count();
            @endphp
            
            <!-- Quick Decor/Stats info (Not showing progress) -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600" class="mt-8 sm:mt-12 grid grid-cols-2 gap-3 sm:gap-6 max-w-2xl mx-auto justify-center">
                
                <!-- Card 1: USU Green (Komponen Utama) -->
                <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-2 sm:gap-5 px-3 py-4 sm:px-6 sm:py-5 rounded-2xl hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-[0_10px_30px_-10px_rgba(10,122,59,0.5)] w-full" style="background: linear-gradient(145deg, #0a7a3b, #075a2b); border: 1px solid rgba(255,255,255,0.1);">
                    <!-- 1. Icon Box -->
                    <div class="w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-inner border border-white/20 shrink-0" style="background-color: rgba(255,255,255,0.15); color: #fecb00;">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path></svg>
                    </div>
                    
                    <!-- Right Content (2, 3, 4) -->
                    <div class="flex flex-col items-center sm:items-start justify-center gap-0.5 sm:gap-1 px-1">
                        <!-- 2. Number Box -->
                        <div class="mb-0">
                            <span class="text-2xl sm:text-3xl md:text-4xl font-black text-white drop-shadow-md leading-none">{{ $komponens->count() }}</span>
                        </div>
                        <!-- 3. Word 1 -->
                        <span class="text-[8px] sm:text-[10px] md:text-[11px] font-black uppercase tracking-widest text-green-100 leading-none text-center sm:text-left mt-1">{{ __('KOMPONEN') }}</span>
                        <!-- 4. Word 2 -->
                        <span class="text-[8px] sm:text-[10px] md:text-[11px] font-black uppercase tracking-widest text-green-100 leading-none text-center sm:text-left">{{ __('UTAMA') }}</span>
                    </div>
                </div>
                
                <!-- Card 2: USU Yellow (Sub Komponen) -->
                <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-2 sm:gap-5 px-3 py-4 sm:px-6 sm:py-5 rounded-2xl hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-[0_10px_30px_-10px_rgba(254,203,0,0.5)] w-full" style="background: linear-gradient(145deg, #fecb00, #e5b600); border: 1px solid rgba(255,255,255,0.2);">
                    <!-- 1. Icon Box -->
                    <div class="w-12 h-12 sm:w-16 sm:h-16 md:w-24 md:h-24 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-inner border border-black/10 shrink-0" style="background-color: rgba(0,0,0,0.05); color: #044b25;">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-12 md:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path></svg>
                    </div>
                    
                    <!-- Right Content (2, 3, 4) -->
                    @php
                        $totalSub = $komponens->sum(fn($k) => $k->subKomponens->count());
                    @endphp
                    <div class="flex flex-col items-center sm:items-start justify-center gap-0.5 sm:gap-1 px-1">
                        <!-- 2. Number Box -->
                        <div class="mb-0">
                            <span class="text-2xl sm:text-3xl md:text-4xl font-black text-[#044b25] drop-shadow-sm leading-none">{{ $totalSub }}</span>
                        </div>
                        <!-- 3. Word 1 -->
                        <span class="text-[8px] sm:text-[10px] md:text-[11px] font-black uppercase tracking-widest text-[#0a7a3b] leading-none text-center sm:text-left mt-1">{{ __('SUB') }}</span>
                        <!-- 4. Word 2 -->
                        <span class="text-[8px] sm:text-[10px] md:text-[11px] font-black uppercase tracking-widest text-[#0a7a3b] leading-none text-center sm:text-left">{{ __('KOMPONEN') }}</span>
                    </div>
                </div>
                
            </div>

        </div>
        
        <!-- Bottom curve transition -->
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent z-10 pointer-events-none"></div>
    </section>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-10 relative transition-all" :class="modalOpen ? 'z-[60]' : 'z-20'"
          x-data="{ 
              openLevel1: null,
              modalOpen: false,
              modalTitle: '',
              modalUrl: '',
              modalIsYoutube: false,
              modalIsFullscreen: false,
              openModal(title, url, isYoutube) {
                  this.modalTitle = title;
                  this.modalUrl = url;
                  this.modalIsYoutube = isYoutube;
                  this.modalOpen = true;
                  this.modalIsFullscreen = false;
                  document.body.classList.add('overflow-hidden');
              },
              closeModal() {
                  this.modalOpen = false;
                  this.modalIsFullscreen = false;
                  document.body.classList.remove('overflow-hidden', 'modal-fullscreen');
              },
              toggleFullscreen() {
                  this.modalIsFullscreen = !this.modalIsFullscreen;
                  if (this.modalIsFullscreen) {
                      document.body.classList.add('modal-fullscreen');
                  } else {
                      document.body.classList.remove('modal-fullscreen');
                  }
              }
          }">
        
        @if(session('success'))
        <div class="mb-8 bg-green-50 border-l-4 border-[#0a7a3b] p-4 rounded-r-lg shadow-sm" x-data="{ show: true }" x-show="show" x-transition>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-[#0a7a3b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[#044b25] font-semibold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        @endif

        <div class="space-y-6">
            <!-- LEVEL 1: Komponen -->
            @foreach ($komponens as $komponen)
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white rounded-2xl shadow-sm border border-slate-200 border-l-[6px] border-l-[#0a7a3b] overflow-hidden transition-all duration-500 glow-hover"
                 :class="openLevel1 === {{ $komponen->id }} ? 'ring-2 ring-[#0a7a3b] shadow-xl' : ''">
                 
                <button @click="openLevel1 = openLevel1 === {{ $komponen->id }} ? null : {{ $komponen->id }}" 
                        class="w-full flex items-center justify-between p-4 sm:p-6 bg-white focus:outline-none group text-left">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-3 sm:gap-6 w-full text-center sm:text-left">
                        <!-- 1. Logo -->
                        <div class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 transition-all duration-300"
                             :class="openLevel1 === {{ $komponen->id }} ? 'bg-[#0a7a3b] text-[#fecb00] shadow-lg shadow-[#0a7a3b]/40 scale-105' : 'bg-[#e6f4ea] text-[#0a7a3b] group-hover:bg-[#0a7a3b] group-hover:text-[#fecb00]'">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        
                        <div class="flex-1 flex flex-col items-center sm:items-start gap-1">
                            <!-- 2. Nomor -->
                            <div class="bg-green-100 text-[#0a7a3b] px-2 sm:px-3 py-0.5 sm:py-1 rounded-md sm:rounded-lg text-xs sm:text-sm font-black border border-green-200 shadow-sm"
                                 :class="openLevel1 === {{ $komponen->id }} ? 'bg-[#0a7a3b] text-white border-[#0a7a3b]' : ''">
                                {{ $komponen->nomor }}
                            </div>
                            
                            <!-- 3. Kata Pertama -->
                            <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest block mt-1">{{ __('Komponen') }}</span>
                            
                            <!-- 4. Kata Kedua -->
                            <h2 class="font-black text-lg sm:text-xl md:text-2xl transition-colors leading-tight sm:leading-snug"
                                :class="openLevel1 === {{ $komponen->id }} ? 'text-[#0a7a3b]' : 'text-slate-800 group-hover:text-[#0a7a3b]'">
                                {{ __($komponen->nama_komponen) }}
                            </h2>
                        </div>
                        
                        <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-full flex items-center justify-center bg-[#e6f4ea] transition-colors group-hover:bg-green-200 shrink-0 border border-green-50 mt-1 sm:mt-0 sm:ml-auto">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-[#0a7a3b] transform transition-transform duration-500" :class="openLevel1 === {{ $komponen->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </button>

                <!-- LEVEL 2 Wrapper -->
                <div x-show="openLevel1 === {{ $komponen->id }}" x-collapse x-cloak>
                    <div class="p-6 md:p-8 pt-0 bg-slate-50/50 border-t border-slate-100 relative" x-data="{ openLevel2: null }">
                        
                        <!-- Timeline Line for visual hierarchy -->
                        <div class="hidden md:block timeline-line"></div>

                        <div class="space-y-5 md:ml-10 relative z-10 pt-4">
                            <!-- LEVEL 2: Sub Komponen -->
                            @foreach ($komponen->subKomponens as $sub)
                            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm transition-all duration-300 relative"
                                 :class="openLevel2 === {{ $sub->id }} ? 'border-[#0a7a3b]/40 shadow-md ring-1 ring-[#0a7a3b]/20' : 'hover:border-[#0a7a3b]/40'">
                                
                                <!-- Node indicator -->
                                <div class="hidden md:block absolute -left-[2.85rem] top-7 w-4 h-4 rounded-full border-4 border-white shadow-sm z-20 transition-colors duration-300"
                                     :class="openLevel2 === {{ $sub->id }} ? 'bg-[#0a7a3b]' : 'bg-slate-300'"></div>

                                <button @click="openLevel2 = openLevel2 === {{ $sub->id }} ? null : {{ $sub->id }}" 
                                        class="w-full flex items-center justify-between p-4 sm:p-5 focus:outline-none group bg-white relative z-10 text-left">
                                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-2 sm:gap-5 w-full text-center sm:text-left">
                                        <!-- 1. Logo -->
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16 rounded-lg sm:rounded-xl bg-[#e8f3ec] text-[#0a7a3b] flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-300"
                                             :class="openLevel2 === {{ $sub->id }} ? 'bg-[#0a7a3b] text-white shadow-md' : ''">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                        </div>
                                        
                                        <div class="flex-1 flex flex-col items-center sm:items-start gap-0.5 sm:gap-1">
                                            <!-- 2. Nomor -->
                                            <div class="bg-slate-100 text-slate-600 px-2 sm:px-2.5 py-0.5 rounded sm:rounded-md text-[10px] sm:text-xs font-bold border border-slate-200"
                                                 :class="openLevel2 === {{ $sub->id }} ? 'bg-green-100 text-[#0a7a3b] border-green-200' : ''">
                                                {{ $sub->nomor_sub }}
                                            </div>
                                            
                                            <!-- 3. Kata Pertama -->
                                            <span class="text-[8px] sm:text-[10px] font-extrabold text-[#0a7a3b] uppercase tracking-widest block mt-0.5">{{ __('Sub Komponen') }}</span>
                                            
                                            <!-- 4. Kata Kedua -->
                                            <h3 class="font-bold text-slate-800 text-base sm:text-lg md:text-xl group-hover:text-[#0a7a3b] transition-colors leading-tight sm:leading-snug"
                                                :class="openLevel2 === {{ $sub->id }} ? 'text-[#0a7a3b]' : ''">
                                                {{ __($sub->nama_sub_komponen) }}
                                            </h3>
                                        </div>
                                        
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-400 transform transition-transform duration-300 shrink-0 mt-1 sm:mt-0 sm:ml-auto" :class="openLevel2 === {{ $sub->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </button>

                                <!-- LEVEL 3: Indikator dropdowns & Dokumen Bukti Wrapper -->
                                <div x-show="openLevel2 === {{ $sub->id }}" x-collapse x-cloak>
                                    <div class="p-4 md:p-6 bg-slate-50/50 border-t border-slate-100" x-data="{ openLevel3: null }">
                                        <div class="w-full space-y-3">
                                            @foreach ($sub->indikators as $ind)
                                            <div class="bg-white rounded-xl border border-slate-200/90 shadow-sm overflow-hidden transition-all"
                                                 :class="openLevel3 === {{ $ind->id }} ? 'border-[#0a7a3b]/40 shadow-md ring-1 ring-green-200/30' : 'hover:border-slate-300'">
                                                
                                                <!-- Header Indikator (Level 3) -->
                                                <button @click="openLevel3 = openLevel3 === {{ $ind->id }} ? null : {{ $ind->id }}" 
                                                        class="w-full flex items-start sm:items-center justify-between p-3.5 sm:p-4 focus:outline-none group bg-white text-left cursor-pointer">
                                                    <div class="flex items-start gap-3 min-w-0 pr-3 w-full">
                                                        <span class="px-2 py-0.5 bg-green-50 text-[#0a7a3b] border border-green-200/60 rounded-md text-[11px] font-black shrink-0 mt-0.5"
                                                              :class="openLevel3 === {{ $ind->id }} ? 'bg-[#0a7a3b] text-white border-[#0a7a3b]' : ''">{{ $ind->nomor_indikator }}</span>
                                                        <h4 class="text-xs md:text-sm font-bold text-slate-700 leading-snug pt-0.5 group-hover:text-[#0a7a3b] transition-colors"
                                                            :class="openLevel3 === {{ $ind->id }} ? 'text-[#0a7a3b]' : ''">{{ __($ind->nama_indikator) }}</h4>
                                                    </div>
                                                    <svg class="w-4 h-4 text-slate-400 transform transition-transform duration-300 shrink-0 mt-1" :class="openLevel3 === {{ $ind->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </button>

                                                <!-- Dokumen Bukti inside Indikator -->
                                                <div x-show="openLevel3 === {{ $ind->id }}" x-collapse x-cloak>
                                                    <div class="p-4 bg-slate-50/30 border-t border-slate-100 space-y-4">
                                                        @foreach ($ind->subIndikators as $subInd)
                                                        <div class="bg-white rounded-xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
                                                            <div class="w-full flex items-center justify-between p-4 bg-slate-50/60 border-b border-slate-100">
                                                                <div class="flex items-start gap-3 min-w-0 pr-3">
                                                                    <span class="px-2.5 py-1 bg-[#e6f4ea] text-[#0a7a3b] border border-green-200/80 rounded-lg text-xs font-black shrink-0 mt-0.5">{{ $subInd->nomor_sub_indikator }}</span>
                                                                    <h4 class="text-xs md:text-sm font-bold text-slate-800 leading-snug pt-0.5">{{ __($subInd->nama_sub_indikator) }}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="p-4 bg-white">
                                                                @php $activeDocs = $subInd->dokumenBuktis->filter(fn($d) => !empty($d->nama_file)); @endphp
                                                                @if ($activeDocs->count() > 0)
                                                                    <div class="space-y-2" x-data="{ showAllUserDocs: false }">
                                                                        @foreach ($activeDocs as $dokumen)
                                                                            @php 
                                                                                $isYt = $dokumen->is_youtube;
                                                                                $isDrive = $dokumen->is_drive;
                                                                                $isExists = ($isYt || $isDrive) ? true : ($dokumen->path_file ? Storage::disk('public')->exists($dokumen->path_file) : false); 
                                                                            @endphp
                                                                            <div @if($loop->index >= 5)
                                                                                     x-show="showAllUserDocs" x-cloak
                                                                                     x-transition:enter="transition ease-out duration-200"
                                                                                     x-transition:enter-start="opacity-0 translate-y-1"
                                                                                     x-transition:enter-end="opacity-100 translate-y-0"
                                                                                 @endif
                                                                            >
                                                                                @if ($isExists)
                                                                            <a href="#" @click.prevent="openModal('{{ addslashes($dokumen->nama_file) }}', '{{ $isYt ? $dokumen->youtube_embed_url : route('dokumen.view', ['id' => $dokumen->id, 'embed' => 'true']) }}', {{ $isYt ? 'true' : 'false' }})" class="flex items-center justify-between gap-3 bg-white hover:bg-green-50/10 p-2.5 rounded-xl border border-slate-200 hover:border-[#0a7a3b]/30 shadow-sm hover:shadow transition-all duration-200 group cursor-pointer">
                                                                                <div class="flex items-center gap-2.5 min-w-0">
                                                                                    <div class="w-7 h-7 rounded-lg {{ $isYt ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100' }} flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200">
                                                                                        @if ($isYt)
                                                                                            <svg class="w-3.5 h-3.5 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                                                                        @else
                                                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="text-[11px] font-bold text-slate-700 group-hover:text-[#0a7a3b] transition-colors truncate" title="{{ $dokumen->nama_file }}">{{ $dokumen->nama_file }}</div>
                                                                                </div>
                                                                                <div class="text-slate-400 group-hover:text-[#0a7a3b] transition-colors shrink-0 pr-1">
                                                                                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                                                                </div>
                                                                            </a>
                                                                            @else
                                                                            <div class="flex items-center justify-between gap-3 bg-amber-50/60 p-2.5 rounded-xl border border-amber-200/80 shadow-sm">
                                                                                <div class="flex items-center gap-2.5 min-w-0">
                                                                                    <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                                                    </div>
                                                                                    <div class="text-[11px] font-bold text-amber-900 truncate" title="{{ $dokumen->nama_file }}">{{ $dokumen->nama_file }}</div>
                                                                                </div>
                                                                                <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded shrink-0">File tidak ada / dihapus</span>
                                                                            </div>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                        
                                                                        @if ($activeDocs->count() > 5)
                                                                            <button @click="showAllUserDocs = !showAllUserDocs" type="button" class="w-full py-1.5 px-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg text-[10px] font-bold text-slate-500 hover:text-[#0a7a3b] mt-1 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                                                                                <span x-text="showAllUserDocs ? 'Sembunyikan' : 'Tampilkan {{ $activeDocs->count() - 5 }} file lainnya...'"></span>
                                                                                <svg class="w-3.5 h-3.5 transform transition-transform duration-300" :class="showAllUserDocs ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <div class="flex items-center gap-2 p-3 bg-slate-50 border border-dashed border-slate-200 rounded-lg text-slate-400 text-xs italic">
                                                                        <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                        <span>{{ __('Belum ada dokumen bukti terupload') }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Modal Popup for Document Preview -->
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
             x-cloak>
            
            <!-- Modal Box -->
            <div @click.away="closeModal()" 
                 class="bg-white flex flex-col shadow-2xl transition-all duration-300 overflow-hidden"
                 :class="modalIsFullscreen ? 'fixed inset-0 w-full h-full rounded-none' : 'rounded-2xl max-w-5xl w-full h-[85vh]'"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 translate-y-4"
                 x-transition:enter-end="scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="scale-100 translate-y-0"
                 x-transition:leave-end="scale-95 translate-y-4">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200/80 shrink-0">
                    <div class="flex items-center gap-3 min-w-0">
                        <!-- Play Icon for Youtube vs Document Icon for Files -->
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" 
                             :class="modalIsYoutube ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600'">
                            <template x-if="modalIsYoutube">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </template>
                            <template x-if="!modalIsYoutube">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </template>
                        </div>
                        <h3 class="text-sm font-bold text-slate-800 truncate" x-text="modalTitle">Pratinjau Dokumen</h3>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <!-- Fullscreen Toggle Button -->
                        <button @click="toggleFullscreen()" 
                                class="w-8 h-8 rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-100 flex items-center justify-center transition-colors cursor-pointer" 
                                :title="modalIsFullscreen ? 'Keluar Layar Penuh' : 'Layar Penuh'">
                            <template x-if="!modalIsFullscreen">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 20v-4m0 4h4m-4 0l5-5m11 5h-4m4 0v-4m0 4l-5-5"></path></svg>
                            </template>
                            <template x-if="modalIsFullscreen">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h5v5H4V4zm10 0h5v5h-5V4zM4 14h5v5H4v-5zm10 0h5v5h-5v-5z"></path></svg>
                            </template>
                        </button>
                        
                        <!-- Close Button -->
                        <button @click="closeModal()" class="w-8 h-8 rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-100 flex items-center justify-center transition-colors cursor-pointer" title="Tutup">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Body (Iframe) -->
                <div class="flex-1 bg-slate-100 relative">
                    <template x-if="modalOpen">
                        <iframe :src="modalUrl" 
                                class="w-full h-full border-none"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </template>
                </div>
            </div>
        </div>
    </main>
@endsection
