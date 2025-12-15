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
        /* Custom Scrollbar agar tidak merusak pemandangan */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen">

    <nav class="bg-white border-b border-dashed border-slate-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <a href="{{ route('order.index') }}" class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xl font-bold tracking-tight text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
                </a>

                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-500 hover:text-emerald-600 transition-colors py-2 px-3 rounded-lg hover:bg-slate-50">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-500 hover:text-red-500 transition-colors py-2 px-3 rounded-lg hover:bg-slate-50">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 py-2 px-4 rounded-full transition-colors">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @isset($header)
    <header class="bg-white border-b border-dashed border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </main>
</body>
</html>
