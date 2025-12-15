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
<body class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('order.index') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-md shadow-emerald-500/20">
                        <span class="text-lg">☕</span>
                    </div>
                    <span class="text-lg font-bold text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
                </a>
                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ route('profile.edit') }}" class="text-sm text-slate-500 hover:text-emerald-500 transition-colors">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-slate-500 hover:text-red-500 transition-colors">Logout</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @isset($header)
    <header class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>
</body>
</html>
