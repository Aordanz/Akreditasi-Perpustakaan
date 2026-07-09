@extends('layouts.app')
@section('title', 'Profil - Perpustakaan USU')

@push('styles')
<style>
    .hero-gradient {
        background: radial-gradient(circle at 10% 20%, rgb(4, 75, 37) 0%, rgb(10, 122, 59) 90%);
        position: relative;
        overflow: hidden;
    }
    
    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, #0a7a3b 10%, #0a7a3b 90%, transparent);
        z-index: 0;
    }
    @media (max-width: 768px) {
        .timeline-line { left: 1.5rem; transform: none; }
    }
    
    .timeline-dot-wrapper {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }
    @media (max-width: 768px) {
        .timeline-dot-wrapper { left: 1.5rem; }
    }
    
    .timeline-dot {
        box-shadow: 0 0 0 8px rgba(254, 203, 0, 0.2);
    }

    .bento-glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .bento-hover {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .bento-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(10, 122, 59, 0.1);
    }
    
    /* Decorative SVG Patterns */
    .pattern-dots {
        background-image: radial-gradient(#0a7a3b 2px, transparent 2px);
        background-size: 20px 20px;
    }
</style>
@endpush

@section('content')

    <!-- Hero Section (Visi & Misi) -->
    <section class="hero-gradient text-white pt-24 pb-32 relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/black-linen-2.png')] opacity-20 mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#fecb00] rounded-full mix-blend-screen filter blur-[120px] opacity-20 -mr-40 -mt-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto mb-20">
                <span data-aos="fade-up" class="inline-block py-1.5 px-4 rounded-full bg-white/10 border border-white/20 text-[#fecb00] text-sm font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                    Profil Institusi
                </span>
                
                <h1 data-aos="zoom-in" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-tight mb-8">
                    "Menjadi Perpustakaan Perguruan Tinggi Terkemuka dalam Tataran Global"
                </h1>
                
                <p data-aos="fade-up" data-aos-delay="200" class="text-lg md:text-xl text-white/80 font-medium">
                    Visi Utama Perpustakaan Universitas Sumatera Utara
                </p>
            </div>

            <!-- Misi Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Misi 1 -->
                <div data-aos="fade-up" data-aos-delay="300" class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-[#fecb00] text-[#044b25] rounded-2xl flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Akses Global</h3>
                    <p class="text-white/70 leading-relaxed text-sm">Menyediakan akses terhadap berbagai sumber informasi global dan layanan secara tepat waktu, tepat guna, dan efektif untuk mendukung fungsi Tridharma USU.</p>
                </div>

                <!-- Misi 2 -->
                <div data-aos="fade-up" data-aos-delay="400" class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-[#fecb00] text-[#044b25] rounded-2xl flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pengadaan Koleksi</h3>
                    <p class="text-white/70 leading-relaxed text-sm">Melakukan pengadaan dan penyediaan bahan perpustakaan cetak maupun elektronik secara berkesinambungan dan relevan dengan program studi.</p>
                </div>

                <!-- Misi 3 -->
                <div data-aos="fade-up" data-aos-delay="500" class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 hover:bg-white/15 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-[#fecb00] text-[#044b25] rounded-2xl flex items-center justify-center mb-6 shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Literasi Informasi</h3>
                    <p class="text-white/70 leading-relaxed text-sm">Membantu mahasiswa dan dosen agar terampil dalam menemukan, mengevaluasi, dan menggunakan informasi yang relevan dengan kebutuhan mereka.</p>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.98,131,201.2,122.9,243.6,118,283.4,103.5,321.39,56.44Z" class="fill-[#f8fafc]"></path>
            </svg>
        </div>
    </section>

    <!-- Interactive History Timeline -->
    <section class="py-24 bg-[#f8fafc] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4">Jejak Sejarah</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Perjalanan panjang Perpustakaan Universitas Sumatera Utara dari masa ke masa.</p>
            </div>

            <div class="relative max-w-4xl mx-auto py-10">
                <!-- Vertical Line -->
                <div class="timeline-line hidden md:block"></div>
                <div class="md:hidden absolute left-6 top-0 bottom-0 w-1 bg-[#0a7a3b]/20"></div>

                <!-- Event 1952 -->
                <div class="relative flex md:justify-between items-center w-full mb-16 group">
                    <div class="hidden md:block w-5/12 text-right pr-12" data-aos="fade-right" data-aos-offset="100">
                        <div class="bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] group-hover:shadow-[0_20px_40px_rgba(4,75,37,0.3)] transition-all duration-500 group-hover:-translate-y-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-10 -mt-10 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Awal Mula</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Berdirinya USU pada 20 Agustus 1952 turut menandai dimulainya layanan perpustakaan secara parsial. Dimulai dari Perpustakaan Fakultas Kedokteran (1952) dan disusul Fakultas Hukum (1954).</p>
                                
                                <!-- Extra Info on Hover -->
                                <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-white/20">
                                    <p class="text-green-100/70 text-xs leading-relaxed italic">Gagasan awal ini dipelopori oleh para pendiri universitas yang menyadari bahwa literatur medis dan hukum sangat krusial untuk membangun fondasi pendidikan tinggi pertama di Sumatera Utara.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-dot-wrapper">
                        <div class="timeline-dot md:bg-[#0a7a3b] bg-[#fecb00] w-6 h-6 rounded-full border-4 border-white transition-transform duration-500 group-hover:scale-150" data-aos="zoom-in" data-aos-offset="100"></div>
                    </div>
                    
                    <div class="w-full md:w-5/12 pl-16 md:pl-12" data-aos="fade-left" data-aos-offset="100">
                        <div class="text-[#0a7a3b] font-black text-4xl md:text-5xl opacity-30 absolute -top-4 md:static whitespace-nowrap">1952 - 1970</div>
                        <div class="md:hidden bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] mt-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-8 -mt-8 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Awal Mula</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Berdirinya USU menandai dimulainya layanan perpustakaan. Dimulai dari Perpustakaan Fakultas Kedokteran (1952) dan Fakultas Hukum (1954).</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event 1970 -->
                <div class="relative flex md:justify-between items-center w-full mb-16 flex-row-reverse group">
                    <div class="hidden md:block w-5/12 text-left pl-12" data-aos="fade-left" data-aos-offset="150">
                        <div class="bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] group-hover:shadow-[0_20px_40px_rgba(4,75,37,0.3)] transition-all duration-500 group-hover:-translate-y-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-10 -mt-10 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Sentralisasi Pertama</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Perpustakaan Pusat resmi didirikan untuk mengoordinasi perpustakaan fakultas yang sudah ada sebelumnya agar lebih terpadu.</p>
                                
                                <!-- Extra Info on Hover -->
                                <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-white/20">
                                    <p class="text-green-100/70 text-xs leading-relaxed italic">Langkah sentralisasi ini bertujuan menghemat anggaran operasional, menyamakan standar katalogisasi buku, serta memudahkan mahasiswa mengakses referensi lintas disiplin ilmu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-dot-wrapper">
                        <div class="timeline-dot md:bg-[#0a7a3b] bg-[#fecb00] w-6 h-6 rounded-full border-4 border-white transition-transform duration-500 group-hover:scale-150" data-aos="zoom-in" data-aos-offset="150"></div>
                    </div>
                    
                    <div class="w-full md:w-5/12 pl-16 md:pr-12 md:pl-0 md:text-right" data-aos="fade-right" data-aos-offset="150">
                        <div class="text-[#0a7a3b] font-black text-4xl md:text-5xl opacity-30 absolute -top-4 md:static md:block hidden whitespace-nowrap">1970 - 1987</div>
                        <div class="md:hidden text-[#0a7a3b] font-black text-4xl opacity-30 absolute -top-4 whitespace-nowrap">1970 - 1987</div>
                        <div class="md:hidden bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] mt-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-8 -mt-8 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Sentralisasi Pertama</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Perpustakaan Pusat resmi didirikan untuk mengoordinasi perpustakaan fakultas.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event 1987 -->
                <div class="relative flex md:justify-between items-center w-full mb-16 group">
                    <div class="hidden md:block w-5/12 text-right pr-12" data-aos="fade-right" data-aos-offset="150">
                        <div class="bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] group-hover:shadow-[0_20px_40px_rgba(4,75,37,0.3)] transition-all duration-500 group-hover:-translate-y-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-10 -mt-10 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Gedung Baru</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Seluruh perpustakaan di lingkungan USU digabungkan dan dipusatkan secara fisik ke dalam satu gedung baru seluas 6.090 m² di kampus Padang Bulan.</p>
                                
                                <!-- Extra Info on Hover -->
                                <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-white/20">
                                    <p class="text-green-100/70 text-xs leading-relaxed italic">Peresmian gedung ini menjadi tonggak sejarah, menjadikannya salah satu perpustakaan perguruan tinggi terbesar di Indonesia pada masanya dengan arsitektur yang ikonik.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-dot-wrapper">
                        <div class="timeline-dot md:bg-[#0a7a3b] bg-[#fecb00] w-6 h-6 rounded-full border-4 border-white transition-transform duration-500 group-hover:scale-150" data-aos="zoom-in" data-aos-offset="150"></div>
                    </div>
                    
                    <div class="w-full md:w-5/12 pl-16 md:pl-12" data-aos="fade-left" data-aos-offset="150">
                        <div class="text-[#0a7a3b] font-black text-4xl md:text-5xl opacity-30 absolute -top-4 md:static whitespace-nowrap">1987 - 2006</div>
                        <div class="md:hidden bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] mt-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-8 -mt-8 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Gedung Baru</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Seluruh perpustakaan digabungkan ke dalam satu gedung baru seluas 6.090 m² di kampus Padang Bulan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event 2006+ -->
                <div class="relative flex md:justify-between items-center w-full flex-row-reverse group">
                    <div class="hidden md:block w-5/12 text-left pl-12" data-aos="fade-left" data-aos-offset="150">
                        <div class="bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] group-hover:shadow-[0_20px_40px_rgba(4,75,37,0.3)] transition-all duration-500 group-hover:-translate-y-2 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-10 -mt-10 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Era PTN-BH & Digitalisasi</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Sistem perpustakaan cabang mulai dikembangkan untuk mendekatkan layanan ke berbagai fakultas. Kini beroperasi sebagai entitas mandiri yang modern di bawah status USU sebagai PTN-BH dengan layanan digital mutakhir.</p>
                                
                                <!-- Extra Info on Hover -->
                                <div class="max-h-0 opacity-0 group-hover:max-h-32 group-hover:opacity-100 transition-all duration-500 overflow-hidden group-hover:mt-3 group-hover:pt-3 border-t border-transparent group-hover:border-white/20">
                                    <p class="text-green-100/70 text-xs leading-relaxed italic">Inovasi mencakup integrasi E-Journal, otomatisasi sirkulasi mandiri, serta ruang baca interaktif bergaya co-working space demi memenuhi kebutuhan mahasiswa generasi digital.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-dot-wrapper">
                        <div class="timeline-dot bg-[#fecb00] w-8 h-8 rounded-full border-4 border-white flex items-center justify-center shadow-[0_0_15px_rgba(254,203,0,0.6)] z-20 group-hover:scale-125 transition-transform" data-aos="zoom-in" data-aos-offset="150">
                            <div class="w-2 h-2 bg-[#044b25] rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="w-full md:w-5/12 pl-16 md:pr-12 md:pl-0 md:text-right" data-aos="fade-right" data-aos-offset="150">
                        <div class="text-[#fecb00] font-black text-4xl md:text-5xl opacity-70 absolute -top-4 md:static md:block hidden drop-shadow-sm whitespace-nowrap">2006 - Sekarang</div>
                        <div class="md:hidden text-[#fecb00] font-black text-3xl opacity-90 absolute -top-3 whitespace-nowrap">2006 - Sekarang</div>
                        <div class="md:hidden bg-[#044b25] p-6 rounded-2xl shadow-lg border-l-[6px] border-l-[#fecb00] mt-3 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-[#0a7a3b] rounded-full blur-2xl opacity-60 -mr-8 -mt-8 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-[#fecb00] mb-2">Era Modern & Cabang</h3>
                                <p class="text-white/90 text-sm leading-relaxed">Sistem perpustakaan cabang dikembangkan, beroperasi mandiri mendukung USU sebagai PTN-BH dengan layanan digital terintegrasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Fasilitas Bento Grid -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 pattern-dots w-64 h-64 opacity-20 transform rotate-45 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 pattern-dots w-64 h-64 opacity-20 -ml-20 -mb-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4">Fasilitas Unggulan</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Mendukung ekosistem belajar yang nyaman baik di dalam ruangan (Indoor) maupun ruang terbuka (Outdoor).</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-3 gap-4 md:h-[600px]">
                
                <!-- Large Highlight Card -->
                <div class="md:col-span-2 md:row-span-2 rounded-3xl overflow-hidden relative group" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('kolam_perpustakaan.jpg') }}" alt="Ruang Literasi" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 w-full p-8 transition-transform duration-500 group-hover:-translate-y-3">
                        <span class="bg-[#0a7a3b] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block">Indoor</span>
                        <h3 class="text-3xl font-bold text-white mb-2">Ruang Literasi Informasi</h3>
                        <p class="text-white/80 text-sm">Fasilitas komputer lengkap untuk pelatihan literasi, penelusuran jurnal, dan bimbingan OPAC bagi mahasiswa.</p>
                    </div>
                </div>

                <!-- OPAC -->
                <div class="md:col-span-1 md:row-span-1 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-3xl p-6 bento-hover group flex flex-col justify-between shadow-lg shadow-blue-500/20" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-white/20 text-white rounded-full flex items-center justify-center mb-4 transition-transform duration-500 group-hover:scale-125 group-hover:rotate-12">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-lg">Katalog OPAC</h3>
                        <p class="text-white/80 text-xs mt-1">Terminal pencarian buku digital terpusat.</p>
                    </div>
                </div>

                <!-- Ruang Rapat -->
                <div class="md:col-span-1 md:row-span-1 bg-[#0a7a3b] text-white rounded-3xl p-6 bento-hover group shadow-lg shadow-[#0a7a3b]/20 flex flex-col justify-between relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white/10 transition-transform duration-700 group-hover:scale-150 group-hover:-rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m24 0v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75M16 3.13a4 4 0 010 7.75M9 13a4 4 0 100-8 4 4 0 000 8z"></path></svg>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 group-hover:scale-125 group-hover:rotate-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-lg">Ruang Rapat & TGCL</h3>
                        <p class="text-white/80 text-xs mt-1">Fasilitas konferensi dan diskusi akademis.</p>
                    </div>
                </div>

                <!-- Outdoor Area -->
                <div class="md:col-span-2 md:row-span-1 bg-slate-900 hover:bg-slate-800 transition-colors duration-500 rounded-3xl overflow-hidden relative group bento-hover" data-aos="fade-up" data-aos-delay="400">

                    <div class="absolute inset-0 p-6 flex flex-col justify-end transition-transform duration-500 group-hover:-translate-y-2">
                        <span class="bg-[#fecb00] text-[#044b25] text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider mb-2 self-start">Outdoor</span>
                        <h3 class="font-bold text-white text-xl">Taman Baca & Jogging Track</h3>
                        <p class="text-slate-300 text-sm mt-1">Ruang terbuka hijau, kolam, dan area santai.</p>
                    </div>
                </div>

                <!-- Loker & Musholla -->
                <div class="md:col-span-1 md:row-span-1 bg-gradient-to-br from-violet-500 to-fuchsia-500 text-white rounded-3xl p-6 bento-hover group flex flex-col justify-center items-center text-center shadow-lg shadow-fuchsia-500/20" data-aos="fade-up" data-aos-delay="500">
                    <div class="flex gap-2 mb-3 transition-transform duration-500 group-hover:scale-125 group-hover:-translate-y-2">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg></div>
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    </div>
                    <h3 class="font-bold text-white">Fasilitas Umum</h3>
                    <p class="text-white/80 text-xs mt-1">Loker penitipan, Free Charging & Musholla Iqra.</p>
                </div>

                <!-- Digital -->
                <div class="md:col-span-1 md:row-span-1 bg-gradient-to-br from-[#fecb00] to-yellow-500 rounded-3xl p-6 bento-hover group shadow-lg shadow-yellow-500/20 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-12 h-12 bg-white/30 rounded-full flex items-center justify-center mb-4 text-[#044b25] transition-transform duration-500 group-hover:scale-125 group-hover:-rotate-12">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#044b25] text-lg">Layanan Digital</h3>
                        <p class="text-[#044b25]/80 text-xs mt-1">E-journal, E-book & Repositori terintegrasi.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Koleksi Section -->
    <section class="py-24 bg-[#0a7a3b] text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-12 items-center">
                
                <div class="flex-1 space-y-6" data-aos="fade-right">
                    <span class="text-[#fecb00] font-bold tracking-widest uppercase text-sm border-b border-[#fecb00] pb-1">Koleksi Kami</span>
                    <h2 class="text-3xl md:text-5xl font-black leading-tight">Gudang Ilmu Pengetahuan Modern</h2>
                    <p class="text-white/80 text-lg leading-relaxed">
                        Kami menyediakan ribuan literatur dari berbagai disiplin ilmu yang relevan dengan seluruh program studi di Universitas Sumatera Utara.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div data-aos="fade-up" data-aos-delay="200">
                            <div class="text-3xl font-black text-[#8dc63f] mb-1">Cetak</div>
                            <ul class="text-white/70 space-y-2 text-sm">
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Buku Teks Berkualitas</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Jurnal Akademik</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Skripsi, Tesis, Disertasi</li>
                            </ul>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="400">
                            <div class="text-3xl font-black text-[#8dc63f] mb-1">Digital</div>
                            <ul class="text-white/70 space-y-2 text-sm">
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> E-Journals Internasional</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Ratusan Ribu E-Books</li>
                                <li class="flex items-center gap-2"><svg class="w-4 h-4 text-[#fecb00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Repositori USU Institusi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Interactive Card Info -->
                <div data-aos="zoom-in-left" data-aos-delay="300" class="w-full md:w-[400px] bg-gradient-to-b from-[#0a7a3b] to-[#044b25] p-8 rounded-3xl shadow-2xl border border-white/10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#fecb00] opacity-10 rounded-full -ml-10 -mb-10"></div>
                    
                    <div class="relative z-10">
                        <svg class="w-12 h-12 text-[#fecb00] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        
                        <h3 class="text-2xl font-bold mb-2 text-white">Butuh Referensi?</h3>
                        <p class="text-[#8dc63f] mb-8 font-medium">Buka setiap Senin - Jumat</p>
                        
                        <a href="#" class="block text-center w-full bg-white text-[#044b25] font-bold py-4 rounded-xl hover:bg-[#fecb00] transition-colors shadow-lg hover:shadow-xl hover:-translate-y-1 transform duration-300">
                            Kunjungi Repositori USU
                        </a>
                        
                        <div class="mt-6 flex items-start gap-3 text-white/60 text-xs">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p>Jl. Perpustakaan No. 1, Kampus USU, Padang Bulan, Medan 20155</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
