@extends('layouts.admin')

@section('content')
<div>
    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Semua Transaksi</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Daftar seluruh transaksi kasir.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm p-4 sm:p-6 mb-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
            <div class="md:col-span-3">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Filter cepat</label>
                <select name="preset" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                    <option value="" {{ request('preset') === null || request('preset') === '' ? 'selected' : '' }}>Semua</option>
                    <option value="today" {{ request('preset') === 'today' ? 'selected' : '' }}>Hari ini</option>
                    <option value="yesterday" {{ request('preset') === 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                    <option value="last_7_days" {{ request('preset') === 'last_7_days' ? 'selected' : '' }}>7 hari terakhir</option>
                    <option value="this_month" {{ request('preset') === 'this_month' ? 'selected' : '' }}>Bulan ini</option>
                </select>
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Tanggal (1 hari)</label>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" />
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Dari tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" />
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Sampai tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" />
            </div>

            <div class="md:col-span-12 flex flex-wrap gap-2 justify-end pt-1">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-900 transition-all">
                    Reset
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-emerald-500 text-white text-sm font-semibold hover:bg-emerald-600 transition-all">
                    Terapkan
                </button>
            </div>
        </form>

        @php
            $hasFilter = (request('preset') ?? '') !== '' || (request('date') ?? '') !== '' || (request('start_date') ?? '') !== '' || (request('end_date') ?? '') !== '';
        @endphp
        @if($hasFilter)
            <div class="mt-4 text-xs text-slate-500 dark:text-slate-400">
                Filter aktif:
                @if((request('preset') ?? '') !== '')
                    <span class="font-semibold">{{ request('preset') }}</span>
                @endif
                @if((request('date') ?? '') !== '')
                    <span class="font-semibold">{{ request('date') }}</span>
                @endif
                @if((request('start_date') ?? '') !== '' || (request('end_date') ?? '') !== '')
                    <span class="font-semibold">{{ request('start_date') ?: '...' }} → {{ request('end_date') ?: '...' }}</span>
                @endif
            </div>
        @endif
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-slate-100 dark:border-slate-700">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                <div>Antrean</div>
                <div>Waktu</div>
                <div>Kasir</div>
                <div class="text-right">Total</div>
                <div class="text-right">Aksi</div>
            </div>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-700">
            @forelse($orders as $order)
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-3 items-start">
                    <div>
                        <div class="font-bold text-slate-800 dark:text-white">{{ $order->queue_number }}</div>
                        <div class="mt-1">
                            @php
                                $statusColors = [
                                    'paid' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
                                    'completed' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                    'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                    'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                                ];
                                $statusLabels = [
                                    'paid' => 'Dibayar',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Batal',
                                    'pending' => 'Pending',
                                ];
                            @endphp
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-200' }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="text-sm text-slate-600 dark:text-slate-300">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </div>

                    <div class="text-sm text-slate-700 dark:text-slate-200">
                        <div class="font-semibold">{{ $order->user->name ?? $order->customer_name }}</div>
                        <div class="text-xs text-slate-400 dark:text-slate-500">{{ $order->payment_method === 'cash' ? 'TUNAI' : strtoupper($order->payment_method) }}</div>
                    </div>

                    <div class="text-right">
                        <div class="font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tunai: Rp {{ number_format($order->cash_received ?? 0, 0, ',', '.') }}</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Kembali: Rp {{ number_format($order->change_amount ?? 0, 0, ',', '.') }}</div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-sm font-semibold hover:opacity-90 transition-all">
                            Detail
                        </a>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($order->items as $item)
                    <span class="px-3 py-1 bg-slate-50 dark:bg-slate-900/40 rounded-lg text-sm text-slate-600 dark:text-slate-300 border border-slate-100 dark:border-slate-700">
                        {{ $item->qty }}x {{ $item->product->name ?? 'Produk Dihapus' }}
                    </span>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="p-12 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 dark:bg-slate-700 flex items-center justify-center text-4xl mb-6">🧾</div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">Belum Ada Transaksi</h3>
                <p class="text-slate-500 dark:text-slate-400">Transaksi akan muncul di sini setelah kasir checkout.</p>
            </div>
            @endforelse
        </div>

        @if(method_exists($orders, 'links'))
        <div class="p-4 sm:p-6 border-t border-slate-100 dark:border-slate-700">
            {{ $orders->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
