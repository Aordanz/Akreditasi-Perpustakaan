<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Progres Akreditasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { font-size: 12pt; }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body class="bg-white text-slate-800 p-8" onload="window.print()">

    @php
        $totalSub = $komponens->sum(fn($k) => $k->subKomponens->count());
        $subTerisi = $komponens->flatMap->subKomponens->filter(fn($sub) => $sub->dokumenBuktis->count() > 0)->count();
        $persentase = $totalSub > 0 ? round(($subTerisi / $totalSub) * 100) : 0;
    @endphp

    <!-- Header Laporan -->
    <div class="text-center mb-8 border-b-2 border-slate-800 pb-4">
        <h1 class="text-2xl font-bold uppercase tracking-wider">Laporan Kelengkapan Instrumen Akreditasi</h1>
        <h2 class="text-xl font-semibold mt-1">Perpustakaan Universitas Sumatera Utara</h2>
        <p class="text-sm text-slate-500 mt-2">Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <!-- Ringkasan Eksekutif -->
    <div class="mb-8 flex justify-between items-center bg-slate-100 p-4 rounded-lg border border-slate-300">
        <div>
            <div class="text-sm text-slate-500 font-bold uppercase tracking-wider">Total Progress Kelengkapan</div>
            <div class="text-3xl font-black text-[#0a7a3b]">{{ $persentase }}% Selesai</div>
        </div>
        <div class="text-right">
            <div class="text-sm font-bold text-slate-700">Sub Komponen Terisi: {{ $subTerisi }} dari {{ $totalSub }}</div>
            <div class="text-sm font-bold text-slate-700 mt-1">Total Dokumen: {{ collect($komponens)->flatMap->subKomponens->flatMap->dokumenBuktis->count() }} File</div>
        </div>
    </div>

    <div class="no-print mb-6">
        <a href="{{ route('admin.dashboard') }}" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-slate-700">← Kembali ke Dashboard</a>
        <button onclick="window.print()" class="bg-[#0a7a3b] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-[#086330] ml-2">🖨️ Cetak / Simpan PDF</button>
    </div>

    <!-- Rincian per Komponen -->
    @foreach ($komponens as $komponen)
        @php
            $k_totalSub = $komponen->subKomponens->count();
            $k_subTerisi = $komponen->subKomponens->filter(fn($sub) => $sub->dokumenBuktis->count() > 0)->count();
            $k_persentase = $k_totalSub > 0 ? round(($k_subTerisi / $k_totalSub) * 100) : 0;
        @endphp

        <div class="mb-6 page-break-inside-avoid">
            <div class="bg-slate-800 text-white p-3 rounded-t-lg flex justify-between items-center">
                <h3 class="font-bold text-lg">Komponen {{ $komponen->nomor }}: {{ $komponen->nama_komponen }}</h3>
                <span class="font-bold bg-white/20 px-3 py-1 rounded">{{ $k_persentase }}%</span>
            </div>
            <table class="w-full border-collapse border border-slate-300 text-sm">
                <thead>
                    <tr class="bg-slate-100">
                        <th class="border border-slate-300 p-2 text-left w-24">No</th>
                        <th class="border border-slate-300 p-2 text-left">Sub Komponen</th>
                        <th class="border border-slate-300 p-2 text-center w-32">Status Dokumen</th>
                        <th class="border border-slate-300 p-2 text-center w-24">Jml File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($komponen->subKomponens as $sub)
                        @php
                            $docCount = $sub->dokumenBuktis->count();
                        @endphp
                        <tr class="{{ $docCount > 0 ? 'bg-white' : 'bg-red-50' }}">
                            <td class="border border-slate-300 p-2 font-semibold">{{ $sub->nomor_sub }}</td>
                            <td class="border border-slate-300 p-2">{{ $sub->nama_sub_komponen }}</td>
                            <td class="border border-slate-300 p-2 text-center">
                                @if($docCount > 0)
                                    <span class="text-green-600 font-bold">Terisi</span>
                                @else
                                    <span class="text-red-600 font-bold">KOSONG</span>
                                @endif
                            </td>
                            <td class="border border-slate-300 p-2 text-center font-bold">{{ $docCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="mt-12 text-center text-sm text-slate-500 pt-4 border-t border-slate-300">
        <p>Laporan ini dicetak secara otomatis dari Sistem Akreditasi Perpustakaan USU.</p>
    </div>

</body>
</html>
