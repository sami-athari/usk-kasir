@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="mb-10">
        <a href="{{ route('admin.expenses.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Pengeluaran
        </a>
        <h1 class="text-4xl font-light text-slate-800 tracking-tight">Edit <span class="font-bold">Pengeluaran</span></h1>
        <p class="text-slate-500 mt-2">Ubah data pengeluaran bisnis Anda.</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <form action="{{ route('admin.expenses.update', $expense->id) }}" method="POST" x-data="{ category: '{{ old('category', $expense->category) }}' }" class="space-y-6">
                @csrf @method('PUT')

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Pengeluaran</label>
                    <select name="category" x-model="category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $expense->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <input type="text" name="description" value="{{ old('description', $expense->description) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('description')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Jumlah & Tanggal -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                            <input type="number" name="amount" value="{{ old('amount', $expense->amount) }}" required
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                        </div>
                        @error('amount')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                        <input type="date" name="expense_date" value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                        @error('expense_date')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Ingredient Purchase Details -->
                <div x-show="category === 'ingredient_purchase'" x-transition class="bg-amber-50 rounded-2xl p-6 border border-amber-200">
                    <p class="text-sm font-bold text-amber-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Detail Pembelian Bahan Baku
                    </p>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-amber-700 mb-2">Pilih Bahan Baku</label>
                            <select name="ingredient_id" class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none bg-white">
                                <option value="">-- Pilih Bahan --</option>
                                @foreach($ingredients as $ing)
                                <option value="{{ $ing->id }}" {{ old('ingredient_id', $expense->ingredient_id) == $ing->id ? 'selected' : '' }}>{{ $ing->name }} (Stok: {{ number_format($ing->stock) }} {{ $ing->unit }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-amber-700 mb-2">Jumlah Beli</label>
                                <input type="number" name="quantity" value="{{ old('quantity', $expense->quantity) }}" step="0.01"
                                    class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-amber-700 mb-2">Satuan</label>
                                <select name="unit" class="w-full px-4 py-3 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all outline-none bg-white">
                                    <option value="ml" {{ old('unit', $expense->unit) == 'ml' ? 'selected' : '' }}>Mililiter (ml)</option>
                                    <option value="gram" {{ old('unit', $expense->unit) == 'gram' ? 'selected' : '' }}>Gram (gr)</option>
                                    <option value="pcs" {{ old('unit', $expense->unit) == 'pcs' ? 'selected' : '' }}>Pcs (Buah)</option>
                                    <option value="liter" {{ old('unit', $expense->unit) == 'liter' ? 'selected' : '' }}>Liter</option>
                                    <option value="kg" {{ old('unit', $expense->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplier -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Supplier / Vendor (Opsional)</label>
                    <input type="text" name="supplier" value="{{ old('supplier', $expense->supplier) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="notes" rows="2"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none resize-none">{{ old('notes', $expense->notes) }}</textarea>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-200">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Pengeluaran
                    </button>
                    <a href="{{ route('admin.expenses.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
