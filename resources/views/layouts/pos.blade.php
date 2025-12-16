<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: $persist(false).as('dark_mode') }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Family Cafe')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .dark ::-webkit-scrollbar-track { background: #1e293b; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        @media print {
            nav, footer, .print\:hidden { display: none !important; }
            html, body { background: #ffffff !important; margin: 0 !important; padding: 0 !important; }
            main { padding: 0 !important; max-width: none !important; width: 100% !important; }

            .receipt-container { max-width: none !important; width: 100% !important; margin: 0 !important; }
            .receipt-card { border: none !important; box-shadow: none !important; border-radius: 0 !important; }
        }
    </style>

</head>
<body x-data="globalState" class="bg-[#F8FAFC] dark:bg-slate-900 text-slate-700 dark:text-slate-200 antialiased min-h-screen flex flex-col transition-colors duration-300">
    <nav class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('order.index') }}" class="flex items-center gap-3 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div class="hidden sm:block">
                        <span class="text-xl font-bold tracking-tight text-slate-800 dark:text-white">Family<span class="text-emerald-500">Cafe.</span></span>
                        <p class="text-xs text-slate-400 dark:text-slate-500 -mt-1">Transaksi tunai</p>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    {{-- DARK MODE TOGGLE BUTTON - START --}}
                    {{-- <button @click="darkMode = !darkMode" class="p-2 rounded-xl text-slate-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-slate-700 transition-all" title="Toggle Dark Mode">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button> --}}
                    {{-- DARK MODE TOGGLE BUTTON - END --}}

                    @auth
                    <a href="{{ route('order.history') }}" class="p-2 rounded-xl text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-slate-700 transition-all" title="Riwayat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    <div class="flex items-center gap-2 pl-3 border-l border-slate-100 dark:border-slate-700">
                        <div class="h-9 w-9 rounded-full bg-emerald-100 dark:bg-emerald-900 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-200 hidden sm:block">{{ Auth::user()->name }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="flex items-center" data-confirm-logout>
                        @csrf
                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-slate-700 transition-all" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>

                    @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full text-sm font-medium shadow-md shadow-emerald-500/20 hover:shadow-emerald-500/40 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow">
        @yield('content')
    </main>

    <footer class="border-t border-slate-100 dark:border-slate-700 mt-auto bg-white dark:bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-slate-400 dark:text-slate-500">© {{ date('Y') }} FamilyCafe. Dibuat dengan semangat ☕</p>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('globalState', () => ({
                cart: Alpine.$persist([]).as('shopping_cart'),
                cashReceived: 0,
                get totalPrice() { return this.cart.reduce((total, item) => total + (item.price * item.qty), 0); },
                get totalQty() { return this.cart.reduce((total, item) => total + item.qty, 0); },
                get changeDue() { return (Number(this.cashReceived) || 0) - this.totalPrice; },
                formatRupiah(number) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number); },
                clearCart() { this.cart = []; this.cashReceived = 0; },
                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },
                decreaseQty(index) {
                    if (!this.cart[index]) return;
                    if (this.cart[index].qty <= 1) {
                        this.cart.splice(index, 1);
                        return;
                    }
                    this.cart[index].qty--;
                },
                increaseQty(index) {
                    if (!this.cart[index]) return;
                    const maxStock = this.cart[index].maxStock;
                    if (typeof maxStock === 'number' && this.cart[index].qty >= maxStock) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stok Terbatas!',
                            text: `Maksimal ${maxStock} untuk ${this.cart[index].name}`,
                            confirmButtonColor: '#10b981'
                        });
                        return;
                    }
                    this.cart[index].qty++;
                },
                addToCart(product) {
                    const existingItemIndex = this.cart.findIndex(item => item.id === product.id);

                    const maxStock = typeof product.maxStock === 'number' ? product.maxStock : undefined;

                    if (existingItemIndex !== -1) {
                        const nextQty = this.cart[existingItemIndex].qty + 1;
                        if (typeof maxStock === 'number' && nextQty > maxStock) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stok Terbatas!',
                                text: `Maksimal ${maxStock} untuk ${product.name}`,
                                confirmButtonColor: '#10b981'
                            });
                            return;
                        }
                        this.cart[existingItemIndex].qty++;
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            qty: 1,
                            maxStock
                        });
                    }
                },
                async checkoutCash() {
                    if (!this.cart.length) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Keranjang kosong',
                            text: 'Tambahkan item dulu sebelum checkout.'
                        });
                        return;
                    }

                    if (!this.cashReceived || this.cashReceived <= 0) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Uang diterima belum diisi',
                            text: 'Masukkan uang yang diberikan pelanggan.'
                        });
                        return;
                    }

                    if (this.changeDue < 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Uang kurang',
                            text: `Uang kurang ${this.formatRupiah(Math.abs(this.changeDue))}.`
                        });
                        return;
                    }

                    const confirmed = await Swal.fire({
                        icon: 'question',
                        title: 'Konfirmasi Checkout',
                        html: `<div class="text-left">` +
                              `<div class="flex justify-between"><span>Total item</span><b>${this.totalQty}</b></div>` +
                              `<div class="flex justify-between mt-1"><span>Total bayar</span><b>${this.formatRupiah(this.totalPrice)}</b></div>` +
                              `<div class="flex justify-between mt-1"><span>Tunai</span><b>${this.formatRupiah(this.cashReceived)}</b></div>` +
                              `<div class="flex justify-between mt-1"><span>Kembalian</span><b>${this.formatRupiah(Math.max(this.changeDue, 0))}</b></div>` +
                              `</div>`,
                        showCancelButton: true,
                        confirmButtonText: 'OK, Selesaikan',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#10b981'
                    });

                    if (!confirmed.isConfirmed) return;

                    try {
                        const response = await fetch("{{ route('order.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.getAttribute('content') || "{{ csrf_token() }}",
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                cart: this.cart.map(i => ({ id: i.id, qty: i.qty })),
                                cash_received: this.cashReceived
                            })
                        });

                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(data?.message || 'Checkout gagal');
                        }

                        this.clearCart();
                        window.location.href = data.redirect_url;
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error?.message || 'Terjadi kesalahan.'
                        });
                    }
                }
            }))
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form[data-confirm-logout]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    if (form.dataset.confirmed === '1') return;

                    event.preventDefault();

                    const title = form.getAttribute('data-confirm-title') || 'Yakin logout?';
                    const text = form.getAttribute('data-confirm-text') || 'Kamu akan keluar dari akun ini.';

                    if (window.Swal && typeof Swal.fire === 'function') {
                        const result = await Swal.fire({
                            icon: 'question',
                            title,
                            text,
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Logout',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#ef4444'
                        });

                        if (!result.isConfirmed) return;
                    } else {
                        const ok = window.confirm(`${title}\n\n${text}`);
                        if (!ok) return;
                    }

                    form.dataset.confirmed = '1';
                    form.submit();
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
