@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-300 hover:text-emerald-500 hover:border-emerald-200 dark:hover:bg-slate-700 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Detail Transaksi</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $order->queue_number }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="text-slate-500 dark:text-slate-400">Kasir</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ $order->user->name ?? $order->customer_name }}</div>

                <div class="text-slate-500 dark:text-slate-400">Metode</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ $order->payment_method === 'cash' ? 'Tunai' : strtoupper($order->payment_method) }}</div>

                <div class="text-slate-500 dark:text-slate-400">Status</div>
                <div class="text-right font-semibold text-slate-800 dark:text-white">{{ ucfirst($order->status) }}</div>
            </div>

            <div class="mt-6 border-t border-dashed border-slate-200 dark:border-slate-600 pt-4">
                <div class="space-y-2">
                    @foreach($order->items as $item)
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="font-medium text-slate-800 dark:text-white truncate">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="font-semibold text-slate-800 dark:text-white">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 border-t border-dashed border-slate-200 dark:border-slate-600 pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Total</span>
                    <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                    <div class="text-slate-500 dark:text-slate-400">Tunai</div>
                    <div class="text-right font-semibold text-slate-800 dark:text-white">Rp {{ number_format($order->cash_received ?? 0, 0, ',', '.') }}</div>

                    <div class="text-slate-500 dark:text-slate-400">Kembalian</div>
                    <div class="text-right font-semibold text-slate-800 dark:text-white">Rp {{ number_format($order->change_amount ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
