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
            
            <h1 data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200" class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight mb-6 drop-shadow-2xl">
                {{ __('Instrumen Akreditasi') }}
            </h1>
            
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="text-slate-300 mt-4 max-w-2xl mx-auto text-lg leading-relaxed font-light">
                {!! __('Jelajahi struktur hierarki standar akreditasi dan akses seluruh dokumen bukti yang mensyaratkan pencapaian <strong class="text-white font-semibold">Perpustakaan USU</strong>.') !!}
            </p>
            
            <!-- Quick Decor/Stats info (Not showing progress) -->
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600" class="mt-12 flex flex-wrap justify-center gap-6">
                
                <!-- Card 1: USU Green -->
                <div class="flex items-center gap-5 px-8 py-5 rounded-2xl hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-[0_10px_30px_-10px_rgba(10,122,59,0.5)]" style="background: linear-gradient(145deg, #0a7a3b, #075a2b); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shadow-inner" style="background-color: rgba(255,255,255,0.15); color: #fecb00;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div class="text-left">
                        <div class="text-4xl font-black text-white leading-none drop-shadow-md">{{ $komponens->count() }}</div>
                        <div class="text-xs text-green-100 uppercase tracking-widest font-bold mt-2">{{ __('Komponen Utama') }}</div>
                    </div>
                </div>
                
                <!-- Card 2: USU Yellow -->
                <div class="flex items-center gap-5 px-8 py-5 rounded-2xl hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-[0_10px_30px_-10px_rgba(254,203,0,0.5)]" style="background: linear-gradient(145deg, #fecb00, #e5b600); border: 1px solid rgba(255,255,255,0.2);">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shadow-inner" style="background-color: rgba(0,0,0,0.05); color: #044b25;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002-2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div class="text-left">
                        @php
                            $totalSub = $komponens->sum(fn($k) => $k->subKomponens->count());
                        @endphp
                        <div class="text-4xl font-black text-[#044b25] leading-none drop-shadow-sm">{{ $totalSub }}</div>
                        <div class="text-xs text-[#0a7a3b] uppercase tracking-widest font-black mt-2">{{ __('Sub Komponen') }}</div>
                    </div>
                </div>
                
            </div>

        </div>
        
        <!-- Bottom curve transition -->
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent z-10 pointer-events-none"></div>
    </section>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-10 relative z-20" 
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
                        class="w-full flex items-center justify-between p-6 bg-white focus:outline-none group text-left">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-black text-xl shrink-0 transition-all duration-300"
                             :class="openLevel1 === {{ $komponen->id }} ? 'bg-[#0a7a3b] text-[#fecb00] shadow-lg shadow-[#0a7a3b]/40 scale-110' : 'bg-[#e6f4ea] text-[#0a7a3b] group-hover:bg-[#0a7a3b] group-hover:text-[#fecb00]'">
                            {{ $komponen->nomor }}
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">{{ __('Komponen') }}</span>
                            <h2 class="font-bold text-xl md:text-2xl transition-colors"
                                :class="openLevel1 === {{ $komponen->id }} ? 'text-[#0a7a3b]' : 'text-slate-800 group-hover:text-[#0a7a3b]'">
                                {{ __($komponen->nama_komponen) }}
                            </h2>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-[#e6f4ea] transition-colors group-hover:bg-green-200 shrink-0 border border-green-50">
                        <svg class="w-6 h-6 text-[#0a7a3b] transform transition-transform duration-500" :class="openLevel1 === {{ $komponen->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
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
                                        class="w-full flex items-center justify-between p-5 focus:outline-none group bg-white relative z-10 text-left">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-[#e8f3ec] text-[#0a7a3b] flex items-center justify-center font-bold shrink-0 group-hover:scale-105 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-extrabold text-[#0a7a3b] uppercase tracking-widest block mb-0.5 bg-green-50 inline-block px-2 py-0.5 rounded-md">{{ __('Sub Komponen') }} {{ $sub->nomor_sub }}</span>
                                            <h3 class="font-bold text-slate-800 text-lg group-hover:text-[#0a7a3b] transition-colors mt-1">{{ __($sub->nama_sub_komponen) }}</h3>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300 shrink-0" :class="openLevel2 === {{ $sub->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <!-- LEVEL 3 & Dokumen Bukti Wrapper -->
                                <div x-show="openLevel2 === {{ $sub->id }}" x-collapse x-cloak>
                                    <div class="p-5 md:p-7 bg-slate-50/50 border-t border-slate-100">
                                        <div class="w-full space-y-4">
                                            @foreach ($sub->indikators as $ind)
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
                                                            <div class="space-y-2">
                                                                @foreach ($activeDocs as $dokumen)
                                                                    @php 
                                                                        $isYt = $dokumen->is_youtube;
                                                                        $isExists = $isYt ? true : ($dokumen->path_file ? Storage::disk('public')->exists($dokumen->path_file) : false); 
                                                                    @endphp
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
                                                                @endforeach
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
