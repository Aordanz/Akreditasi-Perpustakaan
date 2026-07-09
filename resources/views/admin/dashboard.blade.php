@extends('layouts.admin')
@section('page_title', 'Manajemen Dokumen')
@section('page_subtitle', 'Kelola seluruh dokumen akreditasi institusi')

@section('content')

<div class="space-y-8">
    
    <!-- Statistik Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Total Komponen</div>
                <div class="text-2xl font-black text-slate-800">{{ $komponens->count() }}</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Sub Komponen</div>
                <div class="text-2xl font-black text-slate-800">{{ $komponens->sum(fn($k) => $k->subKomponens->count()) }}</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Total Dokumen</div>
                <div class="text-2xl font-black text-slate-800">{{ collect($komponens)->flatMap->subKomponens->flatMap->dokumenBuktis->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Daftar Komponen -->
    @foreach ($komponens as $komponen)
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ open: true }">
        <!-- Header Komponen -->
        <button @click="open = !open" class="w-full flex items-center justify-between p-6 bg-slate-50 hover:bg-slate-100 transition-colors border-b border-slate-200 focus:outline-none">
            <div class="flex items-center gap-4 text-left">
                <div class="w-12 h-12 bg-slate-800 text-white rounded-xl flex items-center justify-center font-black text-xl shadow-md shrink-0">
                    {{ $komponen->nomor_komponen }}
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">{{ $komponen->nama_komponen }}</h3>
                    <p class="text-sm text-slate-500 mt-1">{{ $komponen->subKomponens->count() }} Sub Komponen</p>
                </div>
            </div>
            <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </button>

        <!-- Body Sub Komponen -->
        <div x-show="open" x-collapse>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="pb-3 px-4 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/3">Sub Komponen</th>
                                <th class="pb-3 px-4 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/3">Dokumen Terlampir</th>
                                <th class="pb-3 px-4 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/3">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody class="align-top text-sm">
                            @foreach ($komponen->subKomponens as $sub)
                            <tr class="hover:bg-slate-50 border-b border-slate-100 last:border-0 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-700 mb-1">{{ $komponen->nomor_komponen }}.{{ $sub->nomor_sub_komponen }}</div>
                                    <div class="text-slate-500 text-xs leading-relaxed">{{ $sub->nama_sub_komponen }}</div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    @if ($sub->dokumenBuktis->count() > 0)
                                        <div class="flex flex-col gap-2">
                                            @foreach ($sub->dokumenBuktis as $dokumen)
                                                <div class="flex items-center gap-2 p-2 rounded-lg bg-green-50/50 border border-green-100">
                                                    <svg class="w-4 h-4 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="text-xs font-medium text-slate-700 hover:text-[#0a7a3b] truncate" title="{{ $dokumen->nama_file }}">
                                                        {{ $dokumen->nama_file }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Belum ada dokumen
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="bg-white rounded-xl border border-slate-200 p-3 shadow-sm hover:border-[#0a7a3b]/30 transition-colors">
                                        <form action="{{ route('admin.akreditasi.upload', $sub->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                                            @csrf
                                            <label class="block cursor-pointer">
                                                <span class="sr-only">Pilih File</span>
                                                <input type="file" name="dokumen" required 
                                                       class="block w-full text-xs text-slate-500 
                                                              file:mr-2 file:py-1 file:px-3 file:rounded-md 
                                                              file:border-0 file:text-xs file:font-semibold 
                                                              file:bg-slate-100 file:text-slate-700 
                                                              hover:file:bg-slate-200 cursor-pointer focus:outline-none">
                                            </label>
                                            <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white px-3 py-1.5 rounded-md font-medium text-xs transition-colors flex items-center justify-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                Unggah Dokumen
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
@endsection
