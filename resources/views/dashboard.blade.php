<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800">Dashboard</h2>
    </x-slot>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
        <div class="flex items-start gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <span class="text-2xl">👋</span>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-semibold text-slate-800 mb-1">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-slate-500">Anda berhasil login. Mulai pesan menu favorit Anda sekarang.</p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Order Now Card -->
                <a href="{{ route('order.index') }}" class="group p-5 bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-2xl border border-emerald-100 hover:border-emerald-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Mulai Pesan</h4>
                    <p class="text-sm text-slate-500">Lihat menu dan pesan sekarang</p>
                </a>

                <!-- Order History Card -->
                <a href="{{ route('order.history') }}" class="group p-5 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl border border-blue-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Riwayat Pesanan</h4>
                    <p class="text-sm text-slate-500">Lihat pesanan sebelumnya</p>
                </a>

                <!-- Profile Card -->
                <a href="{{ route('profile.edit') }}" class="group p-5 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl border border-purple-100 hover:border-purple-200 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-purple-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Profil Saya</h4>
                    <p class="text-sm text-slate-500">Edit informasi akun</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
