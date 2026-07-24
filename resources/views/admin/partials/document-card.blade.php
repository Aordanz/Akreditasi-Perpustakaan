@php
    $allDocs = $target->dokumenBuktis;
    $uploadedDocs = $allDocs->filter(fn($d) => !empty($d->nama_file))->sortBy('nama_file', SORT_NATURAL | SORT_FLAG_CASE)->values();
    $emptySlots = $allDocs->filter(fn($d) => empty($d->nama_file));
    $hasFiles = $uploadedDocs->count() > 0;
@endphp

<div id="card-{{ $type }}-{{ $target->id }}" class="document-card-container bg-white rounded-2xl border-2 {{ $hasFiles ? 'border-emerald-500/80 bg-emerald-50/20 shadow-sm' : 'border-slate-200/90 bg-white hover:border-slate-300' }} p-4.5 transition-all duration-200 flex flex-col justify-between h-full min-h-[190px] relative overflow-hidden group hover:shadow-md">
    
    <!-- Top accent bar -->
    <div class="absolute top-0 left-0 right-0 h-1.5 {{ $hasFiles ? 'bg-[#0a7a3b]' : 'bg-amber-400' }}"></div>

    <div class="flex-1 flex flex-col justify-between pt-1">
        
        <!-- Header -->
        <div>
            <div class="flex items-center justify-between gap-2 mb-2.5">
                <span class="px-2.5 py-1 {{ $hasFiles ? 'bg-emerald-100 text-[#0a7a3b] border-emerald-200' : 'bg-slate-100 text-slate-700 border-slate-200' }} border rounded-md text-[10px] font-black uppercase tracking-wider">
                    Slot {{ $code }}
                </span>
                
                @if ($hasFiles)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span> Terisi ({{ $uploadedDocs->count() }})
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-red-50 text-red-700 border border-red-200 uppercase">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Belum Upload
                    </span>
                @endif
            </div>
            
            <h6 class="text-xs font-bold text-slate-800 leading-snug group-hover:text-[#0a7a3b] transition-colors break-words whitespace-normal" title="{{ $title }}">
                {{ $title }}
            </h6>
        </div>

        <!-- Files list -->
        <div class="my-3.5 space-y-2 flex-1 flex flex-col justify-end">
            @if ($hasFiles)
                <div class="space-y-2" x-data="{ showAll: window['showAll_{{ $type }}_{{ $target->id }}'] || false }" x-init="$watch('showAll', val => window['showAll_{{ $type }}_{{ $target->id }}'] = val)">
                    @foreach ($uploadedDocs as $dokumen)
                        @php
                            $isYt = $dokumen->is_youtube;
                            $isDrive = $dokumen->is_drive;
                            $fileExists = ($isYt || $isDrive) ? true : ($dokumen->path_file ? Storage::disk('public')->exists($dokumen->path_file) : false);
                        @endphp
                        <div x-data="{ editing: false }" 
                             class="flex items-center justify-between gap-2 p-2 rounded-xl {{ $fileExists ? 'bg-white border border-emerald-200/80 shadow-2xs' : 'bg-amber-50 border border-amber-200' }} transition-all relative"
                             @if($loop->index >= 2)
                                 x-show="showAll" x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                             @endif
                        >
                            <!-- View State -->
                            <div class="flex items-center gap-2 min-w-0 flex-1">
                                <div class="w-6.5 h-6.5 rounded-lg {{ $isYt ? 'bg-red-50 text-red-600 border border-red-100' : ($fileExists ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-100 text-amber-600') }} flex items-center justify-center shrink-0">
                                    @if ($isYt)
                                        <svg class="w-3.5 h-3.5 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                    @else
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    @endif
                                </div>
                                <a href="{{ route('dokumen.view', $dokumen->id) }}" class="text-[10px] font-bold text-slate-700 hover:text-[#0a7a3b] truncate block" title="{{ $dokumen->nama_file }}">
                                    {{ $dokumen->nama_file }}
                                </a>
                            </div>
                            
                            <div class="flex gap-2 shrink-0">
                                <button type="button" @click="editing = true" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors border border-blue-100 cursor-pointer" title="Edit Dokumen">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <form action="{{ route('admin.dokumen.delete', $dokumen->id) }}" method="POST" onsubmit="return confirmDelete(event, this, 'card-{{ $type }}-{{ $target->id }}', '{{ $komponen->id }}', '{{ $sub->id }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-100 cursor-pointer" title="Hapus Dokumen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Edit Modal State -->
                            <div x-show="editing" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4" @keydown.escape.window="editing = false">
                                <div @click.away="editing = false" class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-md p-5 text-left transform transition-all"
                                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-sm font-bold text-slate-800">Edit Dokumen</h3>
                                        <button @click="editing = false" type="button" class="text-slate-400 hover:text-slate-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" onsubmit="editing = false; return submitAjax(event, this, 'card-{{ $type }}-{{ $target->id }}', '{{ $komponen->id }}', '{{ $sub->id }}');">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Dokumen</label>
                                            <input type="text" name="nama_file" value="{{ $dokumen->nama_file }}" class="w-full text-base sm:text-xs font-medium text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 focus:ring-1 focus:ring-[#0a7a3b] focus:border-[#0a7a3b] outline-none transition-all" required>
                                        </div>
                                        @if ($isYt || $isDrive)
                                        <div class="mb-4">
                                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Tautan (URL)</label>
                                            <input type="url" name="link" value="{{ $dokumen->path_file }}" class="w-full text-base sm:text-xs font-medium text-blue-600 bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 focus:ring-1 focus:ring-[#0a7a3b] focus:border-[#0a7a3b] outline-none transition-all" required>
                                        </div>
                                        @endif
                                        <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 mt-2">
                                            <button type="button" @click="editing = false" class="px-4 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors cursor-pointer">Batal</button>
                                            <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-[#0a7a3b] hover:bg-emerald-700 rounded-xl transition-colors flex items-center gap-1.5 shadow-sm cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($uploadedDocs->count() > 2)
                        <button @click="showAll = !showAll" type="button" class="w-full py-1.5 px-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-lg text-[10px] font-bold text-slate-500 hover:text-[#0a7a3b] mt-1 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                            <span x-text="showAll ? 'Sembunyikan' : 'Tampilkan {{ $uploadedDocs->count() - 2 }} file lainnya...'"></span>
                            <svg class="w-3.5 h-3.5 transform transition-transform duration-300" :class="showAll ? 'rotate-180 text-[#0a7a3b]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    @endif
                </div>
            @else
                <div class="text-center py-4 border-2 border-dashed border-red-200/80 rounded-xl bg-red-50/20">
                    <svg class="w-6 h-6 mx-auto text-red-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <span class="text-[10px] text-red-400 font-extrabold uppercase block tracking-wider">Belum Ada Dokumen Bukti</span>
                </div>
            @endif
        </div>

        <!-- Upload Form & YouTube/Drive Option -->
        <div class="mt-auto pt-1" x-data="{ showYoutube: false, showDrive: false }">
            <form action="{{ route('admin.akreditasi.upload.spesifik', [$type, $target->id]) }}" method="POST" enctype="multipart/form-data" class="w-full" onsubmit="return submitAjax(event, this, 'card-{{ $type }}-{{ $target->id }}', '{{ $komponen->id }}', '{{ $sub->id }}');">
                @csrf
                <div class="flex gap-2" x-show="!showYoutube && !showDrive">
                    <button type="button" @click="showDrive = true" class="flex-1 px-3 py-2 rounded-xl border border-blue-200 hover:border-blue-500 bg-blue-50/50 hover:bg-blue-500 hover:text-white text-blue-600 transition-colors shadow-2xs flex items-center justify-center gap-1.5 cursor-pointer active:scale-[0.98]" title="Tambah Link Google Drive">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 2.215L17.265 11.3l-5.255 9.1L6.755 11.3l5.255-9.085zM6.55 11.69l3.96 6.85-2.025 3.52-6.28-10.875L4.405 7.42l2.145 4.27zM17.45 11.69l-2.145-4.27 2.195-3.795 6.295 10.875-2.035 3.52-4.31-6.33z"/></svg>
                        <span class="text-[10px] font-black">Link Drive</span>
                    </button>
                    <button type="button" @click="showYoutube = true" class="flex-1 px-3 py-2 rounded-xl border border-red-200 hover:border-red-500 bg-red-50/50 hover:bg-red-500 hover:text-white text-red-600 transition-colors shadow-2xs flex items-center justify-center gap-1.5 cursor-pointer active:scale-[0.98]" title="Tambah Link YouTube">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        <span class="text-[10px] font-black">Link YouTube</span>
                    </button>
                </div>

                <!-- Drive Form Overlay -->
                <div x-show="showDrive" x-cloak x-transition.opacity.duration.300ms class="absolute inset-0 z-20 bg-white/95 backdrop-blur-sm p-4 flex flex-col justify-center items-center text-center rounded-2xl">
                    <div class="w-full max-w-sm space-y-3">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-1 shadow-sm border border-blue-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 2.215L17.265 11.3l-5.255 9.1L6.755 11.3l5.255-9.085zM6.55 11.69l3.96 6.85-2.025 3.52-6.28-10.875L4.405 7.42l2.145 4.27zM17.45 11.69l-2.145-4.27 2.195-3.795 6.295 10.875-2.035 3.52-4.31-6.33z"/></svg>
                        </div>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">Upload via Google Drive</h4>
                        <div class="space-y-2 text-left">
                            <input type="url" name="drive_link" placeholder="https://drive.google.com/file/d/..." class="w-full text-base sm:text-xs p-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-inner">
                            <input type="text" name="nama_drive" placeholder="Nama Dokumen (Opsional)" class="w-full text-base sm:text-xs p-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-inner">
                        </div>
                        <div class="flex gap-2 pt-1">
                            <button type="button" @click="showDrive = false" class="flex-1 py-2 text-xs font-bold text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors cursor-pointer border border-slate-200 min-h-[44px]">Batal</button>
                            <button type="submit" class="flex-1 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors cursor-pointer shadow-md shadow-blue-500/30 min-h-[44px]">Simpan</button>
                        </div>
                    </div>
                </div>

                <!-- Youtube Form Overlay -->
                <div x-show="showYoutube" x-cloak x-transition.opacity.duration.300ms class="absolute inset-0 z-20 bg-white/95 backdrop-blur-sm p-4 flex flex-col justify-center items-center text-center rounded-2xl">
                    <div class="w-full max-w-sm space-y-3">
                        <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-1 shadow-sm border border-red-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </div>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">Upload via YouTube</h4>
                        <div class="space-y-2 text-left">
                            <input type="url" name="youtube_link" placeholder="https://youtube.com/watch?v=..." class="w-full text-base sm:text-xs p-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-white shadow-inner">
                            <input type="text" name="nama_video" placeholder="Nama Video (Opsional)" class="w-full text-base sm:text-xs p-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-white shadow-inner">
                        </div>
                        <div class="flex gap-2 pt-1">
                            <button type="button" @click="showYoutube = false" class="flex-1 py-2 text-xs font-bold text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors cursor-pointer border border-slate-200 min-h-[44px]">Batal</button>
                            <button type="submit" class="flex-1 py-2 text-xs font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors cursor-pointer shadow-md shadow-red-500/30 min-h-[44px]">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
