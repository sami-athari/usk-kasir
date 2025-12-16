@extends('layouts.pos')
@section('title', 'Riwayat Pesanan - Family Cafe')
@section('content')
<div>
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('order.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-300 hover:text-emerald-500 hover:border-emerald-200 dark:hover:bg-slate-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Riwayat Transaksi</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Daftar transaksi yang sudah di-checkout</p>
        </div>
    </div>

    <!-- Orders List -->
    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-xl">☕</div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-800 dark:text-white">{{ $order->queue_number }}</span>
                            @php
                                $statusColors = [
                                    'paid' => 'bg-emerald-100 text-emerald-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                ];
                                $statusLabels = [
                                    'paid' => 'Dibayar',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Batal',
                                    'pending' => 'Pending',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 uppercase">{{ $order->payment_method === 'cash' ? 'TUNAI' : $order->payment_method }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tunai: Rp {{ number_format($order->cash_received ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Kembali: Rp {{ number_format($order->change_amount ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="px-4 py-3 bg-slate-50 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-700">
                <div class="flex flex-wrap gap-2 items-center justify-between">
                    <div class="flex flex-wrap gap-2">
                    @foreach($order->items as $item)
                    <span class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-sm text-slate-600 dark:text-slate-300 border border-slate-100 dark:border-slate-700">
                        {{ $item->qty }}x {{ $item->product->name ?? 'Produk Dihapus' }}
                    </span>
                    @endforeach
                    </div>

                    <a href="{{ route('order.show', $order->id) }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-sm font-semibold hover:opacity-90 transition-all">
                        Lihat Struk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-12 text-center">
            <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-4xl mb-6">🧾</div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Belum Ada Transaksi</h3>
            <p class="text-slate-500 dark:text-slate-400 mb-6">Mulai transaksi pertama dari halaman POS.</p>
            <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all">
                Buka POS
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
