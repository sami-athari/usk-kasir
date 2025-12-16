@extends('layouts.admin')

@section('content')
<div x-data="{ activeTab: 'daily' }">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-light text-slate-800 tracking-tight">Halo, <span class="font-bold">{{ Auth::user()->name }}</span> 👋</h1>
            <p class="text-slate-500 mt-2">Berikut ringkasan performa cafe hari ini.</p>
        </div>

        <div class="bg-white p-1.5 rounded-full shadow-sm border border-slate-100 inline-flex">
            <button @click="activeTab = 'daily'" :class="activeTab === 'daily' ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300">Harian</button>
            <button @click="activeTab = 'monthly'" :class="activeTab === 'monthly' ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300">Bulanan</button>
            <button @click="activeTab = 'yearly'" :class="activeTab === 'yearly' ? 'bg-emerald-500 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300">Tahunan</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

        <div class="relative group">
            <div class="absolute inset-0 bg-blue-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex items-start justify-between overflow-hidden">
                <div>
                    <p class="text-slate-400 font-medium text-sm uppercase tracking-wider mb-1">Total Pesanan</p>
                    <h3 class="text-4xl font-bold text-slate-800" x-text="activeTab === 'daily' ? '{{ $todayOrders }}' : (activeTab === 'monthly' ? '{{ $monthOrders }}' : '{{ $yearOrders }}')"></h3>
                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-blue-400"></span> Transaksi berhasil
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 opacity-20 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>

        <div class="relative group">
            <div class="absolute inset-0 bg-emerald-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex items-start justify-between overflow-hidden">
                <div>
                    <p class="text-slate-400 font-medium text-sm uppercase tracking-wider mb-1">Pemasukan</p>
                    <h3 class="text-4xl font-bold text-emerald-600" x-text="activeTab === 'daily' ? 'Rp {{ number_format($todayOmset/1000, 0) }}k' : (activeTab === 'monthly' ? 'Rp {{ number_format($monthOmset/1000, 0) }}k' : 'Rp {{ number_format($yearOmset/1000000, 1) }}jt')"></h3>
                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Gross Revenue
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-emerald-500 opacity-20 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.15-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.35 0 2.53-.86 2.53-1.91 0-1.05-1.18-1.91-2.53-1.91-2.64 0-4.66-1.57-4.66-3.75 0-1.93 1.56-3.4 3.44-3.75V4h2.67v1.93c1.71.36 3.15 1.46 3.27 3.4h-1.96c-.1-1.05-1.18-1.91-2.53-1.91-1.35 0-2.53.86-2.53 1.91 0 1.05 1.18 1.91 2.53 1.91 2.64 0 4.66 1.57 4.66 3.75 0 1.93-1.56 3.4-3.44 3.75z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-800">Daftar Menu</h3>
                        <a href="{{ route('admin.products.create') }}" class="text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-2 rounded-xl transition-colors">Tambah</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($latestProducts as $product)
                        <div class="flex items-center justify-between gap-4 p-3 rounded-2xl border border-slate-100 bg-white">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-700 truncate">{{ $product->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $product->category->name ?? '-' }}</p>
                            </div>
                            <div class="shrink-0 text-right">
                                <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-[10px] text-slate-400">Stok: {{ $product->stock }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10 text-slate-400 text-sm">Belum ada menu</div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-5 border-t border-dashed border-slate-100 text-center">
                        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-emerald-500 hover:text-emerald-700">Lihat lebih lanjut &rarr;</a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-800">Kategori</h3>
                        <a href="{{ route('admin.categories.create') }}" class="text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-2 rounded-xl transition-colors">Tambah</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($topCategories as $cat)
                        <div class="flex items-center justify-between gap-4 p-3 rounded-2xl border border-slate-100 bg-white">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-700 truncate">{{ $cat->icon ?? '📁' }} {{ $cat->name }}</p>
                                <p class="text-xs text-slate-400">{{ $cat->products_count ?? 0 }} produk</p>
                            </div>
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-xs text-slate-500 hover:text-emerald-600">Edit</a>
                        </div>
                        @empty
                        <div class="text-center py-10 text-slate-400 text-sm">Belum ada kategori</div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-5 border-t border-dashed border-slate-100 text-center">
                        <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-emerald-500 hover:text-emerald-700">Lihat lebih lanjut &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Order Terbaru</h3>

            <div class="space-y-6">
                @forelse($orders->take(4) as $order)
                <div class="flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        @php
                            $customerName = $order->user->name ?? 'Guest';
                            $initial = strtoupper(mb_substr($customerName, 0, 1));
                        @endphp
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm">
                            {{ $initial }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">{{ $order->user->name ?? 'Guest' }}</p>
                            <p class="text-xs text-slate-400">#{{ $order->order_number }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-slate-400">{{ $order->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-slate-400 text-sm">Belum ada data</div>
                @endforelse
            </div>

            <div class="mt-8 pt-6 border-t border-dashed border-slate-100 text-center">
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-emerald-500 hover:text-emerald-700">Lihat Semua Transaksi &rarr;</a>
            </div>
        </div>

    </div>
</div>
@endsection
