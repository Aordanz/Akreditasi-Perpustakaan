@extends('layouts.admin')
@section('page_title', 'Manajemen Dokumen')
@section('page_subtitle', 'Kelola seluruh dokumen akreditasi institusi')

@section('content')

@php
    $totalSub = $komponens->sum(fn($k) => $k->subKomponens->count());
    $subTerisi = $komponens->flatMap->subKomponens->filter(fn($sub) => $sub->dokumenBuktis->count() > 0)->count();
    $persentase = $totalSub > 0 ? round(($subTerisi / $totalSub) * 100) : 0;
@endphp

<div class="space-y-8 pb-12">
    
    <!-- Statistik Cepat -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
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

        <!-- Card 2: Sub Komponen -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-3 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Sub Komponen</div>
                <div class="text-2xl font-black text-slate-800 mt-0.5">{{ $totalSub }}</div>
            </div>
        </div>

        <!-- Card 3: Total Dokumen -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-3 transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Dokumen</div>
                <div class="text-2xl font-black text-slate-800 mt-0.5">{{ collect($komponens)->flatMap->subKomponens->flatMap->dokumenBuktis->count() }}</div>
            </div>
        </div>

        <!-- Card 4: Progress Panel -->
        <div class="bg-gradient-to-br from-[#0a7a3b] to-[#044b25] p-6 rounded-3xl shadow-md border border-green-700/10 text-white flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
            <!-- glow decor -->
            <div class="absolute -right-10 -bottom-10 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <span class="text-[10px] uppercase font-black tracking-wider text-green-200">Kelengkapan</span>
                <span class="text-xl font-black text-[#fecb00]">{{ $persentase }}%</span>
            </div>
            <div class="mt-2 relative z-10">
                <div class="text-2xl font-black">{{ $subTerisi }} <span class="text-xs font-normal text-green-200">/ {{ $totalSub }} Sub</span></div>
                <div class="w-full bg-white/20 h-2 rounded-full overflow-hidden mt-3 shadow-inner">
                    <div class="bg-[#fecb00] h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $persentase }}%"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Daftar Komponen -->
    <div class="space-y-6">
        @foreach ($komponens as $komponen)
        @php
            $compTotalSub = $komponen->subKomponens->count();
            $compTerisi = $komponen->subKomponens->filter(fn($s) => $s->dokumenBuktis->count() > 0)->count();
            $compPersentase = $compTotalSub > 0 ? round(($compTerisi / $compTotalSub) * 100) : 0;
        @endphp

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 overflow-hidden" x-data="{ open: false }">
            
            <!-- Header Komponen -->
            <button @click="open = !open" class="w-full flex flex-col md:flex-row md:items-center justify-between p-6 bg-white hover:bg-slate-50/40 transition-colors border-b border-slate-100 focus:outline-none cursor-pointer text-left">
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#0a7a3b] to-[#044b25] text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-md shadow-green-900/10 shrink-0">
                        {{ $komponen->nomor_komponen }}
                    </div>
                    <div class="flex-1 min-w-0 pr-4">
                        <h3 class="text-base md:text-lg font-bold text-slate-800 truncate">{{ $komponen->nama_komponen }}</h3>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2">
                            <span class="text-xs font-semibold text-slate-400 shrink-0">{{ $compTotalSub }} Sub Komponen</span>
                            <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden hidden sm:block">
                                <div class="bg-[#0a7a3b] h-full rounded-full transition-all duration-500" style="width: {{ $compPersentase }}%"></div>
                            </div>
                            <span class="text-[10px] bg-green-50 text-[#0a7a3b] px-2 py-0.5 rounded-full font-bold shrink-0">{{ $compPersentase }}% Selesai</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mt-4 md:mt-0 ml-16 md:ml-0">
                    <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-200/60 hover:bg-slate-100 flex items-center justify-center shrink-0 transition-transform duration-300" :class="open ? 'rotate-180 bg-slate-100' : ''">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </button>

            <!-- Body Sub Komponen -->
            <div x-show="open" x-collapse>
                <div class="p-6 bg-slate-50/20 border-t border-slate-50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200/80">
                                    <th class="pb-3 px-4 text-xs font-black text-slate-400 uppercase tracking-wider w-5/12">Sub Komponen</th>
                                    <th class="pb-3 px-4 text-xs font-black text-slate-400 uppercase tracking-wider w-4/12">Dokumen Terlampir</th>
                                    <th class="pb-3 px-4 text-xs font-black text-slate-400 uppercase tracking-wider w-3/12">Kelola Dokumen</th>
                                </tr>
                            </thead>
                            <tbody class="align-top text-sm">
                                @foreach ($komponen->subKomponens as $sub)
                                <tr class="hover:bg-slate-50/60 border-b border-slate-100 last:border-0 transition-colors">
                                    
                                    <!-- Col 1: Sub Komponen Name -->
                                    <td class="py-5 px-4 pr-6">
                                        <div class="inline-flex items-center justify-center px-2.5 py-0.5 bg-slate-100 text-slate-800 rounded-lg text-[10px] font-black border border-slate-200">
                                            Sub {{ $komponen->nomor_komponen }}.{{ $sub->nomor_sub_komponen }}
                                        </div>
                                        <div class="text-slate-700 text-xs font-semibold leading-relaxed mt-2" title="{{ $sub->nama_sub_komponen }}">
                                            {{ $sub->nama_sub_komponen }}
                                        </div>
                                    </td>
                                    
                                    <!-- Col 2: Uploaded Files -->
                                    <td class="py-5 px-4 pr-6">
                                        @if ($sub->dokumenBuktis->count() > 0)
                                            <div class="flex flex-col gap-2.5">
                                                @foreach ($sub->dokumenBuktis as $dokumen)
                                                    <div class="flex items-center justify-between gap-3 p-2.5 rounded-xl bg-white border border-slate-200/60 hover:border-[#0a7a3b]/40 hover:bg-green-50/20 transition-all group/file">
                                                        <div class="flex items-center gap-2.5 min-w-0">
                                                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100 group-hover/file:bg-[#0a7a3b] group-hover/file:text-white transition-colors duration-300">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                            </div>
                                                            <a href="{{ route('dokumen.view', $dokumen->id) }}" target="_blank" class="text-xs font-bold text-slate-700 hover:text-[#0a7a3b] truncate block" title="{{ $dokumen->nama_file }}">
                                                                {{ $dokumen->nama_file }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Belum ada dokumen
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- Col 3: Upload Box -->
                                    <td class="py-5 px-4">
                                        <div class="bg-white rounded-2xl border border-slate-200 hover:border-[#0a7a3b]/30 p-4 transition-all duration-300" x-data="{ fileName: '' }">
                                            <form action="{{ route('admin.akreditasi.upload', $sub->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                                @csrf
                                                
                                                <!-- Custom Select Area -->
                                                <div class="relative flex items-center justify-center">
                                                    <input type="file" name="dokumen" required id="file-{{ $sub->id }}" 
                                                           @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                                    
                                                    <div class="w-full border border-dashed border-slate-300 rounded-xl p-3 flex flex-col items-center justify-center bg-slate-50/50 hover:bg-slate-100/50 hover:border-[#0a7a3b]/40 transition-colors text-center cursor-pointer">
                                                        <!-- Icon and info -->
                                                        <template x-if="!fileName">
                                                            <div class="flex flex-col items-center gap-1">
                                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                                <span class="text-[10px] font-bold text-slate-500">Pilih File (PDF/DOC)</span>
                                                            </div>
                                                        </template>
                                                        <template x-if="fileName">
                                                            <div class="flex flex-col items-center gap-1 w-full">
                                                                <svg class="w-6 h-6 text-emerald-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <span class="text-[10px] font-black text-slate-700 truncate max-w-full px-2" x-text="fileName"></span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                                
                                                <!-- Action Button -->
                                                <button type="submit" 
                                                        class="w-full text-white font-extrabold py-2 px-3 rounded-xl text-xs transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer shadow-md shadow-slate-900/5 active:scale-95"
                                                        :class="fileName ? 'bg-[#0a7a3b] hover:bg-[#044b25] hover:shadow-[#0a7a3b]/20' : 'bg-slate-700 hover:bg-slate-800'">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                    <span>Unggah Dokumen</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        @endforeach
    </div>

</div>
@endsection
