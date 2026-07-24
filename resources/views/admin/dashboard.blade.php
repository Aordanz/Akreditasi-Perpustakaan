@extends('layouts.admin')
@section('page_title', 'Manajemen Dokumen')
@section('page_subtitle', 'Kelola seluruh dokumen bukti akreditasi institusi')

@section('content')

@php
    // ============================================================
    // Hitung slot aktual (bukan hanya sub-komponen)
    // Setiap sub_indikator = 1 slot
    // Setiap indikator tanpa sub_indikator = 1 slot
    // Setiap sub_komponen tanpa indikator = 1 slot
    // ============================================================
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

<div class="space-y-8 pb-12">
    
    <!-- Statistik Cepat -->
    <div id="stats-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card 1: Total Komponen -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-3 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Komponen</div>
                <div class="text-2xl font-black text-slate-800 mt-0.5">{{ $komponens->count() }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-3 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Slot Dokumen</div>
                <div class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalSlot }}</div>
            </div>
        </div>

        <!-- Card 3: Total Dokumen -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-3 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Dokumen</div>
                <div class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalFiles }}</div>
            </div>
        </div>

        <!-- Card 4: Progress Panel -->
        <div class="bg-gradient-to-br from-[#0a7a3b] to-[#044b25] p-6 rounded-3xl shadow-md border border-green-700/10 text-white flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <span class="text-[10px] uppercase font-black tracking-wider text-green-200">Kelengkapan Slot</span>
                <span class="text-xl font-black text-[#fecb00]">{{ $persentase }}%</span>
            </div>
            <div class="mt-2 relative z-10">
                <div class="text-2xl font-black">{{ $slotTerisi }} <span class="text-xs font-normal text-green-200">/ {{ $totalSlot }} Slot</span></div>
                
                <div class="w-full bg-black/20 rounded-full h-1.5 mt-3 overflow-hidden">
                    <div class="bg-[#fecb00] h-1.5 rounded-full" style="width: {{ $persentase }}%"></div>
                </div>

                <a href="{{ route('admin.report') }}" target="_blank" class="mt-4 block w-full text-center bg-white/20 hover:bg-white/30 text-white py-1.5 rounded-lg text-xs font-bold transition-all border border-white/10 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </a>
            </div>
        </div>

    </div>

    <!-- Daftar Komponen (Level 1) -->
    <div class="space-y-6">
        @foreach ($komponens as $komponen)
        @php
            // Per-komponen: hitung slot aktual dan slot terisi
            $compTotalSlot = 0;
            $compSlotTerisi = 0;
            foreach ($komponen->subKomponens as $sub) {
                if ($sub->indikators->count() > 0) {
                    foreach ($sub->indikators as $ind) {
                        if ($ind->subIndikators->count() > 0) {
                            foreach ($ind->subIndikators as $si) {
                                $compTotalSlot++;
                                if ($si->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $compSlotTerisi++;
                            }
                        } else {
                            $compTotalSlot++;
                            if ($ind->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $compSlotTerisi++;
                        }
                    }
                } else {
                    $compTotalSlot++;
                    if ($sub->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $compSlotTerisi++;
                }
            }
            $compTotalSub   = $komponen->subKomponens->count();
            $compPersentase = $compTotalSlot > 0 ? round(($compSlotTerisi / $compTotalSlot) * 100) : 0;
        @endphp

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 overflow-hidden" x-data="{ open: false }">
            
            <!-- Header Komponen (Level 1) -->
            <button id="komponen-header-{{ $komponen->id }}" @click="open = !open" class="w-full flex flex-col md:flex-row md:items-center justify-between p-6 bg-white hover:bg-slate-50/40 transition-colors border-b border-slate-100 focus:outline-none cursor-pointer text-left">
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#0a7a3b] to-[#044b25] text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-md shadow-green-900/10 shrink-0">
                        {{ $komponen->nomor }}
                    </div>
                    <div class="flex-1 min-w-0 pr-4">
                        <span class="text-[10px] font-black tracking-widest text-slate-400 uppercase block mb-1">Komponen {{ $komponen->nomor }}</span>
                        <h3 class="text-base md:text-lg font-bold text-slate-800 break-words whitespace-normal">{{ $komponen->nama_komponen }}</h3>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2">
                            <span class="text-xs font-semibold text-slate-400 shrink-0">{{ $compTotalSub }} Sub Komponen</span>
                            <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden hidden sm:block">
                                <div class="bg-[#0a7a3b] h-full rounded-full transition-all duration-500" style="width: {{ $compPersentase }}%"></div>
                            </div>
                            <span class="text-[10px] bg-green-50 text-[#0a7a3b] px-2 py-0.5 rounded-full font-bold shrink-0">{{ $compPersentase }}% Selesai ({{ $compSlotTerisi }}/{{ $compTotalSlot }} Slot)</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mt-4 md:mt-0 ml-16 md:ml-0">
                    <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-200/60 hover:bg-slate-100 flex items-center justify-center shrink-0 transition-transform duration-300" :class="open ? 'rotate-180 bg-slate-100' : ''">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </button>

            <!-- Body Sub Komponen (Level 2) -->
            <div x-show="open" x-collapse x-cloak>
                <div class="p-6 bg-slate-50/20 border-t border-slate-50 space-y-6">
                    
                    @foreach ($komponen->subKomponens as $sub)
                    @php
                        // Hitung slot dan terisi per sub-komponen
                        $subTotalSlot = 0;
                        $subSlotTerisi = 0;
                        if ($sub->indikators->count() > 0) {
                            foreach ($sub->indikators as $ind) {
                                if ($ind->subIndikators->count() > 0) {
                                    foreach ($ind->subIndikators as $si) {
                                        $subTotalSlot++;
                                        if ($si->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $subSlotTerisi++;
                                    }
                                } else {
                                    $subTotalSlot++;
                                    if ($ind->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $subSlotTerisi++;
                                }
                            }
                        } else {
                            $subTotalSlot++;
                            if ($sub->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) $subSlotTerisi++;
                        }
                        // Sub-komponen dianggap SELESAI hanya jika SEMUA slot terisi
                        $isSubTerisi   = $subTotalSlot > 0 && $subSlotTerisi === $subTotalSlot;
                        $isSubPartial  = $subSlotTerisi > 0 && $subSlotTerisi < $subTotalSlot;
                    @endphp

                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden" x-data="{ openSub: false }">
                        
                        <!-- Header Sub Komponen (Level 2) -->
                        <button id="sub-header-{{ $sub->id }}" @click="openSub = !openSub" class="w-full flex items-start sm:items-center justify-between p-4 bg-slate-50/50 hover:bg-slate-100/50 transition-colors border-b border-slate-200/60 text-left focus:outline-none cursor-pointer">
                            <div class="flex items-start sm:items-center gap-3 w-full pr-4">
                                <div class="px-2.5 py-1 bg-green-100 text-[#0a7a3b] border border-green-200 rounded-lg text-xs font-black">
                                    {{ $sub->nomor_sub }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-bold text-slate-800 leading-snug break-words whitespace-normal">{{ $sub->nama_sub_komponen }}</h4>
                                    @if ($isSubTerisi)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-[#0a7a3b] uppercase mt-0.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#0a7a3b]"></span> Selesai ({{ $subSlotTerisi }}/{{ $subTotalSlot }} Slot)
                                        </span>
                                    @elseif ($isSubPartial)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-600 uppercase mt-0.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Sebagian ({{ $subSlotTerisi }}/{{ $subTotalSlot }} Slot)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-red-500 uppercase mt-0.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Ada Dokumen
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 transform transition-transform duration-300" :class="openSub ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Content level 3/4 (Indikator & Cards) -->
                        <div x-show="openSub" x-collapse x-cloak class="p-6 bg-white space-y-6">
                            
                            @if ($sub->indikators->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                                    @foreach ($sub->indikators as $ind)
                                        @if ($ind->subIndikators->count() > 0)
                                            @foreach ($ind->subIndikators as $subInd)
                                                @include('admin.partials.document-card', ['title' => $subInd->nama_sub_indikator, 'code' => $subInd->nomor_sub_indikator, 'type' => 'sub_indikator', 'target' => $subInd])
                                            @endforeach
                                        @else
                                            @include('admin.partials.document-card', ['title' => $ind->nama_indikator, 'code' => $ind->nomor_indikator, 'type' => 'indikator', 'target' => $ind])
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <!-- Leaf node is the SubComponent itself -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                                    @include('admin.partials.document-card', ['title' => $sub->nama_sub_komponen, 'code' => $sub->nomor_sub, 'type' => 'sub_komponen', 'target' => $sub])
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
@endsection
