<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Family Cafe')</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body x-data="globalState" class="bg-[#F8FAFC] text-slate-700 antialiased min-h-screen flex flex-col">
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20"> <a href="{{ route('order.index') }}" class="flex items-center gap-3 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.0002 11.2426L7.75752 6.99998L6.34331 8.41419L12.0002 14.0711L17.657 8.41419L16.2428 6.99998L12.0002 11.2426Z" opacity="0.5"/>
                        <path d="M6 15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V19C18 20.6569 16.6569 22 15 22H9C7.34315 22 6 20.6569 6 19V15Z" />
                        <path d="M9 2C9 3.65685 10.3431 5 12 5C13.6569 5 15 3.65685 15 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div class="hidden sm:block">
                        <span class="text-xl font-bold tracking-tight text-slate-800">Family<span class="text-emerald-500">Cafe.</span></span>
                        <p class="text-xs text-slate-400 -mt-1">Ngopi bareng yuk!</p>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                    <a href="{{ route('order.history') }}" class="p-2 rounded-xl text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 transition-all" title="Riwayat">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    <div class="flex items-center gap-2 pl-3 border-l border-slate-100">
                        <div class="h-9 w-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700 hidden sm:block">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Logout">
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

    <footer class="border-t border-slate-100 mt-auto bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-sm text-slate-400">© {{ date('Y') }} FamilyCafe. Dibuat dengan semangat ☕</p>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('globalState', () => ({
                cart: Alpine.$persist([]).as('shopping_cart'),
                get totalPrice() { return this.cart.reduce((total, item) => total + (item.price * item.qty), 0); },
                get totalQty() { return this.cart.reduce((total, item) => total + item.qty, 0); },
                formatRupiah(number) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number); },
                removeFromCart(index) {
                    this.cart.splice(index, 1);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Dihapus!',
                        text: 'Item berhasil dikeluarkan dari keranjang.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                // Tambahkan fungsi untuk menambahkan/memperbarui item ke keranjang (opsional, tetapi berguna)
                addToCart(product) {
                    const existingItemIndex = this.cart.findIndex(item => item.id === product.id);

                    if (existingItemIndex !== -1) {
                        this.cart[existingItemIndex].qty++;
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            qty: 1
                        });
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Ditambahkan!',
                        text: `${product.name} telah ditambahkan ke keranjang.`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }))
        })
    </script>
    @stack('scripts')
</body>
</html>
