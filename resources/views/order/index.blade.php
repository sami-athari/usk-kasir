@extends('layouts.pos')
@section('title', 'Menu - Family Cafe')
@section('content')
<div x-data="menuSearch()">
    <div class="flex items-start justify-between gap-4 mb-6 print:hidden">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">POS Kasir</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Pilih produk, cek keranjang, lalu checkout tunai.</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-6">
        <input type="text" x-model="searchQuery"
            placeholder="Cari menu favoritmu..."
            class="w-full px-5 py-4 pl-12 rounded-2xl bg-white border border-slate-100 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <button x-show="searchQuery.length > 0" @click="searchQuery = ''" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Category Filter -->
    <div class="flex flex-wrap gap-2 mb-8">
        <button @click="activeCategory = 'all'"
            :class="activeCategory === 'all' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/30' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100'"
            class="px-5 py-2.5 rounded-xl text-sm font-medium transition-all">
            Semua
        </button>
        @foreach($categories as $category)
        <button @click="activeCategory = '{{ $category->id }}'"
            :class="activeCategory === '{{ $category->id }}' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/30' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100'"
            class="px-5 py-2.5 rounded-xl text-sm font-medium transition-all">
            {{ $category->icon ?? '📁' }} {{ $category->name }}
        </button>
        @endforeach
        @if($products->whereNull('category_id')->count() > 0)
        <button @click="activeCategory = 'uncategorized'"
            :class="activeCategory === 'uncategorized' ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/30' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100'"
            class="px-5 py-2.5 rounded-xl text-sm font-medium transition-all">
            🗂️ Lainnya
        </button>
        @endif
    </div>

    <!-- Search Result Info -->
    <div x-show="searchQuery.length > 0" x-cloak class="mb-6">
        <p class="text-slate-500">Hasil pencarian untuk: <span class="font-semibold text-slate-700" x-text="searchQuery"></span></p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Products -->
        <div class="lg:col-span-2">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                @foreach($products as $product)
                @php $isAvailable = $product->is_available && $product->stock > 0; @endphp
                <div x-show="isVisible('{{ addslashes($product->name) }}', '{{ $product->category_id ?? '' }}')"
                    x-transition
                    class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-500/40 transition-all">

                    <div class="relative aspect-square bg-slate-50 dark:bg-slate-700 overflow-hidden">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-5xl opacity-30">☕</span>
                        </div>
                        @endif

                        @if(!$isAvailable)
                        <div class="absolute inset-0 bg-slate-900/60 flex items-center justify-center">
                            <span class="px-3 py-1.5 bg-slate-800 text-white text-xs font-bold rounded-full">HABIS</span>
                        </div>
                        @elseif($product->stock > 0 && $product->stock <= 5)
                        <div class="absolute top-2 right-2">
                            <span class="px-2 py-1 bg-orange-500 text-white text-xs font-bold rounded-full">Sisa {{ $product->stock }}!</span>
                        </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-slate-800 dark:text-white mb-1 truncate">{{ $product->name }}</h3>
                        <p class="text-emerald-600 dark:text-emerald-400 font-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <p class="text-xs mb-3 {{ $product->stock > 0 ? 'text-slate-500 dark:text-slate-400' : 'text-red-600 dark:text-red-400' }}">
                            Stok: <span class="font-semibold">{{ max((int) $product->stock, 0) }}</span>
                        </p>

                        @if($isAvailable)
                        <button
                            @click="addToCart({ id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', price: {{ $product->price }}, maxStock: {{ $product->stock }} })"
                            class="w-full py-2.5 rounded-xl text-sm font-semibold bg-emerald-500 hover:bg-emerald-600 text-white shadow-md shadow-emerald-500/20 transition-all">
                            + Tambah
                        </button>
                        @else
                        <button disabled class="w-full py-2.5 rounded-xl text-sm font-semibold bg-slate-100 dark:bg-slate-700 text-slate-400 dark:text-slate-400 cursor-not-allowed">
                            Stok Habis
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @if($products->isEmpty())
            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-4xl mb-6">🫗</div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Produk kosong</h3>
                <p class="text-slate-500 dark:text-slate-400">Tambahkan produk dari admin.</p>
            </div>
            @endif

            <div x-show="searchQuery.length > 0 && visibleCount === 0" x-cloak class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-4xl mb-6">🔍</div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Produk tidak ditemukan</h3>
                <p class="text-slate-500 dark:text-slate-400 mb-6">Tidak ada produk dengan kata "<span x-text="searchQuery"></span>"</p>
                <button @click="searchQuery = ''" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
                    Reset pencarian
                </button>
            </div>
        </div>

        <!-- Cart Sidebar -->
        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 sticky top-24">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div>
                        <h3 class="font-semibold text-slate-800 dark:text-white">Keranjang</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Barang yang sudah di-checkin</p>
                    </div>
                    <button @click="clearCart()" class="text-sm text-slate-400 hover:text-red-500 transition-colors" :disabled="cart.length === 0">
                        Kosongkan
                    </button>
                </div>

                <div class="space-y-3 max-h-[50vh] overflow-auto pr-1">
                    <template x-if="cart.length === 0">
                        <div class="rounded-2xl bg-slate-50 dark:bg-slate-700 p-4 text-sm text-slate-500 dark:text-slate-300">
                            Keranjang masih kosong.
                        </div>
                    </template>

                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="rounded-2xl border border-slate-100 dark:border-slate-700 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 dark:text-white truncate" x-text="item.name"></p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400" x-text="formatRupiah(item.price)"></p>
                                </div>
                                <button @click="removeFromCart(index)" class="text-slate-400 hover:text-red-500 transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-700 rounded-xl p-1">
                                    <button @click="decreaseQty(index)" class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-200 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center font-bold">−</button>
                                    <span class="w-8 text-center font-semibold text-slate-800 dark:text-white" x-text="item.qty"></span>
                                    <button @click="increaseQty(index)" class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-200 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center font-bold">+</button>
                                </div>
                                <p class="font-bold text-emerald-600 dark:text-emerald-400" x-text="formatRupiah(item.price * item.qty)"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Total</span>
                        <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400" x-text="formatRupiah(totalPrice)"></span>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-2">Uang Diterima</label>
                        <input type="number" min="0" step="1000" x-model.number="cashReceived"
                            placeholder="Masukkan uang dari pelanggan"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <span class="text-slate-500 dark:text-slate-400">Kembalian</span>
                            <span class="font-semibold" :class="changeDue < 0 ? 'text-red-500' : 'text-emerald-600 dark:text-emerald-400'" x-text="formatRupiah(Math.max(changeDue, 0))"></span>
                        </div>
                        <p x-show="cart.length > 0 && cashReceived > 0 && changeDue < 0" x-cloak class="mt-2 text-xs text-red-500">
                            Uang kurang: <span x-text="formatRupiah(Math.abs(changeDue))"></span>
                        </p>
                    </div>

                    <button @click="checkoutCash()" :disabled="cart.length === 0 || cashReceived <= 0 || changeDue < 0" :class="(cart.length === 0 || cashReceived <= 0 || changeDue < 0) ? 'bg-slate-200 dark:bg-slate-700 text-slate-400 cursor-not-allowed shadow-none' : 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-lg shadow-emerald-500/30'" class="w-full mt-4 py-3 rounded-xl font-semibold transition-all">
                        Checkout (Tunai)
                    </button>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Checkout akan menyelesaikan transaksi & membuat struk.</p>
                </div>
            </div>
        </aside>
    </div>

</div>
@endsection

@push('scripts')
<script>
function menuSearch() {
    return {
        activeCategory: 'all',
        searchQuery: '',
        products: @json($products->map(fn($p) => ['id' => $p->id, 'name' => strtolower($p->name), 'category_id' => $p->category_id])),
        get visibleCount() {
            return this.products.filter(p => {
                const matchCategory = this.activeCategory === 'all' || this.activeCategory === String(p.category_id) || (this.activeCategory === 'uncategorized' && !p.category_id);
                const matchSearch = this.searchQuery === '' || p.name.includes(this.searchQuery.toLowerCase());
                return matchCategory && matchSearch;
            }).length;
        },
        isVisible(productName, categoryId) {
            const matchCategory = this.activeCategory === 'all' || this.activeCategory === String(categoryId) || (this.activeCategory === 'uncategorized' && !categoryId);
            const matchSearch = this.searchQuery === '' || productName.toLowerCase().includes(this.searchQuery.toLowerCase());
            return matchCategory && matchSearch;
        }
    }
}
</script>
@endpush
