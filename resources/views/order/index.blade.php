@extends('layouts.pos')
@section('title', 'Menu - Family Cafe')
@section('content')
<div x-data="menuSearch()">
    <!-- Hero Banner -->
    <div class="relative bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-3xl p-8 mb-8 overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur rounded-full text-white text-xs font-medium mb-3">🔥 PROMO HARI INI</span>
            <h2 class="text-3xl font-bold text-white mb-2">Ngopi Dulu, Baru Mikir!</h2>
            <p class="text-emerald-100">Pesan sekarang, bayar cashless. Gak pake ribet!</p>
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

    <!-- Products Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach($products as $product)
        @php $isAvailable = $product->is_available && $product->stock > 0; @endphp
        <div x-show="isVisible('{{ addslashes($product->name) }}', '{{ $product->category_id ?? '' }}')"
            x-transition
            x-data="{ added: false }"
            class="group bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg hover:border-emerald-200 transition-all">

            <!-- Image -->
            <div class="relative aspect-square bg-slate-50 overflow-hidden">
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

            <!-- Content -->
            <div class="p-4">
                <h3 class="font-semibold text-slate-800 mb-1 truncate">{{ $product->name }}</h3>
                <p class="text-emerald-600 font-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                @if($isAvailable)
                <button
                    x-data="{ maxStock: {{ $product->stock }} }"
                    @click="let item = cart.find(i => i.id === {{ $product->id }}); let currentQty = item ? item.qty : 0; if (currentQty >= maxStock) { Swal.fire({ icon: 'warning', title: 'Stok Terbatas!', text: 'Maksimal ' + maxStock + ' untuk {{ $product->name }}', confirmButtonColor: '#10b981' }); return; } if(item) { item.qty++; } else { cart.push({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }}, qty: 1, maxStock: maxStock }); } added = true; setTimeout(() => added = false, 1000);"
                    class="w-full py-2.5 rounded-xl text-sm font-semibold transition-all"
                    :class="added ? 'bg-emerald-100 text-emerald-600' : 'bg-emerald-500 text-white hover:bg-emerald-600 shadow-md shadow-emerald-500/20'">
                    <span x-show="!added">+ Tambah</span>
                    <span x-show="added" x-cloak>✓ Ditambah!</span>
                </button>
                @else
                <button disabled class="w-full py-2.5 rounded-xl text-sm font-semibold bg-slate-100 text-slate-400 cursor-not-allowed">
                    Stok Habis
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($products->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-4xl mb-6">🫗</div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">Menu Lagi Kosong Nih</h3>
        <p class="text-slate-500">Tunggu bentar ya, kita lagi siapin menu kece!</p>
    </div>
    @endif

    <!-- No Search Results -->
    <div x-show="searchQuery.length > 0 && visibleCount === 0" x-cloak class="bg-white rounded-3xl border border-slate-100 shadow-sm p-12 text-center">
        <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-4xl mb-6">🔍</div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">Menu tidak ditemukan</h3>
        <p class="text-slate-500 mb-6">Tidak ada menu dengan kata "<span x-text="searchQuery"></span>"</p>
        <button @click="searchQuery = ''" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
            Lihat Semua Menu
        </button>
    </div>
</div>

<!-- Floating Cart Button -->
<div x-show="cart.length > 0" x-transition x-cloak class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 w-full max-w-md px-4">
    <a href="{{ route('order.checkout') }}" class="flex items-center justify-between bg-emerald-500 hover:bg-emerald-600 text-white p-4 rounded-2xl shadow-xl shadow-emerald-500/30 transition-all">
        <div class="flex items-center gap-3">
            <div class="relative">
                <span class="text-2xl">🛒</span>
                <span class="absolute -top-2 -right-2 w-5 h-5 bg-white text-emerald-600 text-xs font-bold rounded-full flex items-center justify-center" x-text="totalQty"></span>
            </div>
            <div class="text-left">
                <p class="text-emerald-100 text-xs">Total Pesanan</p>
                <p class="font-bold" x-text="formatRupiah(totalPrice)"></p>
            </div>
        </div>
        <div class="flex items-center gap-2 bg-white/20 px-4 py-2 rounded-xl">
            <span class="font-semibold">Checkout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </div>
    </a>
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
