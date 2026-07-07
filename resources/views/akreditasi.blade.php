<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumen Akreditasi - Perpustakaan USU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        [x-cloak] { display: none !important; }
        input[type="checkbox"] { accent-color: #0a7a3b; }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40 border-b-[4px] border-[#0a7a3b]">
        <div class="max-w-[1400px] mx-auto px-4 flex justify-between items-center h-20">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 md:w-14 md:h-14 object-contain group-hover:scale-105 transition duration-300">
                    <span class="font-bold text-lg md:text-2xl text-black tracking-tight hidden sm:block">Perpustakaan Universitas Sumatera Utara</span>
                </a>
            </div>
            <nav class="hidden md:flex gap-6 font-semibold text-sm text-[#0a7a3b] items-center">
                <a href="/" class="relative hover:text-[#044b25] transition-colors py-2">Beranda</a>
                <a href="/akreditasi" class="text-[#044b25] font-bold relative after:absolute after:bottom-0 after:left-0 after:h-[3px] after:w-full after:bg-[#0a7a3b] after:rounded-t-md py-2">Akreditasi</a>
                
                <div class="w-px h-6 bg-slate-200 mx-2"></div>
                
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl transition-colors font-bold shadow-sm border border-red-100">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-[#0a7a3b] hover:bg-[#044b25] text-white px-4 py-2 rounded-xl transition-colors font-bold shadow-sm shadow-[#0a7a3b]/20">Login Admin</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ openLevel1: null }">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#0a7a3b] tracking-tight">Instrumen Akreditasi</h1>
            <p class="text-slate-500 mt-3 max-w-2xl mx-auto text-lg">Jelajahi struktur hierarki akreditasi dan dokumen bukti yang disyaratkan.</p>
        </div>

        <div class="space-y-4">
            <!-- LEVEL 1: Komponen -->
            @foreach ($komponens as $komponen)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-300"
                 :class="openLevel1 === {{ $komponen->id }} ? 'ring-2 ring-[#0a7a3b]/20 shadow-md' : 'hover:border-slate-300'">
                 
                <button @click="openLevel1 = openLevel1 === {{ $komponen->id }} ? null : {{ $komponen->id }}" 
                        class="w-full flex items-center justify-between p-5 md:p-6 bg-white focus:outline-none group">
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-extrabold text-lg shrink-0 transition-colors shadow-sm"
                             :class="openLevel1 === {{ $komponen->id }} ? 'bg-[#0a7a3b] text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-[#fecb00] group-hover:text-[#044b25]'">
                            {{ $komponen->nomor }}
                        </div>
                        <h2 class="font-extrabold text-lg md:text-xl transition-colors"
                            :class="openLevel1 === {{ $komponen->id }} ? 'text-[#0a7a3b]' : 'text-slate-700 group-hover:text-black'">
                            {{ $komponen->nama_komponen }}
                        </h2>
                    </div>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-slate-50 transition-colors group-hover:bg-slate-100 shrink-0">
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300" :class="openLevel1 === {{ $komponen->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </button>

                <!-- LEVEL 2 Wrapper -->
                <div x-show="openLevel1 === {{ $komponen->id }}" x-collapse x-cloak>
                    <div class="p-5 md:p-8 pt-0 bg-slate-50/50 border-t border-slate-100" x-data="{ openLevel2: null }">
                        <div class="space-y-4">
                            <!-- LEVEL 2: Sub Komponen -->
                            @foreach ($komponen->subKomponens as $sub)
                            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm transition-all"
                                 :class="openLevel2 === {{ $sub->id }} ? 'border-[#0a7a3b]/30 ring-1 ring-[#0a7a3b]/20' : 'hover:border-slate-300'">
                                
                                <button @click="openLevel2 = openLevel2 === {{ $sub->id }} ? null : {{ $sub->id }}" 
                                        class="w-full flex items-center justify-between p-4 md:p-5 focus:outline-none group">
                                    <div class="flex items-center gap-4 text-left">
                                        <div class="w-10 h-10 rounded-xl bg-[#e8f3ec] text-[#0a7a3b] flex items-center justify-center font-bold shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-0.5">SUB KOMPONEN {{ $sub->nomor_sub }}</span>
                                            <h3 class="font-bold text-slate-800 text-base md:text-lg group-hover:text-[#0a7a3b] transition-colors">{{ $sub->nama_sub_komponen }}</h3>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300 shrink-0" :class="openLevel2 === {{ $sub->id }} ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <!-- LEVEL 3 & Dokumen Bukti Wrapper -->
                                <div x-show="openLevel2 === {{ $sub->id }}" x-collapse x-cloak>
                                    <div class="p-5 md:p-6 bg-slate-50 border-t border-slate-100" x-data="{ openLevel3: null }">
                                        
                                        <h4 class="font-bold text-[#0a7a3b] mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            Daftar Indikator
                                        </h4>

                                        <div class="space-y-3 mb-8">
                                            <!-- LEVEL 3: Indikator -->
                                            @forelse ($sub->indikators as $indikator)
                                            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
                                                <button @click="openLevel3 = openLevel3 === {{ $indikator->id }} ? null : {{ $indikator->id }}" 
                                                        class="w-full flex items-start gap-3 p-4 focus:outline-none hover:bg-slate-50 transition-colors text-left group">
                                                    <div class="mt-0.5 w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold shrink-0 group-hover:bg-[#fecb00] group-hover:text-[#044b25] transition-colors">
                                                        <svg class="w-3.5 h-3.5 transform transition-transform" :class="openLevel3 === {{ $indikator->id }} ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                                    </div>
                                                    <div>
                                                        <span class="font-bold text-slate-700 block">{{ $indikator->nomor_indikator }}</span>
                                                        <span class="text-sm text-slate-600 mt-1 block leading-relaxed">{{ $indikator->nama_indikator }}</span>
                                                    </div>
                                                </button>

                                                <!-- LEVEL 4 Wrapper -->
                                                <div x-show="openLevel3 === {{ $indikator->id }}" x-collapse x-cloak>
                                                    <div class="p-4 pl-12 bg-slate-50/50 border-t border-slate-100">
                                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Persyaratan Dokumen (Sub Indikator)</p>
                                                        @if ($indikator->subIndikators->count() > 0)
                                                        <div class="space-y-2">
                                                            <!-- LEVEL 4: Sub Indikator -->
                                                            @foreach ($indikator->subIndikators as $subIndikator)
                                                            <label class="flex items-start gap-3 p-3 rounded-lg bg-white border border-slate-200 cursor-pointer hover:border-[#0a7a3b]/50 hover:shadow-sm transition-all group">
                                                                <input type="checkbox" class="mt-0.5 shrink-0 w-4 h-4 text-[#0a7a3b] border-slate-300 rounded focus:ring-[#0a7a3b]">
                                                                <div>
                                                                    <span class="text-xs font-bold text-slate-500 group-hover:text-[#0a7a3b] block mb-0.5">{{ $subIndikator->nomor_sub_indikator }}</span>
                                                                    <span class="text-sm text-slate-700 leading-snug block">{{ $subIndikator->nama_sub_indikator }}</span>
                                                                </div>
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                        <p class="text-slate-400 italic text-sm py-2">Tidak ada persyaratan khusus untuk indikator ini.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="bg-white rounded-lg border border-slate-200 p-6 text-center">
                                                <p class="text-slate-500 text-sm">Belum ada indikator untuk sub-komponen ini.</p>
                                            </div>
                                            @endforelse
                                        </div>

                                        <!-- DOKUMEN BUKTI SECTION (At Level 2) -->
                                        <div class="bg-white rounded-xl border border-slate-200 p-5 md:p-6 shadow-sm relative overflow-hidden">
                                            <div class="absolute top-0 left-0 w-1 h-full bg-[#fecb00]"></div>
                                            <h4 class="font-extrabold text-[#0a7a3b] text-base mb-4 flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                                Dokumen Bukti (Level 2)
                                            </h4>
                                            
                                            <!-- Daftar Dokumen Terunggah -->
                                            @if ($sub->dokumenBuktis->count() > 0)
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-5">
                                                    @foreach ($sub->dokumenBuktis as $dokumen)
                                                    <div class="flex items-center justify-between bg-slate-50 p-3 rounded-lg border border-slate-200 hover:border-[#0a7a3b]/30 transition-colors">
                                                        <div class="flex items-center gap-3 overflow-hidden">
                                                            <div class="w-8 h-8 shrink-0 bg-white border border-slate-200 rounded-md flex items-center justify-center text-[#0a7a3b]">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                            </div>
                                                            <div class="truncate">
                                                                <p class="text-sm font-bold text-slate-700 truncate" title="{{ $dokumen->nama_file }}">{{ $dokumen->nama_file }}</p>
                                                                <p class="text-[11px] text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($dokumen->tanggal_upload)->format('d M Y, H:i') }}</p>
                                                            </div>
                                                        </div>
                                                        <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="text-[#0a7a3b] hover:text-[#044b25] bg-[#e8f3ec] hover:bg-[#cce3d6] p-1.5 rounded-md transition-colors ml-2 shrink-0">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-sm text-slate-500 mb-5 italic border border-dashed border-slate-300 rounded-lg p-4 text-center bg-slate-50">Belum ada dokumen bukti yang diunggah.</p>
                                            @endif

                                            <!-- Form Upload (Hanya Admin) -->
                                            @auth
                                            <div class="border-t border-slate-100 pt-5 mt-2">
                                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Admin: Unggah Dokumen Baru</h4>
                                                <form action="{{ route('admin.akreditasi.upload', $sub->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-end gap-3">
                                                    @csrf
                                                    <div class="flex-1 w-full">
                                                        <input type="file" name="dokumen" required class="block w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#0a7a3b]/10 file:text-[#0a7a3b] hover:file:bg-[#0a7a3b]/20 file:transition-colors file:cursor-pointer bg-slate-50 border border-slate-200 rounded-lg cursor-pointer focus:outline-none">
                                                    </div>
                                                    <button type="submit" class="w-full sm:w-auto bg-[#0a7a3b] hover:bg-[#044b25] text-white px-6 py-2 rounded-lg font-bold text-sm transition-colors shadow-md shadow-[#0a7a3b]/20 whitespace-nowrap">
                                                        Upload
                                                    </button>
                                                </form>
                                            </div>
                                            @else
                                            <div class="border-t border-slate-100 pt-4 mt-2">
                                                <p class="text-xs text-slate-400 font-semibold"><span class="text-[#0a7a3b]">Info:</span> Hanya admin yang dapat mengunggah dokumen baru.</p>
                                            </div>
                                            @endauth
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

</body>
</html>
