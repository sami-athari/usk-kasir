@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-light text-slate-800 tracking-tight">Laporan <span class="font-bold">Keuangan</span></h1>
            <p class="text-slate-500 mt-2">Analisis pendapatan, pengeluaran, dan profit bisnis Anda.</p>
        </div>
        <a href="{{ route('admin.expenses.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40 hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Catat Pengeluaran
        </a>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm mb-8">
        <form action="{{ route('admin.finance.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[120px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Periode</label>
                <select name="period" onchange="togglePeriodInputs()" id="periodSelect" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                    <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
            <div id="monthSelect" class="flex-1 min-w-[120px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Bulan</label>
                <select name="month" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                    @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[120px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Tahun</label>
                <select name="year" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                    @foreach($years as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Tampilkan
            </button>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Pendapatan -->
        <div class="relative group">
            <div class="absolute inset-0 bg-emerald-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-emerald-100 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Pendapatan</span>
                </div>
                <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($periodData['revenue'], 0, ',', '.') }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $periodData['label'] }}</p>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="relative group">
            <div class="absolute inset-0 bg-red-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-red-100 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Pengeluaran</span>
                </div>
                <p class="text-2xl font-bold text-red-500">Rp {{ number_format($periodData['expenses'], 0, ',', '.') }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $periodData['label'] }}</p>
            </div>
        </div>

        <!-- Laba Bersih -->
        @if (config('features.laba_bersih'))
        <div class="relative group">
            <div class="absolute inset-0 bg-blue-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-blue-100 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Laba Bersih</span>
                </div>
                <p class="text-2xl font-bold {{ $periodData['profit'] >= 0 ? 'text-blue-600' : 'text-red-500' }}">Rp {{ number_format($periodData['profit'], 0, ',', '.') }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $periodData['label'] }}</p>
            </div>
        </div>
        @endif

        <!-- Total Order -->
        <div class="relative group">
            <div class="absolute inset-0 bg-purple-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
            <div class="relative bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 bg-purple-100 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Order</span>
                </div>
                <p class="text-2xl font-bold text-purple-600">{{ number_format($periodData['orders_count']) }}</p>
                <p class="text-xs text-slate-400 mt-1">Avg: Rp {{ number_format($periodData['avg_order_value'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Margin Analysis -->
    @if (config('features.analisis_margin'))
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700/60 mb-8">
        <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
            <div class="p-2 bg-slate-100 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            Analisis Margin Keuntungan
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-sm text-slate-500 mb-1">Pendapatan Kotor</p>
                <p class="text-xl font-bold text-slate-800">Rp {{ number_format($marginAnalysis['revenue'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-5">
                <p class="text-sm text-slate-500 mb-1">HPP (Bahan Baku)</p>
                <p class="text-xl font-bold text-orange-500">Rp {{ number_format($marginAnalysis['hpp'], 0, ',', '.') }}</p>
            </div>
            <div class="bg-emerald-50 rounded-2xl p-5">
                <p class="text-sm text-slate-500 mb-1">Laba Kotor</p>
                <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($marginAnalysis['gross_profit'], 0, ',', '.') }}</p>
                <p class="text-xs text-emerald-500 mt-1">Margin: {{ number_format($marginAnalysis['gross_margin'], 1) }}%</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-5">
                <p class="text-sm text-slate-500 mb-1">Laba Bersih</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($marginAnalysis['net_profit'], 0, ',', '.') }}</p>
                <p class="text-xs text-blue-500 mt-1">Margin: {{ number_format($marginAnalysis['net_margin'], 1) }}%</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Charts Row -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
        @if (config('features.grafik_keuangan'))
        <!-- Trend Chart -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-slate-800">Trend Pendapatan vs Pengeluaran</h3>
                <span class="text-xs text-slate-400 font-mono bg-slate-50 px-2 py-1 rounded">{{ strtoupper($period) }}</span>
            </div>

            <div class="flex items-end justify-between h-48 gap-2 md:gap-4">
                @foreach($chartData as $data)
                @php
                    $maxVal = max(collect($chartData)->max('revenue'), collect($chartData)->max('expenses')) ?: 1;
                    $revHeight = $data['revenue'] > 0 ? ($data['revenue'] / $maxVal) * 100 : 2;
                    $expHeight = $data['expenses'] > 0 ? ($data['expenses'] / $maxVal) * 100 : 2;
                @endphp
                <div class="flex flex-col items-center gap-2 w-full group">
                    <div class="relative w-full flex items-end justify-center h-full gap-1">
                        <!-- Revenue Bar -->
                        <div style="height: {{ $revHeight }}%"
                             class="w-3 bg-emerald-400 rounded-full transition-all duration-500 hover:bg-emerald-500 relative"
                             title="Pendapatan: Rp {{ number_format($data['revenue'], 0, ',', '.') }}">
                        </div>
                        <!-- Expense Bar -->
                        <div style="height: {{ $expHeight }}%"
                             class="w-3 bg-red-400 rounded-full transition-all duration-500 hover:bg-red-500 relative"
                             title="Pengeluaran: Rp {{ number_format($data['expenses'], 0, ',', '.') }}">
                        </div>
                    </div>
                    <span class="text-[10px] uppercase font-bold text-slate-400">{{ $data['label'] }}</span>
                </div>
                @endforeach
            </div>

            <div class="flex items-center justify-center gap-6 mt-6 pt-6 border-t border-dashed border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full"></div>
                    <span class="text-xs text-slate-500">Pendapatan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                    <span class="text-xs text-slate-500">Pengeluaran</span>
                </div>
            </div>
        </div>
        @endif

        @if (config('features.breakdown_pengeluaran'))
        <!-- Expense Breakdown -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Breakdown Pengeluaran</h3>
            @if($expensesByCategory->count() > 0)
            <div class="space-y-4">
                @foreach($expensesByCategory as $expense)
                @php $maxExpense = $expensesByCategory->max('total') ?: 1; $width = ($expense->total / $maxExpense) * 100; @endphp
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-slate-700">{{ $categories[$expense->category] ?? $expense->category }}</span>
                        <span class="text-sm font-bold text-slate-800">Rp {{ number_format($expense->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-red-400 to-red-500 rounded-full transition-all duration-500" style="width: {{ $width }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-3xl mb-4">📋</div>
                <p class="text-slate-500">Belum ada pengeluaran tercatat</p>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- HPP Analysis -->
    @if (config('features.analisis_hpp'))
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm mb-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-800">Analisis HPP & Profit per Produk</h2>
            <p class="text-slate-500 text-sm mt-1">Perhitungan otomatis berdasarkan resep bahan baku yang digunakan</p>
        </div>
        @if(count($hppByProduct) > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-700">
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Produk</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Qty</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Harga Jual</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">HPP/Unit</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Profit/Unit</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Margin</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Total Profit</th>
                        <th class="text-right px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($hppByProduct as $index => $product)
                    <tr x-data="{ showDetail: false }" class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $product['name'] }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ number_format($product['qty_sold']) }}</td>
                        <td class="px-4 py-3 text-slate-600">Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-orange-500 font-medium">Rp {{ number_format($product['hpp_per_unit'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-emerald-600 font-medium">Rp {{ number_format($product['profit_per_unit'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $product['margin_percent'] >= 50 ? 'bg-emerald-100 text-emerald-700' : ($product['margin_percent'] >= 30 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ number_format($product['margin_percent'], 1) }}%
                            </span>
                        </td>
                        <td class="px-4 py-3 text-emerald-600 font-bold">Rp {{ number_format($product['total_profit'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-right">
                            <button @click="showDetail = !showDetail" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs font-medium transition-colors">
                                <span x-show="!showDetail">Lihat</span>
                                <span x-show="showDetail">Tutup</span>
                            </button>
                        </td>
                    </tr>
                    <tr x-show="showDetail" x-transition>
                        <td colspan="8" class="px-4 py-4 bg-slate-50">
                            <div class="bg-white rounded-xl p-4 border border-slate-200">
                                <p class="text-sm font-bold text-slate-700 mb-3">Rincian Bahan Baku untuk 1 {{ $product['name'] }}:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($product['ingredients'] as $ing)
                                    <div class="bg-slate-50 rounded-lg p-3 flex items-center justify-between">
                                        <div>
                                            <span class="text-sm font-medium text-slate-700">{{ $ing['name'] }}</span>
                                            <p class="text-xs text-slate-400">{{ $ing['amount'] }} {{ $ing['unit'] }} × Rp {{ number_format($ing['cost_per_unit'], 0, ',', '.') }}</p>
                                        </div>
                                        <span class="text-sm font-bold text-slate-800">Rp {{ number_format($ing['total_cost'], 0, ',', '.') }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 pt-4 border-t border-dashed border-slate-200 flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-700">Total HPP per Unit:</span>
                                    <span class="text-lg font-bold text-orange-500">Rp {{ number_format($product['hpp_per_unit'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-slate-100 dark:bg-slate-700/60 font-bold">
                        <td class="px-4 py-3 text-slate-800">TOTAL</td>
                        <td class="px-4 py-3 text-slate-600">{{ number_format(collect($hppByProduct)->sum('qty_sold')) }}</td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3 text-orange-500">Rp {{ number_format($hpp, 0, ',', '.') }}</td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3 text-emerald-600">Rp {{ number_format(collect($hppByProduct)->sum('total_profit'), 0, ',', '.') }}</td>
                        <td class="px-4 py-3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-3xl mb-4">📊</div>
            <p class="text-slate-500">Belum ada data penjualan untuk periode ini</p>
        </div>
        @endif
    </div>
    @endif

    <!-- Top Products -->
    @if (config('features.top_produk'))
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700/60 mb-8">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Top 10 Produk Terlaris</h2>
        @if($revenueByProduct->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-700">
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">#</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Produk</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Qty Terjual</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Total Revenue</th>
                        <th class="text-left px-4 py-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Kontribusi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($revenueByProduct as $index => $product)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-4 py-3">
                            <span class="w-7 h-7 rounded-full {{ $index < 3 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-600' }} inline-flex items-center justify-center text-sm font-bold">{{ $index + 1 }}</span>
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ number_format($product->total_qty) }}</td>
                        <td class="px-4 py-3 text-emerald-600 font-bold">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden max-w-[100px]">
                                    <div class="h-full bg-emerald-400 rounded-full" style="width: {{ $periodData['revenue'] > 0 ? ($product->total_revenue / $periodData['revenue']) * 100 : 0 }}%"></div>
                                </div>
                                <span class="text-sm text-slate-600">{{ $periodData['revenue'] > 0 ? number_format(($product->total_revenue / $periodData['revenue']) * 100, 1) : 0 }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-3xl mb-4">📋</div>
            <p class="text-slate-500">Belum ada data penjualan</p>
        </div>
        @endif
    </div>
    @endif

    <!-- All Time Summary -->
    @if (config('features.ringkasan_all_time'))
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 text-white">
        <h2 class="text-xl font-bold mb-6">Ringkasan Sepanjang Masa</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                <p class="text-slate-300 text-sm mb-1">Total Pendapatan</p>
                <p class="text-2xl font-bold text-emerald-400">Rp {{ number_format($totalAllTimeRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                <p class="text-slate-300 text-sm mb-1">Total Pengeluaran</p>
                <p class="text-2xl font-bold text-red-400">Rp {{ number_format($totalAllTimeExpenses, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl p-5">
                <p class="text-slate-300 text-sm mb-1">Total Profit</p>
                <p class="text-2xl font-bold {{ $totalAllTimeProfit >= 0 ? 'text-emerald-400' : 'text-red-400' }}">Rp {{ number_format($totalAllTimeProfit, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function togglePeriodInputs() {
    const period = document.getElementById('periodSelect').value;
    const monthSelect = document.getElementById('monthSelect');
    if (period === 'yearly') {
        monthSelect.style.display = 'none';
    } else {
        monthSelect.style.display = 'block';
    }
}
// Initialize on page load
document.addEventListener('DOMContentLoaded', togglePeriodInputs);
</script>
@endpush
