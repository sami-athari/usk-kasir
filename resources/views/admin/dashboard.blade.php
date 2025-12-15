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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

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

        <div class="relative group">
            <div class="absolute inset-0 bg-orange-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex items-start justify-between overflow-hidden">
                <div>
                    <p class="text-slate-400 font-medium text-sm uppercase tracking-wider mb-1">Stok Kritis</p>
                    <h3 class="text-4xl font-bold text-orange-500">{{ $lowStockProducts->count() }}</h3>
                    <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-orange-400"></span> Perlu Restock
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-orange-500 opacity-20 -mr-4 -mt-4 transform group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-slate-800">Grafik Penjualan</h3>
                <span class="text-xs text-slate-400 font-mono bg-slate-50 px-2 py-1 rounded">LAST 7 DAYS</span>
            </div>

            <div class="flex items-end justify-between h-56 gap-4">
                @foreach($chartData as $data)
                <div class="flex flex-col items-center gap-3 w-full group">
                    <div class="relative w-full flex items-end justify-center h-full">
                        <div style="height: {{ $data['total'] > 0 ? ($data['total'] / (collect($chartData)->max('total') ?: 1)) * 100 : 2 }}%"
                             class="w-3 md:w-4 bg-slate-200 rounded-full group-hover:bg-emerald-500 transition-all duration-500 relative">

                             <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10">
                                {{ number_format($data['total']/1000, 0) }}k
                             </div>
                        </div>
                    </div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 group-hover:text-emerald-600">{{ \Carbon\Carbon::parse($data['date'])->format('D') }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Order Terbaru</h3>

            <div class="space-y-6">
                @forelse($orders->take(4) as $order)
                <div class="flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-lg shadow-inner">
                            🍵
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
                <a href="#" class="text-sm font-medium text-emerald-500 hover:text-emerald-700">Lihat Semua Transaksi &rarr;</a>
            </div>
        </div>

    </div>

    @if($lowStockProducts->count() > 0)
    <div class="mt-8 bg-orange-50 border border-orange-100 rounded-2xl p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-orange-100 rounded-full text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="text-sm text-orange-800 font-medium">Ada {{ $lowStockProducts->count() }} item yang stoknya menipis.</span>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs bg-white border border-orange-200 text-orange-600 px-3 py-1.5 rounded-lg hover:shadow-sm">Cek Gudang</a>
    </div>
    @endif

</div>
@endsection
