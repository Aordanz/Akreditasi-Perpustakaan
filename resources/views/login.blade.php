<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Perpustakaan USU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="bg-[#0a7a3b] p-8 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <img src="{{ asset('logousu.jpeg') }}" alt="Logo USU" class="w-20 h-20 mx-auto relative z-10 bg-white rounded-full p-1 shadow-lg mb-4">
            <h1 class="text-2xl font-bold text-white relative z-10">Admin Login</h1>
            <p class="text-white/80 text-sm relative z-10 mt-1">Sistem Akreditasi Perpustakaan USU</p>
        </div>
        
        <div class="p-8 pt-10">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 rounded-xl p-4 text-sm font-semibold flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#0a7a3b] focus:ring-2 focus:ring-[#0a7a3b]/20 transition-all outline-none" placeholder="admin@admin.com">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#0a7a3b] focus:ring-2 focus:ring-[#0a7a3b]/20 transition-all outline-none" placeholder="••••••••">
                </div>
                
                <button type="submit" class="w-full bg-[#0a7a3b] hover:bg-[#044b25] text-white font-bold py-3.5 rounded-xl transition-colors shadow-lg shadow-[#0a7a3b]/30">
                    Masuk ke Sistem
                </button>
            </form>
            
            <div class="mt-8 text-center">
                <a href="/akreditasi" class="text-sm font-semibold text-slate-500 hover:text-[#0a7a3b] transition-colors">
                    &larr; Kembali ke Halaman Publik
                </a>
            </div>
        </div>
    </div>

</body>
</html>
