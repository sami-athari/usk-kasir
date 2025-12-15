@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-light text-slate-800 tracking-tight">Gudang <span class="font-bold">Bahan Baku</span></h1>
            <p class="text-slate-500 mt-2">Kelola stok bahan baku untuk produksi menu.</p>
        </div>
        <a href="{{ route('admin.ingredients.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40 hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Bahan
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

    <!-- Table Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Nama Bahan</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Total Stok</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Satuan</th>
                    <th class="text-left px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Harga Beli (HPP)</th>
                    <th class="text-right px-6 py-4 text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ingredients as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <span class="font-medium text-slate-800">{{ $item->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-slate-800">{{ number_format($item->stock) }}</span>
                        @if($item->stock < 500)
                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                            ⚠️ Stok Rendah
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ $item->unit }}</td>
                    <td class="px-6 py-4">
                        <span class="text-slate-600">Rp {{ number_format($item->cost_per_unit, 0, ',', '.') }}</span>
                        <span class="text-slate-400">/ {{ $item->unit }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.ingredients.edit', $item->id) }}" class="text-slate-400 hover:text-emerald-500 transition-colors" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.ingredients.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus bahan {{ $item->name }}?');">
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
                            <div class="w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center text-4xl mb-6">📦</div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Bahan Baku</h3>
                            <p class="text-slate-500 mb-6">Mulai tambahkan bahan baku untuk gudang Anda.</p>
                            <a href="{{ route('admin.ingredients.create') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Bahan Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
