@php
    $allDocs = $target->dokumenBuktis;
    $uploadedDocs = $allDocs->filter(fn($d) => !empty($d->nama_file));
    $emptySlots = $allDocs->filter(fn($d) => empty($d->nama_file));
    $hasFiles = $uploadedDocs->count() > 0;
@endphp

<div class="bg-white rounded-2xl border-2 {{ $hasFiles ? 'border-emerald-500/80 bg-emerald-50/20 shadow-sm' : 'border-slate-200/90 bg-white hover:border-slate-300' }} p-4.5 transition-all duration-200 flex flex-col justify-between h-full min-h-[190px] relative overflow-hidden group hover:shadow-md">
    
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
            
            <h6 class="text-xs font-bold text-slate-800 leading-snug group-hover:text-[#0a7a3b] transition-colors" title="{{ $title }}">
                {{ Str::limit($title, 80) }}
            </h6>
        </div>

        <!-- Files list -->
        <div class="my-3.5 space-y-2 flex-1 flex flex-col justify-center">
            @if ($hasFiles)
                <div class="space-y-2">
                    @foreach ($uploadedDocs as $dokumen)
                        @php
                            $isYt = $dokumen->is_youtube;
                            $fileExists = $isYt ? true : ($dokumen->path_file ? Storage::disk('public')->exists($dokumen->path_file) : false);
                        @endphp
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl {{ $fileExists ? 'bg-white border border-emerald-200/80 shadow-2xs' : 'bg-amber-50 border border-amber-200' }} transition-all">
                            <div class="flex items-center gap-2 min-w-0">
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
                            
                            <form action="{{ route('admin.dokumen.delete', $dokumen->id) }}" method="POST" class="shrink-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-6 h-6 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-100 cursor-pointer" title="Hapus Dokumen">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4 border-2 border-dashed border-red-200/80 rounded-xl bg-red-50/20">
                    <svg class="w-6 h-6 mx-auto text-red-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <span class="text-[10px] text-red-400 font-extrabold uppercase block tracking-wider">Belum Ada Dokumen Bukti</span>
                </div>
            @endif
        </div>

        <!-- Upload Form & YouTube Option -->
        <div class="mt-auto pt-1" x-data="{ showYoutube: false }">
            <form action="{{ route('admin.akreditasi.upload.spesifik', [$type, $target->id]) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <!-- File input -->
                <input type="file" name="dokumen" id="file-{{ $type }}-{{ $target->id }}" 
                       onchange="this.form.submit()"
                       class="hidden">
                
                <div class="flex gap-2" x-show="!showYoutube">
                    <label for="file-{{ $type }}-{{ $target->id }}" class="flex-1 flex items-center justify-center gap-1.5 py-2 px-2 border {{ $hasFiles ? 'border-emerald-300 bg-white hover:bg-emerald-50 text-emerald-700' : 'border-dashed border-[#0a7a3b] bg-green-50/50 hover:bg-[#0a7a3b] text-[#0a7a3b] hover:text-white' }} rounded-xl text-[10px] font-black transition-all cursor-pointer shadow-2xs active:scale-[0.98] truncate">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        <span>{{ $hasFiles ? 'Tambah File' : 'Unggah File' }}</span>
                    </label>
                    <button type="button" @click="showYoutube = true" class="px-3 py-2 rounded-xl border border-red-200 hover:border-red-500 bg-red-50/50 hover:bg-red-500 hover:text-white text-red-600 transition-colors shadow-2xs flex items-center justify-center cursor-pointer active:scale-[0.98]" title="Tambah Link YouTube">
                        <!-- YouTube Icon -->
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </button>
                </div>

                <!-- Youtube Form -->
                <div x-show="showYoutube" x-cloak x-transition class="space-y-2 mt-2 bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                    <div class="text-[9px] font-bold text-slate-500 uppercase tracking-wider">Input Link YouTube</div>
                    <input type="url" name="youtube_link" placeholder="https://youtube.com/watch?v=..." class="w-full text-[10px] p-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 bg-white">
                    <input type="text" name="nama_video" placeholder="Nama Video (Opsional)" class="w-full text-[10px] p-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 bg-white">
                    <div class="flex gap-2 justify-end">
                        <button type="button" @click="showYoutube = false" class="px-2 py-1 text-[9px] font-bold text-slate-500 hover:text-slate-700 bg-slate-200/60 rounded-lg cursor-pointer">Batal</button>
                        <button type="submit" class="px-2.5 py-1 text-[9px] font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg cursor-pointer">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
