<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akreditasi Perpustakaan USU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .bg-pattern {
            background-image: radial-gradient(circle at 10% 20%, rgba(141, 198, 63, 0.1) 0%, transparent 40%),
                              radial-gradient(circle at 90% 80%, rgba(254, 203, 0, 0.05) 0%, transparent 40%);
        }
        .hero-pattern {
            background: linear-gradient(135deg, var(--color-usu-dark) 0%, var(--color-usu-green) 50%, #1e8749 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-pattern::before {
            content: "";
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(141, 198, 63, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 80% 80%, rgba(254, 203, 0, 0.1) 0%, transparent 30%);
            z-index: 0;
            pointer-events: none;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="text-slate-800 antialiased bg-pattern">

    <!-- Topbar -->
    <div class="bg-usu-dark text-white py-1 px-4 text-xs flex justify-end gap-4 font-semibold">
        <a href="#" class="hover:text-usu-light transition">USU Official</a>
        <a href="#" class="hover:text-usu-light transition">MBKM</a>
        <a href="#" class="hover:text-usu-light transition">DIGILIB</a>
        <a href="#" class="hover:text-usu-light transition">Repositori USU</a>
        <a href="#" class="hover:text-usu-light transition">Resource Guide</a>
        <span class="border-l border-white/30 pl-4 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
            IN ENGLISH
        </span>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <!-- Logo USU -->
                <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-12 h-12 object-contain">
                <span class="font-bold text-xl text-black">Perpustakaan</span>
            </div>
            <nav class="hidden md:flex gap-6 font-semibold text-sm text-usu-green">
                <a href="#" class="hover:text-usu-light transition">Beranda</a>
                <a href="#" class="hover:text-usu-light transition">Profil</a>
                <a href="#" class="hover:text-usu-light transition">Layanan</a>
                <a href="#" class="hover:text-usu-light transition">Koleksi</a>
                <a href="#" class="hover:text-usu-light transition">Fasilitas</a>
                <a href="#" class="hover:text-usu-light transition">Berita</a>
                <a href="#" class="hover:text-usu-light transition">Informasi</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern text-white py-20 px-4">
        <div class="max-w-7xl mx-auto hero-content">
            <h2 class="text-3xl md:text-5xl font-extrabold italic mb-2 font-serif text-usu-light">Bukti Akreditasi</h2>
            <h1 class="text-5xl md:text-7xl font-black tracking-tight mb-6 drop-shadow-lg uppercase">Perpustakaan USU</h1>
            
            <div class="flex flex-col md:flex-row gap-6 mt-8">
                <div class="flex-1 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-usu-yellow flex items-center justify-center text-usu-dark shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Akreditasi Kategori "A"</p>
                            <p class="text-white/80 text-sm">Diraih pada tahun 2021 dari Perpustakaan Nasional RI</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-usu-yellow flex items-center justify-center text-usu-dark shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">PTN-BH & ISO 9001:2015</p>
                            <p class="text-white/80 text-sm">Berstandar mutu internasional & pengelolaan mandiri</p>
                        </div>
                    </div>
                </div>
                
                <!-- Mock QR Code -->
                <div class="bg-white p-2 rounded-xl shrink-0 self-start border-4 border-usu-yellow/50 shadow-2xl transform rotate-3 hover:rotate-0 transition duration-300">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=Akreditasi+Perpustakaan+USU" alt="QR Code" class="w-28 h-28 opacity-90 mix-blend-multiply">
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-16">
        
        <!-- Highlighted Administrasi Component -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 mb-16 transform transition hover:shadow-2xl">
            <div class="bg-usu-green px-8 py-6 flex justify-between items-center border-b-4 border-usu-light">
                <div>
                    <span class="bg-usu-yellow text-usu-dark text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block">Sorotan Utama</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white">Komponen 5: Administrasi</h2>
                    <p class="text-white/80 mt-1">Penyelenggaraan dan Pengelolaan Perpustakaan</p>
                </div>
                <div class="w-20 h-20 bg-white rounded-full flex flex-col items-center justify-center shadow-inner border-4 border-usu-light shrink-0">
                    <span class="text-3xl font-black text-usu-green leading-none">4</span>
                    <span class="text-[0.65rem] text-slate-500 uppercase font-bold mt-1">Skor Maks</span>
                </div>
            </div>
            
            <div class="p-8">
                <p class="text-slate-600 mb-8 max-w-3xl text-lg">Berdasarkan instrumen Perka PNRI No. 10/2018, komponen ini mencakup struktur organisasi, program kerja, evaluasi, hingga manajemen anggaran. Berikut adalah bukti yang menjadikan komponen ini meraih skor maksimal (4):</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Evidence 1 -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Kebijakan & Manajemen Mutu</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">Sertifikasi <strong>ISO 9001:2015</strong> yang diraih pada 2020 membuktikan adanya implementasi Sistem Manajemen Mutu secara tertulis, terstruktur, dan dievaluasi rutin sesuai kriteria (skor 4 mensyaratkan kelengkapan kebijakan tertulis).</p>
                        </div>
                    </div>
                    
                    <!-- Evidence 2 -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Struktur PTN-BH yang Kuat</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">Diperkuat dengan SK Rektor, struktur kelembagaan mengakomodasi transisi USU sebagai Perguruan Tinggi Negeri Berbadan Hukum (PTN-BH) dengan membagi tugas jelas ke Bidang Layanan Teknis, TI, hingga Tata Usaha.</p>
                        </div>
                    </div>

                    <!-- Evidence 3 -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Evaluasi Rutin (Monev)</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">Laporan pelaksanaan kegiatan terstruktur (tahunan, triwulan, bulanan). Adanya monitoring dan evaluasi ketat terhadap fasilitas elektronik, langganan <em>database</em>, dan integrasi dengan fakultas.</p>
                        </div>
                    </div>

                    <!-- Evidence 4 -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Dukungan Anggaran</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">Pengelolaan alokasi dana mandiri memastikan operasional 42 jam/minggu berjalan lancar. Peningkatan infrastruktur perpustakaan cabang turut membuktikan persentase anggaran yang sangat memadai (lebih dari standar 5%).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Components Overview -->
        <h3 class="text-2xl font-bold text-slate-800 mb-8 border-l-4 border-usu-light pl-4">Ringkasan Komponen Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700">Koleksi</h4>
                    <span class="bg-slate-100 text-slate-600 font-bold px-2 py-1 rounded text-sm">3 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4">
                    <div class="bg-usu-light h-2 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-xs text-slate-500">Mencakup kelengkapan judul buku, jurnal elektronik, dan <em>database</em> terlanggan.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700">Sarana & Prasarana</h4>
                    <span class="bg-usu-green/10 text-usu-green font-bold px-2 py-1 rounded text-sm">4 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4">
                    <div class="bg-usu-green h-2 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-500">Gedung megah di pusat kampus, area baca nyaman, dan fasilitas TIK canggih.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700">Pelayanan</h4>
                    <span class="bg-usu-green/10 text-usu-green font-bold px-2 py-1 rounded text-sm">4 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4">
                    <div class="bg-usu-green h-2 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-500">Sirkulasi otomatis, kemudahan literasi informasi, dan jam buka perpustakaan maksimal.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700">Tenaga Perpustakaan</h4>
                    <span class="bg-slate-100 text-slate-600 font-bold px-2 py-1 rounded text-sm">3 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4">
                    <div class="bg-usu-light h-2 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-xs text-slate-500">Pustakawan tersertifikasi profesional dan pengurus inti di Ikatan Pustakawan Indonesia.</p>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-usu-dark text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-white/60 text-sm">© 2026 Universitas Sumatera Utara - Bukti Instrumen Akreditasi. Simulasi Desain.</p>
        </div>
    </footer>

</body>
</html>
