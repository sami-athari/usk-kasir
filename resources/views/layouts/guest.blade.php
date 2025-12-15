<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Family Cafe') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group">
                <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-shadow">
                    <span class="text-2xl">☕</span>
                </div>
                <span class="text-2xl font-bold text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-slate-400 mt-8">© {{ date('Y') }} FamilyCafe. All rights reserved.</p>
    </div>
</body>
</html>
