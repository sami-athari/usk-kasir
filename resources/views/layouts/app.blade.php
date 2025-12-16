<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: $persist(false).as('dark_mode') }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Family Cafe') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="bg-[#F8FAFC] dark:bg-slate-900 text-slate-700 dark:text-slate-200 antialiased min-h-screen transition-colors duration-300">

    <nav class="bg-white dark:bg-slate-800 border-b border-dashed border-slate-200 dark:border-slate-700 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <a href="{{ route('order.index') }}" class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">Family<span class="text-emerald-500">Cafe.</span></span>
                </a>

                <div class="flex items-center gap-4">
                    {{-- DARK MODE TOGGLE BUTTON - START --}}
                    <button @click="darkMode = !darkMode" class="p-2 rounded-lg text-slate-400 hover:text-amber-500 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all" title="Toggle Dark Mode">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                    {{-- DARK MODE TOGGLE BUTTON - END --}}

                    @auth
                    <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors py-2 px-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-red-500 transition-colors py-2 px-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/50 hover:bg-emerald-100 dark:hover:bg-emerald-900 py-2 px-4 rounded-full transition-colors">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @isset($header)
    <header class="bg-white dark:bg-slate-800 border-b border-dashed border-slate-200 dark:border-slate-700">
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
