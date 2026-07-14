<div class="bg-white rounded-2xl border {{ $target->dokumenBuktis->count() > 0 ? 'border-green-200/80 bg-green-50/10' : 'border-slate-200 bg-white' }} p-4 shadow-sm hover:shadow-md transition-all flex flex-col justify-between h-full min-h-[180px] relative overflow-hidden group">
    
    <!-- Left marker color -->
    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $target->dokumenBuktis->count() > 0 ? 'bg-[#0a7a3b]' : 'bg-slate-300' }}"></div>

    <div class="pl-2.5 flex-1 flex flex-col justify-between">
        
        <!-- Header -->
        <div>
            <div class="flex items-center justify-between gap-2 mb-2">
                <span class="px-2 py-0.5 {{ $target->dokumenBuktis->count() > 0 ? 'bg-green-100/60 text-[#0a7a3b] border-green-200' : 'bg-slate-100 text-slate-600 border-slate-200' }} border rounded text-[9px] font-black uppercase tracking-wider">
                    Slot {{ $code }}
                </span>
                
                @if ($target->dokumenBuktis->count() > 0)
                    <span class="inline-flex items-center gap-1 text-[9px] font-bold text-[#0a7a3b] uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0a7a3b]"></span> Terpenuhi
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 text-[9px] font-bold text-slate-400 uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span> Kosong
                    </span>
                @endif
            </div>
            
            <h6 class="text-[11px] font-bold text-slate-800 leading-snug group-hover:text-[#0a7a3b] transition-colors" title="{{ $title }}">
                {{ Str::limit($title, 70) }}
            </h6>
        </div>

        <!-- Files list -->
        <div class="my-4 space-y-2 flex-1 flex flex-col justify-center">
            @if ($target->dokumenBuktis->count() > 0)
                <div class="space-y-2">
                    @foreach ($target->dokumenBuktis as $dokumen)
                        <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white border border-slate-200/60 hover:border-[#0a7a3b]/40 hover:bg-green-50/10 transition-all">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <a href="{{ route('dokumen.view', $dokumen->id) }}" class="text-[10px] font-black text-slate-700 hover:text-[#0a7a3b] truncate block" title="{{ $dokumen->nama_file }}">
                                    {{ $dokumen->nama_file }}
                                </a>
                            </div>
                            
                            <form action="{{ route('admin.dokumen.delete', $dokumen->id) }}" method="POST" class="shrink-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-6 h-6 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-red-100 cursor-pointer" title="Hapus Dokumen">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-3 border border-dashed border-slate-200 rounded-xl bg-slate-50/30">
                    <span class="text-[10px] text-slate-400 font-semibold block">Belum ada dokumen bukti</span>
                </div>
            @endif
        </div>

        <!-- Upload Form -->
        @if ($target->dokumenBuktis->count() == 0)
        <div class="mt-auto">
            <form action="{{ route('admin.akreditasi.upload.spesifik', [$type, $target->id]) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <input type="file" name="dokumen" required id="file-{{ $type }}-{{ $target->id }}" 
                       onchange="this.form.submit()"
                       class="hidden">
                
                <label for="file-{{ $type }}-{{ $target->id }}" class="w-full flex items-center justify-center gap-1.5 py-2 px-3 border border-dashed border-slate-300 hover:border-[#0a7a3b]/40 bg-slate-50/50 hover:bg-green-50/20 text-slate-500 hover:text-[#0a7a3b] rounded-xl text-[10px] font-extrabold transition-all cursor-pointer shadow-sm shadow-slate-900/5 active:scale-[0.98]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    <span>Pilih & Unggah</span>
                </label>
            </form>
        </div>
        @endif

    </div>
</div>
