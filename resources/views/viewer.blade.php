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
            height: 60px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .viewer-container {
            height: calc(100vh - 60px);
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
    @endphp
    <div class="header">
        <div class="flex items-center gap-4">
            <a href="{{ $previousUrl }}" onclick="if(window.opener) { window.close(); return false; }" class="text-slate-500 hover:text-slate-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-sm font-bold text-slate-800">{{ $dokumen->nama_file }}</h1>
                <p class="text-xs text-slate-500">Diunggah pada {{ \Carbon\Carbon::parse($dokumen->tanggal_upload)->format('d M Y') }}</p>
            </div>
        </div>
        <a href="{{ Storage::url($dokumen->path_file) }}" download class="bg-[#0a7a3b] hover:bg-[#086330] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Unduh Dokumen
        </a>
    </div>

    <div class="viewer-container">
        @php
            $ext = strtolower(pathinfo($dokumen->path_file, PATHINFO_EXTENSION));
            $url = url(Storage::url($dokumen->path_file));
        @endphp

        @if($ext == 'pdf')
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
    </div>
</body>
</html>
