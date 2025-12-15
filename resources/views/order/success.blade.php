@extends('layouts.pos')
@section('title', 'Yeay! Pesanan Berhasil - Family Cafe')
@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="text-center max-w-md mx-auto">
        <!-- Success Icon -->
        <div class="relative inline-block mb-6">
            <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xl animate-bounce">🎉</div>
        </div>

        <h1 class="text-3xl font-bold text-slate-800 mb-2">Yeay! Berhasil</h1>
        <p class="text-slate-500 mb-8">Pesanan kamu udah masuk, tinggal tunggu aja!</p>

        <!-- Order Card -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8">
            <!-- Queue Number -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white mb-6">
                <p class="text-emerald-100 text-sm mb-1">Nomor Antrean</p>
                <h2 class="text-4xl font-bold">{{ $order->queue_number }}</h2>
            </div>

            <!-- Order Details -->
            <div class="space-y-3 text-left">
                <div class="flex items-center justify-between py-2 border-b border-dashed border-slate-100">
                    <span class="text-slate-500">Nama</span>
                    <span class="font-medium text-slate-800">{{ $order->customer_name }}</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-dashed border-slate-100">
                    <span class="text-slate-500">Pembayaran</span>
                    <span class="font-medium text-slate-800 uppercase">{{ $order->payment_method }}</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-dashed border-slate-100">
                    <span class="text-slate-500">Waktu Order</span>
                    <span class="font-medium text-slate-800">{{ $order->created_at->format('H:i') }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-slate-500">Total Bayar</span>
                    <span class="font-bold text-emerald-600 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mt-6 flex items-center gap-3 bg-emerald-50 rounded-xl p-4">
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-emerald-700">Pembayaran Diterima</p>
                    <p class="text-sm text-emerald-600">Pesanan sedang disiapkan</p>
                </div>
            </div>
        </div>

        <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
            Pesan Lagi yuk!
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
        <p class="text-sm text-slate-400 mt-4">📸 Screenshot halaman ini sebagai bukti ya!</p>
    </div>
</div>
@endsection
