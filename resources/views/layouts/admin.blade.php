<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Cafe Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">

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
<body class="bg-[#F8FAFC] text-slate-700 antialiased">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white fixed inset-y-0 left-0 z-20 flex flex-col border-r border-dashed border-slate-200">

            <div class="h-24 flex items-center px-8">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xl font-bold tracking-tight text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
                </div>
            </div>

           <nav class="flex-1 px-6 py-4 space-y-6 overflow-y-auto">

    <div>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 pl-2">Overview</p>
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="text-base">Dashboard</span>
        </a>
    </div>

    <div>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 pl-2">Master Data</p>

        <a href="{{ route('admin.ingredients.index') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="text-base">Gudang bahan</span>
        </a>


<a href="{{ route('admin.products.index') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="text-base">Daftar Menu</span>
        </a>



        <a href="{{ route('admin.categories.index') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="text-base">Kategori</span>
        </a>
    </div>

    <div>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 pl-2">Keuangan</p>

        @if (config('features.pengeluaran_admin'))
        <a href="{{ route('admin.expenses.index') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.expenses.*') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z" />
            </svg>
            <span class="text-base">Pengeluaran</span>
        </a>
        @endif

        <a href="{{ route('admin.finance.index') }}" class="group flex items-center gap-4 px-2 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.finance.*') ? 'text-emerald-600 font-bold translate-x-2' : 'text-slate-500 hover:text-emerald-500 hover:translate-x-2' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-base">Laporan Keuangan</span>
        </a>
    </div>

</nav>

            <div class="p-8 border-t border-dashed border-slate-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-3 text-slate-400 hover:text-red-500 transition-colors w-full group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-10 lg:p-14 transition-all">
            <div class="flex justify-between items-center mb-10">
                <div>
                   <p class="text-sm text-slate-400">Admin Portal / <span class="text-emerald-600 font-medium">Home</span></p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">Super Admin</p>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
