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
    </style>
</head>
<body class="bg-[#F8FAFC] dark:bg-slate-900 text-slate-700 dark:text-slate-200 antialiased min-h-screen flex items-center justify-center p-4 transition-colors duration-300">
    <div class="w-full max-w-md">

        <div class="text-center mb-10">
            <a href="/" class="inline-flex items-center gap-3 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                    <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                    <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <span class="text-3xl font-bold tracking-tight text-slate-800 dark:text-white">Family<span class="text-emerald-500">Cafe.</span></span>
            </a>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-700 p-8 sm:p-10">
            {{ $slot }}
        </div>

        <p class="text-center text-sm text-slate-400 dark:text-slate-500 mt-8">© {{ date('Y') }} FamilyCafe. All rights reserved.</p>
    </div>
</body>
</html>
