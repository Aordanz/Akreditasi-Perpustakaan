<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akreditasi Perpustakaan USU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            animation: pulse-bg 10s infinite alternate;
        }
        @keyframes pulse-bg {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.1); opacity: 1; }
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        /* Modal Animation */
        .modal-enter { opacity: 0; transform: scale(0.9); }
        .modal-enter-active { opacity: 1; transform: scale(1); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .modal-leave { opacity: 1; transform: scale(1); }
        .modal-leave-active { opacity: 0; transform: scale(0.9); transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="text-slate-800 antialiased bg-pattern" x-data="{ 
    showModal: false, 
    modalContent: { title: '', score: '', desc: '', detail: '' },
    openModal(title, score, desc, detail) {
        this.modalContent = { title, score, desc, detail };
        this.showModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeModal() {
        this.showModal = false;
        setTimeout(() => document.body.style.overflow = 'auto', 300);
    }
}">

    <!-- Topbar -->
    <div class="bg-usu-dark text-white py-1 px-4 text-xs flex justify-end gap-4 font-semibold">
        <a href="#" class="hover:text-usu-light hover:underline transition">USU Official</a>
        <a href="#" class="hover:text-usu-light hover:underline transition">MBKM</a>
        <a href="#" class="hover:text-usu-light hover:underline transition">DIGILIB</a>
        <a href="#" class="hover:text-usu-light hover:underline transition">Repositori USU</a>
        <a href="#" class="hover:text-usu-light hover:underline transition">Resource Guide</a>
        <span class="border-l border-white/30 pl-4 flex items-center gap-1 cursor-pointer hover:text-usu-yellow transition">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
            IN ENGLISH
        </span>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300 border-b-[6px] border-[#0a7a3b]" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'py-2 shadow-md': scrolled, 'py-4': !scrolled }">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center transition-all duration-300">
            <div class="flex items-center gap-4 cursor-pointer group">
                <!-- Logo USU -->
                <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-16 h-16 object-contain group-hover:scale-105 transition duration-300">
                <span class="font-bold text-xl md:text-2xl text-black tracking-tight">Perpustakaan Universitas Sumatera Utara</span>
            </div>
            <nav class="hidden md:flex gap-6 font-semibold text-sm text-usu-green">
                <a href="#" class="relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-usu-light hover:after:origin-bottom-left hover:after:scale-x-100 after:transition-transform after:duration-300 after:ease-in-out py-1">Beranda</a>
                <a href="#" class="relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-usu-light hover:after:origin-bottom-left hover:after:scale-x-100 after:transition-transform after:duration-300 after:ease-in-out py-1">Profil</a>
                <a href="#" class="relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-usu-light hover:after:origin-bottom-left hover:after:scale-x-100 after:transition-transform after:duration-300 after:ease-in-out py-1">Layanan</a>
                <a href="#" class="relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-usu-light hover:after:origin-bottom-left hover:after:scale-x-100 after:transition-transform after:duration-300 after:ease-in-out py-1 text-usu-dark font-bold">Akreditasi</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern text-white py-20 px-4" x-data="{ load: false }" x-init="setTimeout(() => load = true, 100)">
        <div class="max-w-7xl mx-auto hero-content">
            <div x-show="load" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <h2 class="text-3xl md:text-5xl font-extrabold italic mb-2 font-serif text-usu-light">Bukti Akreditasi</h2>
                <h1 class="text-5xl md:text-7xl font-black tracking-tight mb-6 drop-shadow-lg uppercase">Perpustakaan USU</h1>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 mt-8" x-show="load" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex-1 space-y-4">
                    <div class="flex items-start gap-3 group cursor-pointer hover:bg-white/10 p-2 rounded-xl transition duration-300">
                        <div class="w-8 h-8 rounded-full bg-usu-yellow flex items-center justify-center text-usu-dark shrink-0 mt-1 group-hover:scale-110 transition duration-300 group-hover:rotate-12">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg group-hover:text-usu-yellow transition duration-300">Akreditasi Kategori "A"</p>
                            <p class="text-white/80 text-sm">Diraih pada tahun 2021 dari Perpustakaan Nasional RI</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 group cursor-pointer hover:bg-white/10 p-2 rounded-xl transition duration-300">
                        <div class="w-8 h-8 rounded-full bg-usu-yellow flex items-center justify-center text-usu-dark shrink-0 mt-1 group-hover:scale-110 transition duration-300 group-hover:-rotate-12">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg group-hover:text-usu-yellow transition duration-300">PTN-BH & ISO 9001:2015</p>
                            <p class="text-white/80 text-sm">Berstandar mutu internasional & pengelolaan mandiri</p>
                        </div>
                    </div>
                </div>
                
                <!-- Interactive QR Code -->
                <div class="bg-white p-2 rounded-xl shrink-0 self-start border-4 border-usu-yellow/50 shadow-2xl transform rotate-3 hover:rotate-0 hover:scale-110 cursor-pointer transition-all duration-300" @click="alert('Scan QR untuk masuk ke repositori USU!')">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=Akreditasi+Perpustakaan+USU" alt="QR Code" class="w-28 h-28 opacity-90 mix-blend-multiply">
                    <div class="text-center text-[0.6rem] text-usu-dark font-bold mt-1">TAP TO SCAN</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-16" x-data="{ activeAccordion: null }">
        
        <!-- Highlighted Administrasi Component -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 mb-16 transform transition hover:shadow-2xl hover:-translate-y-2 duration-300">
            <div class="bg-usu-green px-8 py-6 flex justify-between items-center border-b-4 border-usu-light">
                <div>
                    <span class="bg-usu-yellow text-usu-dark text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block animate-pulse">Sorotan Utama</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
                        Komponen 5: Administrasi
                    </h2>
                    <p class="text-white/80 mt-1">Penyelenggaraan dan Pengelolaan Perpustakaan</p>
                </div>
                <div class="w-20 h-20 bg-white rounded-full flex flex-col items-center justify-center shadow-[0_0_20px_rgba(254,203,0,0.5)] border-4 border-usu-yellow shrink-0 transform hover:scale-110 transition duration-300">
                    <span class="text-3xl font-black text-usu-green leading-none">4</span>
                    <span class="text-[0.65rem] text-slate-500 uppercase font-bold mt-1">Skor Maks</span>
                </div>
            </div>
            
            <div class="p-8">
                <p class="text-slate-600 mb-8 max-w-3xl text-lg">Berdasarkan instrumen Perka PNRI No. 10/2018, komponen ini meraih skor maksimal (4). Klik pada tiap kartu di bawah untuk melihat detail buktinya secara spesifik:</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Evidence 1 -->
                    <div class="group cursor-pointer bg-slate-50 rounded-2xl p-6 border border-slate-200 hover:border-usu-green hover:bg-green-50 transition-all duration-300 hover:shadow-lg" @click="activeAccordion = activeAccordion === 1 ? null : 1">
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100 group-hover:scale-110 transition duration-300 group-hover:bg-usu-green group-hover:text-white">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-slate-800 group-hover:text-usu-dark transition duration-300">Kebijakan & Manajemen Mutu</h3>
                            </div>
                            <div class="text-usu-green transform transition duration-300" :class="activeAccordion === 1 ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <div x-show="activeAccordion === 1" x-collapse x-transition.duration.300ms class="mt-4 pt-4 border-t border-slate-200">
                            <p class="text-slate-600 text-sm leading-relaxed">Sertifikasi <strong>ISO 9001:2015</strong> yang diraih pada 2020 membuktikan adanya implementasi Sistem Manajemen Mutu secara tertulis, terstruktur, dan dievaluasi rutin sesuai kriteria (skor 4 mensyaratkan kelengkapan kebijakan tertulis untuk perpustakaan).</p>
                        </div>
                    </div>
                    
                    <!-- Evidence 2 -->
                    <div class="group cursor-pointer bg-slate-50 rounded-2xl p-6 border border-slate-200 hover:border-usu-green hover:bg-green-50 transition-all duration-300 hover:shadow-lg" @click="activeAccordion = activeAccordion === 2 ? null : 2">
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100 group-hover:scale-110 transition duration-300 group-hover:bg-usu-green group-hover:text-white">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-slate-800 group-hover:text-usu-dark transition duration-300">Struktur PTN-BH yang Kuat</h3>
                            </div>
                            <div class="text-usu-green transform transition duration-300" :class="activeAccordion === 2 ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <div x-show="activeAccordion === 2" x-collapse x-transition.duration.300ms class="mt-4 pt-4 border-t border-slate-200">
                            <p class="text-slate-600 text-sm leading-relaxed">Diperkuat dengan SK Rektor, struktur kelembagaan mengakomodasi transisi USU sebagai Perguruan Tinggi Negeri Berbadan Hukum (PTN-BH) dengan membagi tugas jelas ke Bidang Layanan Teknis, TI, hingga Tata Usaha.</p>
                        </div>
                    </div>

                    <!-- Evidence 3 -->
                    <div class="group cursor-pointer bg-slate-50 rounded-2xl p-6 border border-slate-200 hover:border-usu-green hover:bg-green-50 transition-all duration-300 hover:shadow-lg" @click="activeAccordion = activeAccordion === 3 ? null : 3">
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100 group-hover:scale-110 transition duration-300 group-hover:bg-usu-green group-hover:text-white">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-slate-800 group-hover:text-usu-dark transition duration-300">Evaluasi Rutin (Monev)</h3>
                            </div>
                            <div class="text-usu-green transform transition duration-300" :class="activeAccordion === 3 ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <div x-show="activeAccordion === 3" x-collapse x-transition.duration.300ms class="mt-4 pt-4 border-t border-slate-200">
                            <p class="text-slate-600 text-sm leading-relaxed">Laporan pelaksanaan kegiatan terstruktur (tahunan, triwulan, bulanan). Adanya monitoring dan evaluasi ketat terhadap fasilitas elektronik, langganan <em>database</em>, dan integrasi dengan fakultas.</p>
                        </div>
                    </div>

                    <!-- Evidence 4 -->
                    <div class="group cursor-pointer bg-slate-50 rounded-2xl p-6 border border-slate-200 hover:border-usu-green hover:bg-green-50 transition-all duration-300 hover:shadow-lg" @click="activeAccordion = activeAccordion === 4 ? null : 4">
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center text-usu-green shrink-0 shadow-sm border border-green-100 group-hover:scale-110 transition duration-300 group-hover:bg-usu-green group-hover:text-white">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-slate-800 group-hover:text-usu-dark transition duration-300">Dukungan Anggaran</h3>
                            </div>
                            <div class="text-usu-green transform transition duration-300" :class="activeAccordion === 4 ? 'rotate-180' : ''">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        <div x-show="activeAccordion === 4" x-collapse x-transition.duration.300ms class="mt-4 pt-4 border-t border-slate-200">
                            <p class="text-slate-600 text-sm leading-relaxed">Pengelolaan alokasi dana mandiri memastikan operasional 42 jam/minggu berjalan lancar. Peningkatan infrastruktur perpustakaan cabang turut membuktikan persentase anggaran yang sangat memadai (lebih dari standar 5%).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Components Overview -->
        <h3 class="text-2xl font-bold text-slate-800 mb-8 border-l-4 border-usu-light pl-4 flex items-center gap-3">
            Ringkasan Komponen Lainnya
            <span class="text-sm font-normal text-slate-500">(Klik kartu untuk detail)</span>
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 cursor-pointer transition-all duration-300" 
                 @click="openModal('Koleksi Perpustakaan', '3 / 4', 'Koleksi lengkap dan relevan', 'Skor 3 diraih karena ketersediaan judul buku referensi dan langganan jurnal elektronik (e-journal) yang memadai dan terus bertambah setiap tahunnya, mendukung langsung penelitian mahasiswa dan dosen.')">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700 group-hover:text-usu-green transition duration-300">Koleksi</h4>
                    <span class="bg-slate-100 text-slate-600 font-bold px-2 py-1 rounded text-sm group-hover:bg-usu-green group-hover:text-white transition duration-300">3 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4 overflow-hidden relative">
                    <div class="bg-usu-light h-2 rounded-full absolute top-0 left-0" style="width: 75%"></div>
                </div>
                <p class="text-xs text-slate-500 group-hover:text-slate-700 transition duration-300">Mencakup kelengkapan judul buku, jurnal elektronik, dan <em>database</em> terlanggan.</p>
            </div>

            <div class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 cursor-pointer transition-all duration-300"
                 @click="openModal('Sarana & Prasarana', '4 / 4', 'Infrastruktur dan fasilitas unggul', 'Skor maksimal diraih karena perpustakaan USU berlokasi strategis di pusat kampus dengan gedung yang megah. Fasilitas dilengkapi area baca luas, ruang diskusi, TIK modern (internet berkecepatan tinggi), dan sistem keamanan CCTV.')">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700 group-hover:text-usu-green transition duration-300">Sarana & Prasarana</h4>
                    <span class="bg-usu-green/10 text-usu-green font-bold px-2 py-1 rounded text-sm group-hover:bg-usu-green group-hover:text-white transition duration-300">4 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4 overflow-hidden relative">
                    <div class="bg-usu-green h-2 rounded-full absolute top-0 left-0" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-500 group-hover:text-slate-700 transition duration-300">Gedung megah di pusat kampus, area baca nyaman, dan fasilitas TIK canggih.</p>
            </div>

            <div class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 cursor-pointer transition-all duration-300"
                 @click="openModal('Pelayanan Perpustakaan', '4 / 4', 'Layanan maksimal dan efisien', 'Perpustakaan USU memberikan pelayanan terbaik dengan jam operasional yang melampaui standar (lebih dari 40 jam seminggu). Sistem sirkulasi telah otomatisasi sepenuhnya berbasis barcode/RFID, memudahkan literasi informasi.')">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700 group-hover:text-usu-green transition duration-300">Pelayanan</h4>
                    <span class="bg-usu-green/10 text-usu-green font-bold px-2 py-1 rounded text-sm group-hover:bg-usu-green group-hover:text-white transition duration-300">4 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4 overflow-hidden relative">
                    <div class="bg-usu-green h-2 rounded-full absolute top-0 left-0 transform origin-left transition-transform duration-1000" style="width: 100%"></div>
                </div>
                <p class="text-xs text-slate-500 group-hover:text-slate-700 transition duration-300">Sirkulasi otomatis, kemudahan literasi informasi, dan jam buka perpustakaan maksimal.</p>
            </div>

            <div class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 cursor-pointer transition-all duration-300"
                 @click="openModal('Tenaga Perpustakaan', '3 / 4', 'SDM profesional dan tersertifikasi', 'Tenaga pustakawan USU didukung oleh latar belakang pendidikan yang sesuai (ilmu perpustakaan) dan secara aktif mengikuti diklat kompetensi. Banyak dari mereka tersertifikasi dan berpartisipasi aktif dalam organisasi seperti Ikatan Pustakawan Indonesia.')">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-700 group-hover:text-usu-green transition duration-300">Tenaga Perpustakaan</h4>
                    <span class="bg-slate-100 text-slate-600 font-bold px-2 py-1 rounded text-sm group-hover:bg-usu-green group-hover:text-white transition duration-300">3 / 4</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 mb-4 overflow-hidden relative">
                    <div class="bg-usu-light h-2 rounded-full absolute top-0 left-0" style="width: 75%"></div>
                </div>
                <p class="text-xs text-slate-500 group-hover:text-slate-700 transition duration-300">Pustakawan tersertifikasi profesional dan pengurus inti di Ikatan Pustakawan Indonesia.</p>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-usu-dark text-white py-12 mt-12 border-t-4 border-usu-yellow">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 p-2 shadow-lg">
                <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU Footer" class="w-full h-full object-contain">
            </div>
            <p class="text-white/80 font-semibold text-lg mb-2">Universitas Sumatera Utara</p>
            <p class="text-white/60 text-sm">© 2026 Bukti Instrumen Akreditasi. Penugasan Simulasi Desain Interaktif.</p>
        </div>
    </footer>

    <!-- Alpine JS Modal Overlay -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/70 backdrop-blur-sm p-4" x-transition.opacity.duration.300ms>
        
        <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-200 transform overflow-hidden"
             @click.away="closeModal()" 
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95">
            
            <!-- Modal Header -->
            <div class="bg-usu-green px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-xl" x-text="modalContent.title"></h3>
                <button @click="closeModal()" class="text-white/70 hover:text-white hover:rotate-90 transition-all duration-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-usu-yellow/20 text-usu-dark rounded-2xl flex items-center justify-center font-black text-2xl border-2 border-usu-yellow">
                        <span x-text="modalContent.score.split('/')[0].trim()"></span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Pencapaian Skor</p>
                        <p class="text-lg font-bold text-slate-800" x-text="modalContent.desc"></p>
                    </div>
                </div>
                
                <div class="bg-slate-50 border border-slate-100 p-5 rounded-2xl">
                    <h4 class="font-bold text-usu-green mb-2 text-sm uppercase">Detail Bukti Penilaian</h4>
                    <p class="text-slate-600 leading-relaxed" x-text="modalContent.detail"></p>
                </div>
                
                <div class="mt-8 text-right">
                    <button @click="closeModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-6 rounded-full transition-colors duration-300">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
