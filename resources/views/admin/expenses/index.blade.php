@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-light text-slate-800 tracking-tight">Catatan <span class="font-bold">Pengeluaran</span></h1>
            <p class="text-slate-500 mt-2">Catat dan kelola semua pengeluaran bisnis Anda.</p>
        </div>
        <a href="{{ route('admin.expenses.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40 hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Catat Pengeluaran
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm mb-8">
        <form action="{{ route('admin.expenses.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.expenses.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-medium transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Total Card -->
    <div class="relative group mb-8 max-w-md">
        <div class="absolute inset-0 bg-red-100 rounded-3xl transform translate-x-2 translate-y-2 transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
        <div class="relative bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <p class="text-slate-400 font-medium text-sm uppercase tracking-wider mb-1">Total Pengeluaran</p>
            <h3 class="text-3xl font-bold text-red-500">Rp {{ number_format($expenses->sum('amount'), 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
            <thead>
                <tr class="border-b border-slate-100 dark:border-slate-700">
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Kategori</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Deskripsi</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Jumlah</th>
                    <th class="text-right px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($expenses as $expense)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="text-slate-600 dark:text-slate-300">{{ $expense->expense_date->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-200">
                            {{ $categories[$expense->category] ?? $expense->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-slate-800 dark:text-white">{{ $expense->description }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-red-500">Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="text-slate-400 hover:text-emerald-500 transition-colors" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Hapus pengeluaran ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-4xl mb-6">💸</div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Pengeluaran</h3>
                            <p class="text-slate-500 mb-6">Mulai catat pengeluaran bisnis Anda.</p>
                            <a href="{{ route('admin.expenses.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Catat Pengeluaran Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">{{ $expenses->links() }}</div>
</div>
@endsection
