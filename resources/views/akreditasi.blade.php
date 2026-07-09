@extends('layouts.app')
@section('title', 'Instrumen Akreditasi - Perpustakaan USU')

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
</style>
@endpush

@section('content')

    <!-- Header Section -->
    <section class="bg-slate-900 pt-20 pb-24 relative overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#0a7a3b] rounded-full mix-blend-screen filter blur-[100px] opacity-20 -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#fecb00] rounded-full mix-blend-screen filter blur-[100px] opacity-10 -ml-40 -mb-40"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
        </div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 border border-white/20 text-[#fecb00] text-sm font-bold tracking-widest uppercase mb-6 backdrop-blur-md">Direktori Dokumen</span>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4 drop-shadow-md">
                Instrumen Akreditasi
            </h1>
            <p class="text-slate-300 mt-4 max-w-2xl mx-auto text-lg leading-relaxed">
                Jelajahi struktur hierarki standar akreditasi dan akses seluruh dokumen bukti yang mensyaratkan pencapaian Perpustakaan USU.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-10 relative z-20" x-data="{ openLevel1: null }">
        
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
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-500 glow-hover"
                 :class="openLevel1 === {{ $komponen->id }} ? 'ring-2 ring-[#0a7a3b] shadow-xl' : ''">
                 
                <button @click="openLevel1 = openLevel1 === {{ $komponen->id }} ? null : {{ $komponen->id }}" 
                        class="w-full flex items-center justify-between p-6 bg-white focus:outline-none group">
                    <div class="flex items-center gap-5 text-left">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center font-black text-xl shrink-0 transition-all duration-300"
                             :class="openLevel1 === {{ $komponen->id }} ? 'bg-[#0a7a3b] text-white shadow-lg shadow-[#0a7a3b]/40 scale-110' : 'bg-slate-100 text-slate-500 group-hover:bg-[#fecb00] group-hover:text-[#044b25]'">
                            {{ $komponen->nomor }}
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Komponen</span>
                            <h2 class="font-bold text-xl md:text-2xl transition-colors"
                                :class="openLevel1 === {{ $komponen->id }} ? 'text-[#0a7a3b]' : 'text-slate-800 group-hover:text-black'">
                                {{ $komponen->nama_komponen }}
                            </h2>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-slate-50 transition-colors group-hover:bg-slate-100 shrink-0 border border-slate-100">
                        <svg class="w-6 h-6 text-slate-400 transform transition-transform duration-500" :class="openLevel1 === {{ $komponen->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
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
                                        class="w-full flex items-center justify-between p-5 focus:outline-none group bg-white relative z-10">
                                    <div class="flex items-center gap-4 text-left">
                                        <div class="w-12 h-12 rounded-xl bg-[#e8f3ec] text-[#0a7a3b] flex items-center justify-center font-bold shrink-0 group-hover:scale-105 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-extrabold text-[#0a7a3b] uppercase tracking-widest block mb-0.5 bg-green-50 inline-block px-2 py-0.5 rounded-md">Sub Komponen {{ $sub->nomor_sub }}</span>
                                            <h3 class="font-bold text-slate-800 text-lg group-hover:text-[#0a7a3b] transition-colors mt-1">{{ $sub->nama_sub_komponen }}</h3>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300 shrink-0" :class="openLevel2 === {{ $sub->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <!-- LEVEL 3 & Dokumen Bukti Wrapper -->
                                <div x-show="openLevel2 === {{ $sub->id }}" x-collapse x-cloak>
                                    <div class="p-5 md:p-7 bg-slate-50 border-t border-slate-100" x-data="{ openLevel3: null }">
                                        
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                            
                                            <!-- Kiri: Daftar Indikator -->
                                            <div>
                                                <h4 class="font-bold text-[#0a7a3b] mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                                    Indikator Penilaian
                                                </h4>

                                                <div class="space-y-3">
                                                    <!-- LEVEL 3: Indikator -->
                                                    @forelse ($sub->indikators as $indikator)
                                                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                                        <button @click="openLevel3 = openLevel3 === {{ $indikator->id }} ? null : {{ $indikator->id }}" 
                                                                class="w-full flex items-start gap-3 p-4 focus:outline-none hover:bg-slate-50 transition-colors text-left group">
                                                            <div class="mt-1 w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold shrink-0 group-hover:bg-[#fecb00] group-hover:text-[#044b25] transition-colors">
                                                                <svg class="w-3.5 h-3.5 transform transition-transform" :class="openLevel3 === {{ $indikator->id }} ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                                            </div>
                                                            <div>
                                                                <span class="font-bold text-slate-800 block text-sm">{{ $indikator->nomor_indikator }}</span>
                                                                <span class="text-sm text-slate-600 mt-1 block leading-relaxed">{{ $indikator->nama_indikator }}</span>
                                                            </div>
                                                        </button>

                                                        <!-- LEVEL 4 Wrapper -->
                                                        <div x-show="openLevel3 === {{ $indikator->id }}" x-collapse x-cloak>
                                                            <div class="p-4 pl-12 bg-slate-50/50 border-t border-slate-100">
                                                                @if ($indikator->subIndikators->count() > 0)
                                                                <div class="space-y-2">
                                                                    <!-- LEVEL 4: Sub Indikator -->
                                                                    @foreach ($indikator->subIndikators as $subIndikator)
                                                                    <div class="flex items-start gap-3 p-3 rounded-lg bg-white border border-slate-200 hover:border-[#0a7a3b]/50 transition-colors">
                                                                        <div class="mt-0.5 w-1.5 h-1.5 rounded-full bg-[#0a7a3b] shrink-0 mt-1.5"></div>
                                                                        <div>
                                                                            <span class="text-[11px] font-bold text-slate-400 block mb-0.5">{{ $subIndikator->nomor_sub_indikator }}</span>
                                                                            <span class="text-sm text-slate-700 leading-snug block">{{ $subIndikator->nama_sub_indikator }}</span>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @else
                                                                <p class="text-slate-400 italic text-sm py-2">Tidak ada detail persyaratan spesifik.</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="bg-white rounded-xl border border-slate-200 p-6 text-center border-dashed">
                                                        <p class="text-slate-500 text-sm">Belum ada indikator.</p>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>

                                            <!-- Kanan: Dokumen Bukti -->
                                            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm relative overflow-hidden flex flex-col h-full">
                                                <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-[#0a7a3b] to-[#8dc63f]"></div>
                                                
                                                <h4 class="font-extrabold text-[#0a7a3b] text-base mb-5 flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    Arsip Dokumen Bukti
                                                </h4>
                                                
                                                <div class="flex-grow">
                                                    <!-- Daftar Dokumen Terunggah -->
                                                    @if ($sub->dokumenBuktis->count() > 0)
                                                        <div class="space-y-3 mb-6">
                                                            @foreach ($sub->dokumenBuktis as $dokumen)
                                                            <div class="flex items-center justify-between bg-slate-50 p-3.5 rounded-xl border border-slate-200 hover:border-[#0a7a3b]/40 hover:bg-[#e8f3ec]/30 transition-all group">
                                                                <div class="flex items-center gap-4 overflow-hidden">
                                                                    <div class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-[#0a7a3b] shadow-sm group-hover:scale-105 transition-transform">
                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                                    </div>
                                                                    <div class="truncate">
                                                                        <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="text-sm font-bold text-slate-800 hover:text-[#0a7a3b] truncate block transition-colors" title="{{ $dokumen->nama_file }}">
                                                                            {{ $dokumen->nama_file }}
                                                                        </a>
                                                                        <div class="flex items-center gap-2 mt-1">
                                                                            <span class="text-[10px] bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded font-medium">{{ strtoupper(pathinfo($dokumen->path_file, PATHINFO_EXTENSION)) }}</span>
                                                                            <span class="text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($dokumen->tanggal_upload)->format('d M Y') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="text-slate-400 hover:text-white bg-slate-100 hover:bg-[#0a7a3b] p-2 rounded-lg transition-all ml-2 shrink-0 group-hover:shadow-md">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                                </a>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="mb-6 border-2 border-dashed border-slate-200 rounded-xl p-8 text-center flex flex-col items-center justify-center h-full min-h-[150px] bg-slate-50/50">
                                                            <svg class="w-10 h-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                            <p class="text-sm font-medium text-slate-500">Belum ada dokumen yang diunggah.</p>
                                                        </div>
                                                    @endif
                                                </div>


                                            </div>

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
    </main>
@endsection
