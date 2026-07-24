<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $dokumen->nama_file }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background-color: #f3f4f6;
        }
        .header {
            min-height: 60px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            gap: 12px;
        }
        .viewer-container {
            height: {{ request()->has('embed') ? '100vh' : 'calc(100vh - 60px)' }};
            width: 100%;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    @php
        $previousUrl = url()->previous();
        if (!$previousUrl || $previousUrl == request()->url()) {
            $previousUrl = Auth::check() ? '/admin/dashboard' : '/akreditasi';
        }
        $isYoutube = $dokumen->is_youtube;
        $isDrive = $dokumen->is_drive;
        $fileExists = ($isYoutube || $isDrive) ? true : Storage::disk('public')->exists($dokumen->path_file);
    @endphp
    @if(!request()->has('embed'))
    <div class="header">
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <a href="{{ $previousUrl }}" onclick="if(window.opener) { window.close(); return false; }" class="text-slate-500 hover:text-slate-800 transition-colors shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div class="min-w-0">
                <h1 class="text-xs sm:text-sm font-bold text-slate-800 truncate" title="{{ $dokumen->nama_file }}">{{ $dokumen->nama_file }}</h1>
                <p class="text-[10px] sm:text-xs text-slate-500 truncate">Diunggah pada {{ \Carbon\Carbon::parse($dokumen->tanggal_upload)->format('d M Y') }}</p>
            </div>
        </div>
        @if ($fileExists && !$isYoutube)
        <a href="{{ Storage::url($dokumen->path_file) }}" download class="shrink-0 bg-[#0a7a3b] hover:bg-[#086330] text-white px-3 sm:px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            <span class="hidden sm:inline">Unduh Dokumen</span>
        </a>
        @elseif($isYoutube)
        <a href="{{ $dokumen->path_file }}" target="_blank" class="shrink-0 bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
            <span class="hidden sm:inline">Buka di YouTube</span>
        </a>
        @elseif($isDrive)
        <a href="{{ $dokumen->path_file }}" target="_blank" class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 2.215L17.265 11.3l-5.255 9.1L6.755 11.3l5.255-9.085zM6.55 11.69l3.96 6.85-2.025 3.52-6.28-10.875L4.405 7.42l2.145 4.27zM17.45 11.69l-2.145-4.27 2.195-3.795 6.295 10.875-2.035 3.52-4.31-6.33z"/></svg>
            <span class="hidden sm:inline">Buka di Google Drive</span>
        </a>
        @endif
    </div>
    @endif

    <div class="viewer-container">
        @if (!$fileExists)
            <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                <div class="w-20 h-20 bg-amber-50 text-amber-500 border border-amber-200 rounded-full flex items-center justify-center mb-4 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 mb-2">Dokumen Tidak Ditemukan</h2>
                <p class="text-sm text-slate-500 max-w-md mb-6 leading-relaxed">
                    File fisik dari dokumen ini tidak ditemukan pada server atau telah dihapus oleh administrator.
                </p>
                <a href="{{ $previousUrl }}" class="px-5 py-2.5 bg-[#0a7a3b] text-white font-bold rounded-xl shadow-md hover:bg-[#086330] transition-colors text-sm">
                    Kembali ke halaman Akreditasi
                </a>
            </div>
        @else
            @php
                $ext = (!$isYoutube && !$isDrive) ? strtolower(pathinfo($dokumen->path_file, PATHINFO_EXTENSION)) : '';
                $url = (!$isYoutube && !$isDrive) ? url(Storage::url($dokumen->path_file)) : '';
            @endphp

            @if($isYoutube)
                <!-- YouTube Embed Video -->
                <iframe src="{{ $dokumen->youtube_embed_url }}" title="{{ $dokumen->nama_file }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @elseif($isDrive)
                <!-- Google Drive Viewer -->
                <iframe src="{{ str_replace('/view', '/preview', $dokumen->path_file) }}" title="{{ $dokumen->nama_file }}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            @elseif($ext == 'pdf')
                <!-- Native PDF Viewer -->
                <iframe src="{{ Storage::url($dokumen->path_file) }}#toolbar=0" title="{{ $dokumen->nama_file }}"></iframe>
            @elseif(in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                <!-- Google Docs Viewer for Office Files -->
                <iframe src="https://docs.google.com/gview?url={{ urlencode($url) }}&embedded=true" title="{{ $dokumen->nama_file }}"></iframe>
            @else
                <!-- Fallback if format is not supported -->
                <div class="flex flex-col items-center justify-center h-full text-slate-500">
                    <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-lg font-medium">Format dokumen tidak didukung untuk pratinjau.</p>
                    <p class="text-sm mt-2">Silakan unduh dokumen untuk melihat isinya.</p>
                </div>
            @endif
        @endif
    </div>
</body>
</html>
