<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Progres Akreditasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Highcharts CDNs for 3D Charts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <style>
        /* Base styles that apply always */
        .page-break-inside-avoid {
            page-break-inside: avoid;
            break-inside: avoid;
        }
        
        @media print {
            @page {
                size: A4 portrait;
                margin: 1.5cm; /* Set margins so content doesn't get cut off at edges */
            }

            body { 
                font-size: 11pt; 
                color: #000 !important; 
                padding: 0 !important; /* Let @page handle margins */
                margin: 0 !important;
                width: 100% !important;
            }
            
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
            
            /* Paksa semua font menjadi hitam saat dicetak (kecuali grafik) */
            *:not(.highcharts-container *) { color: #000 !important; }
            
            /* Hapus background warna-warni yang menghabiskan tinta */
            .bg-slate-800 { background-color: transparent !important; border: 1px solid #000; border-bottom: none; }
            .bg-slate-100 { background-color: transparent !important; }
            .bg-red-50, .bg-white { background-color: transparent !important; }
            .bg-slate-100.p-4 { border: 1px solid #000 !important; }
            
            /* Pengaturan khusus tabel dengan font Times New Roman */
            table {
                font-family: "Times New Roman", Times, serif !important;
                border: 1px solid #000 !important;
                width: 100% !important;
                table-layout: auto !important;
                border-collapse: collapse !important;
            }
            table th, table td {
                border: 1px solid #000 !important;
                color: #000 !important;
                padding: 6px 8px !important; /* Lebar sel yang rapi */
            }
            
            /* Mencegah tabel atau baris terpotong di tengah halaman */
            table, tr, th, td {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            
            /* Hapus bayangan dan lengkungan (radius) agar lebih formal */
            .shadow-sm, .rounded-lg, .rounded-t-lg, .rounded, .rounded-2xl {
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            
            /* Warna border disamakan jadi hitam */
            .border-slate-300, .border-slate-800, .border-b-2 { 
                border-color: #000 !important; 
            }
        }
    </style>
</head>
<body class="bg-white text-slate-800 p-8">

    @php
        $globalTotalSlot = 0;
        $globalSlotTerisi = 0;
        $totalDocs = 0;
        
        foreach ($komponens as $komponen) {
            foreach ($komponen->subKomponens as $sub) {
                if ($sub->indikators->count() > 0) {
                    foreach ($sub->indikators as $ind) {
                        if ($ind->subIndikators->count() > 0) {
                            foreach ($ind->subIndikators as $si) {
                                $globalTotalSlot++;
                                $validDocs = $si->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                                if ($validDocs > 0) $globalSlotTerisi++;
                                $totalDocs += $si->dokumenBuktis->count();
                            }
                        } else {
                            $globalTotalSlot++;
                            $validDocs = $ind->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                            if ($validDocs > 0) $globalSlotTerisi++;
                            $totalDocs += $ind->dokumenBuktis->count();
                        }
                    }
                } else {
                    $globalTotalSlot++;
                    $validDocs = $sub->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                    if ($validDocs > 0) $globalSlotTerisi++;
                    $totalDocs += $sub->dokumenBuktis->count();
                }
            }
        }
        $persentase = $globalTotalSlot > 0 ? round(($globalSlotTerisi / $globalTotalSlot) * 100) : 0;
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
            <div class="text-sm font-bold text-slate-700">Slot Terisi: {{ $globalSlotTerisi }} dari {{ $globalTotalSlot }}</div>
            <div class="text-sm font-bold text-slate-700 mt-1">Total Dokumen: {{ $totalDocs }} File</div>
        </div>
    </div>

    @php
        $chartData = [];
        $komponenProgress = [];
        
        foreach ($komponens as $komponen) {
            $k_totalSlot = 0;
            $k_slotTerisi = 0;
            $subCategories = [];
            $subValues = [];
            
            foreach ($komponen->subKomponens as $sub) {
                $subTotalSlot = 0;
                $subSlotTerisi = 0;
                
                if ($sub->indikators->count() > 0) {
                    foreach ($sub->indikators as $ind) {
                        if ($ind->subIndikators->count() > 0) {
                            foreach ($ind->subIndikators as $si) {
                                $subTotalSlot++;
                                $k_totalSlot++;
                                $validDocs = $si->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                                if ($validDocs > 0) {
                                    $subSlotTerisi++;
                                    $k_slotTerisi++;
                                }
                            }
                        } else {
                            $subTotalSlot++;
                            $k_totalSlot++;
                            $validDocs = $ind->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                            if ($validDocs > 0) {
                                $subSlotTerisi++;
                                $k_slotTerisi++;
                            }
                        }
                    }
                } else {
                    $subTotalSlot++;
                    $k_totalSlot++;
                    $validDocs = $sub->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count();
                    if ($validDocs > 0) {
                        $subSlotTerisi++;
                        $k_slotTerisi++;
                    }
                }
                
                $subPersentase = $subTotalSlot > 0 ? round(($subSlotTerisi / $subTotalSlot) * 100) : 0;
                $subCategories[] = (string)$sub->nomor_sub;
                $subValues[] = $subPersentase;
            }
            
            $k_persentase = $k_totalSlot > 0 ? round(($k_slotTerisi / $k_totalSlot) * 100) : 0;
            $komponenProgress[] = [
                'name' => 'Komp ' . $komponen->nomor,
                'y' => $k_persentase
            ];
            
            $chartData[$komponen->nomor] = [
                'title' => $komponen->nomor . '. ' . $komponen->nama_komponen,
                'categories' => $subCategories,
                'values' => $subValues
            ];
        }
    @endphp

    <!-- Grafik/Visualisasi Kelengkapan (Page Break after this) -->
    <div class="mb-8 page-break-inside-avoid">
        <h2 class="text-xl font-bold text-center mb-6 uppercase tracking-wider text-slate-800">Visualisasi Kelengkapan Dokumen Bukti Fisik</h2>
        
        <!-- Row 1: Komponen 1, 2, 3 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div id="chart-komp-1" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
            <div id="chart-komp-2" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
            <div id="chart-komp-3" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
        </div>

        <!-- Row 2: Komponen 4, 5, 6 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div id="chart-komp-4" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
            <div id="chart-komp-5" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
            <div id="chart-komp-6" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 260px;"></div>
        </div>

        <!-- Row 3: Progres Per Komponen & Progres Keseluruhan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div id="chart-komp-progress" class="md:col-span-2 border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 300px;"></div>
            <div id="chart-total-progress" class="border border-slate-200 rounded-lg p-2 bg-white shadow-2xs" style="height: 300px;"></div>
        </div>
    </div>
    
    <div class="page-break mb-8"></div>

    <div class="no-print mb-6">
        <a href="{{ route('admin.dashboard') }}" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-slate-700">← Kembali ke Dashboard</a>
        <button onclick="window.print()" class="bg-[#0a7a3b] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-[#086330] ml-2">🖨️ Cetak / Simpan PDF</button>
    </div>

    <!-- Rincian per Komponen -->
    @foreach ($komponens as $komponen)
        @php
            $k_totalSlot = 0;
            $k_slotTerisi = 0;
            
            foreach ($komponen->subKomponens as $sub) {
                $subTotalSlot = 0;
                $subSlotTerisi = 0;
                $sub_docCount = 0;
                
                if ($sub->indikators->count() > 0) {
                    foreach ($sub->indikators as $ind) {
                        if ($ind->subIndikators->count() > 0) {
                            foreach ($ind->subIndikators as $si) {
                                $subTotalSlot++;
                                $k_totalSlot++;
                                if ($si->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) {
                                    $subSlotTerisi++;
                                    $k_slotTerisi++;
                                }
                                $sub_docCount += $si->dokumenBuktis->count();
                            }
                        } else {
                            $subTotalSlot++;
                            $k_totalSlot++;
                            if ($ind->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) {
                                $subSlotTerisi++;
                                $k_slotTerisi++;
                            }
                            $sub_docCount += $ind->dokumenBuktis->count();
                        }
                    }
                } else {
                    $subTotalSlot++;
                    $k_totalSlot++;
                    if ($sub->dokumenBuktis->filter(fn($d) => !empty($d->nama_file))->count() > 0) {
                        $subSlotTerisi++;
                        $k_slotTerisi++;
                    }
                    $sub_docCount += $sub->dokumenBuktis->count();
                }
                
                if ($subTotalSlot > 0 && $subSlotTerisi === $subTotalSlot) {
                    $sub->is_terisi = true;
                } else {
                    $sub->is_terisi = false;
                }
                $sub->doc_count = $sub_docCount;
                $sub->slot_terisi = $subSlotTerisi;
                $sub->total_slot = $subTotalSlot;
            }
            $k_persentase = $k_totalSlot > 0 ? round(($k_slotTerisi / $k_totalSlot) * 100) : 0;
        @endphp

        <div class="mb-6 page-break-inside-avoid">
            <div class="bg-slate-800 text-white p-3 rounded-t-lg flex justify-between items-center">
                <h3 class="font-bold text-lg truncate pr-4">Komponen {{ $komponen->nomor }}: {{ $komponen->nama_komponen }}</h3>
                <span class="font-bold bg-white/20 px-3 py-1 rounded shrink-0">{{ $k_persentase }}%</span>
            </div>
            <div class="overflow-x-auto rounded-b-lg border-x border-b border-slate-300 shadow-sm relative">
                <!-- Visual cue gradient for horizontal scroll -->
                <div class="absolute right-0 top-0 bottom-0 w-4 bg-gradient-to-l from-black/5 to-transparent pointer-events-none md:hidden"></div>
                
                <table class="w-full border-collapse text-sm min-w-[600px]">
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
                        <tr class="{{ $sub->is_terisi ? 'bg-white' : 'bg-red-50' }}">
                            <td class="border border-slate-300 p-2 font-semibold">{{ $sub->nomor_sub }}</td>
                            <td class="border border-slate-300 p-2">{{ $sub->nama_sub_komponen }}</td>
                            <td class="border border-slate-300 p-2 text-center">
                                @if($sub->is_terisi)
                                    <span class="text-green-600 font-bold">Terisi Lengkap</span>
                                @else
                                    <span class="text-red-600 font-bold">BELUM LENGKAP ({{ $sub->slot_terisi }}/{{ $sub->total_slot }} Slot)</span>
                                @endif
                            </td>
                            <td class="border border-slate-300 p-2 text-center font-bold">{{ $sub->doc_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endforeach

    <div class="mt-12 text-center text-sm text-slate-500 pt-4 border-t border-slate-300">
        <p>Laporan ini dicetak secara otomatis dari Sistem Akreditasi Perpustakaan USU.</p>
    </div>

    <!-- Script for rendering Highcharts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper to get axis title
            function getAxisTitle(titleText) {
                const clean = titleText.replace(/^\d+\.\s*/, '').replace(/^KOMPONEN\s+/i, '');
                const titleCased = clean.toLowerCase().split(' ').map(word => {
                    if (['dan', 'atau', 'di', 'ke', 'dari', 'pada', 'yang', 'untuk', 'dalam'].includes(word)) {
                        return word;
                    }
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }).join(' ');
                return 'Aspek ' + titleCased;
            }

            // Global configuration options for all sub-komponen charts
            const commonOptions = {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 15,
                        depth: 45,
                        viewDistance: 25
                    },
                    spacingBottom: 15
                },
                yAxis: {
                    title: {
                        text: 'Capaian',
                        style: {
                            fontWeight: 'bold',
                            fontSize: '9px'
                        }
                    },
                    max: 100,
                    min: 0,
                    labels: {
                        format: '{value}%',
                        style: {
                            fontSize: '8px'
                        }
                    }
                },
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                }
            };

            const chartData = @json($chartData);
            const komponenProgress = @json($komponenProgress);
            const totalProgress = {{ $persentase }};

            // 1. Render Component 1 to 6 charts
            for (let i = 1; i <= 6; i++) {
                const data = chartData[i];
                if (data) {
                    Highcharts.chart('chart-komp-' + i, {
                        ...commonOptions,
                        title: {
                            text: String(i),
                            align: 'left',
                            style: {
                                fontSize: '18px',
                                fontWeight: 'bold',
                                color: '#94a3b8'
                            }
                        },
                        subtitle: {
                            text: data.title.replace(/^\d+\.\s*/, '').toUpperCase(),
                            align: 'left',
                            style: {
                                fontSize: '9px',
                                fontWeight: 'bold',
                                color: '#64748b'
                            }
                        },
                        xAxis: {
                            categories: data.categories,
                            title: {
                                text: getAxisTitle(data.title),
                                style: {
                                    fontSize: '9px',
                                    fontWeight: 'bold'
                                }
                            },
                            labels: {
                                style: {
                                    fontSize: '8px'
                                }
                            }
                        },
                        plotOptions: {
                            column: {
                                depth: 25,
                                color: '#4285f4', // Standard Google Blue
                                dataLabels: {
                                    enabled: true,
                                    format: '{y}%',
                                    style: {
                                        fontSize: '8px',
                                        fontWeight: 'bold',
                                        textOutline: 'none'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Capaian',
                            data: data.values
                        }]
                    });
                }
            }

            // 2. Render Progres Per Komponen (Chart 7 - Red Theme)
            Highcharts.chart('chart-komp-progress', {
                ...commonOptions,
                title: {
                    text: 'PROGRES PENGERJAAN BUKTI FISIK PER KOMPONEN',
                    align: 'center',
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                        color: '#1e293b'
                    }
                },
                xAxis: {
                    categories: komponenProgress.map(k => k.name.replace('Komp ', '')),
                    title: {
                        text: 'Komponen Penilaian',
                        style: {
                            fontSize: '9px',
                            fontWeight: 'bold'
                        }
                    },
                    labels: {
                        style: {
                            fontSize: '9px'
                        }
                    }
                },
                plotOptions: {
                    column: {
                        depth: 30,
                        color: '#db4437', // Google Red
                        dataLabels: {
                            enabled: true,
                            format: '{y}%',
                            style: {
                                fontSize: '9px',
                                fontWeight: 'bold',
                                textOutline: 'none'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Progres',
                    data: komponenProgress.map(k => k.y)
                }]
            });

            // 3. Render Progress Keseluruhan (Chart 8 - Green Theme)
            Highcharts.chart('chart-total-progress', {
                ...commonOptions,
                title: {
                    text: 'PROGRESS PENGERJAAN BUKTI FISIK KESELURUHAN',
                    align: 'center',
                    style: {
                        fontSize: '11px',
                        fontWeight: 'bold',
                        color: '#1e293b'
                    }
                },
                xAxis: {
                    categories: ['Total'],
                    labels: {
                        style: {
                            fontSize: '9px'
                        }
                    }
                },
                plotOptions: {
                    column: {
                        depth: 35,
                        color: '#0f9d58', // Google Green
                        dataLabels: {
                            enabled: true,
                            format: '{y}%',
                            style: {
                                fontSize: '10px',
                                fontWeight: 'bold',
                                textOutline: 'none'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Total',
                    data: [totalProgress]
                }]
            });

            // Auto-trigger window print after rendering completes
            setTimeout(function() {
                window.print();
            }, 1200);
        });
    </script>

</body>
</html>
