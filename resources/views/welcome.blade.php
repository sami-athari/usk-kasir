<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kopiku') }} - Cafe Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-emerald-50 via-white to-slate-50 min-h-screen">
    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Kopiku</span>
                </div>

                <!-- Nav Links -->
                @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-emerald-500 text-white text-sm font-medium rounded-xl hover:bg-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-600 hover:text-emerald-600 text-sm font-medium transition-colors duration-200">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-emerald-500 text-white text-sm font-medium rounded-xl hover:bg-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                Daftar
                            </a>
                        @endif
                    @endauth
                </nav>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="pt-24">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 rounded-full">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium text-emerald-700">Sistem Manajemen Kafe</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-slate-900 leading-tight">
                        Kelola <span class="bg-gradient-to-r from-emerald-600 to-emerald-400 bg-clip-text text-transparent">Kedai Kopi</span> Anda dengan Mudah
                    </h1>

                    <p class="text-lg text-slate-600 leading-relaxed max-w-lg">
                        Sederhanakan operasional kafe Anda dengan sistem POS kami yang intuitif. Lacak pesanan, kelola inventaris, dan kembangkan bisnis Anda.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ url('/order') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-500 text-white font-semibold rounded-2xl hover:bg-emerald-600 transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Mulai Pesan
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-emerald-500 text-white font-semibold rounded-2xl hover:bg-emerald-600 transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Mulai Sekarang
                            </a>
                        @endauth
                        <a href="#features" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-slate-700 font-semibold rounded-2xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Right Content - Illustration -->
                <div class="relative">
                    <div class="absolute -top-10 -right-10 w-72 h-72 bg-emerald-200 rounded-full opacity-30 blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-slate-200 rounded-full opacity-30 blur-3xl"></div>

                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">
                        <!-- Mock POS Interface -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <span class="font-semibold text-slate-900">Pesanan Hari Ini</span>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-medium rounded-full">Aktif</span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-4 p-3 bg-slate-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">☕</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-slate-900">Cappuccino</p>
                                        <p class="text-sm text-slate-500">x2</p>
                                    </div>
                                    <span class="font-semibold text-emerald-600">Rp 50K</span>
                                </div>

                                <div class="flex items-center gap-4 p-3 bg-slate-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">🍰</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-slate-900">Red Velvet Cake</p>
                                        <p class="text-sm text-slate-500">x1</p>
                                    </div>
                                    <span class="font-semibold text-emerald-600">Rp 35K</span>
                                </div>

                                <div class="flex items-center gap-4 p-3 bg-slate-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">🥐</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-slate-900">Croissant</p>
                                        <p class="text-sm text-slate-500">x3</p>
                                    </div>
                                    <span class="font-semibold text-emerald-600">Rp 45K</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600">Total</span>
                                    <span class="text-2xl font-bold text-slate-900">Rp 130K</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Semua yang Anda Butuhkan</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">Fitur lengkap untuk membantu Anda mengelola dan mengembangkan bisnis kafe</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group p-8 bg-gradient-to-br from-slate-50 to-white rounded-3xl border border-slate-100 hover:border-emerald-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Manajemen Pesanan</h3>
                        <p class="text-slate-600">Proses pesanan dengan efisien menggunakan antarmuka POS kami yang intuitif. Cepat, sederhana, dan andal.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group p-8 bg-gradient-to-br from-slate-50 to-white rounded-3xl border border-slate-100 hover:border-emerald-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Laporan Keuangan</h3>
                        <p class="text-slate-600">Dapatkan wawasan detail tentang penjualan, pengeluaran, dan margin keuntungan dengan laporan komprehensif.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group p-8 bg-gradient-to-br from-slate-50 to-white rounded-3xl border border-slate-100 hover:border-emerald-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Pelacakan Inventaris</h3>
                        <p class="text-slate-600">Pantau bahan dan produk Anda. Dapatkan peringatan saat stok hampir habis.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Kopiku</span>
                </div>
                <p class="text-slate-400 text-sm">© {{ date('Y') }} Kopiku. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
