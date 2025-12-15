<nav x-data="{ open: false }" class="bg-white border-b border-dashed border-slate-200 shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="text-xl font-bold tracking-tight text-slate-800 hidden sm:block">Family<span class="text-emerald-500">Cafe.</span></span>
                </a>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:space-x-4 lg:space-x-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors
                    {{ request()->routeIs('dashboard') ? 'border-b-2 border-emerald-500 text-emerald-600 font-semibold' : 'text-slate-500 hover:text-slate-700 hover:border-slate-300 border-b-2 border-transparent' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('order.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors
                    {{ request()->routeIs('order.index') ? 'border-b-2 border-emerald-500 text-emerald-600 font-semibold' : 'text-slate-500 hover:text-slate-700 hover:border-slate-300 border-b-2 border-transparent' }}">
                    Menu
                </a>
            </div>

            <div class="flex items-center ml-6">
                <div class="hidden sm:flex sm:items-center sm:ml-6" x-data="{ dropOpen: false }">
                    <button @click="dropOpen = !dropOpen" type="button" class="flex items-center max-w-xs bg-white rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 p-1" aria-expanded="false" aria-haspopup="true">
                        <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="ml-3 text-sm font-medium text-slate-700 hidden lg:inline">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="dropOpen" @click.away="dropOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none origin-top-right transform translate-y-2" style="right: 1rem; top: 4.5rem;" x-cloak>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500 transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                        <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div x-show="open" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="sm:hidden" id="mobile-menu" x-cloak>

        <div class="pt-2 pb-3 space-y-1 border-t border-dashed border-slate-200">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base font-medium transition-colors
                {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-600 border-l-4 border-emerald-500' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700 border-l-4 border-transparent' }}">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('order.index') }}" class="block px-4 py-2 text-base font-medium transition-colors
                {{ request()->routeIs('order.index') ? 'bg-emerald-50 text-emerald-600 border-l-4 border-emerald-500' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700 border-l-4 border-transparent' }}">
                Menu
            </a>
        </div>

        <div class="pt-4 pb-3 border-t border-dashed border-slate-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">
                    {{ __('Profile') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:bg-red-50 transition-colors">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
