@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="mb-10">
        <a href="{{ route('admin.ingredients.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Gudang
        </a>
        <h1 class="text-4xl font-light text-slate-800 tracking-tight">Tambah <span class="font-bold">Bahan Baku</span></h1>
        <p class="text-slate-500 mt-2">Masukkan data stok bahan baru ke gudang.</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <form action="{{ route('admin.ingredients.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Bahan -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Bahan</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Misal: Susu UHT" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Stok & Satuan -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Stok</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" placeholder="1000" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                        @error('stock')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Satuan</label>
                        <select name="unit" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                            <option value="ml" {{ old('unit') == 'ml' ? 'selected' : '' }}>Mililiter (ml)</option>
                            <option value="gram" {{ old('unit') == 'gram' ? 'selected' : '' }}>Gram (gr)</option>
                            <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pcs (Buah)</option>
                        </select>
                    </div>
                </div>

                <!-- Harga Beli -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Beli per Satuan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                        <input type="number" name="cost_per_unit" value="{{ old('cost_per_unit') }}" placeholder="Misal: 20" required
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    </div>
                    <p class="mt-2 text-sm text-slate-400">Contoh: Jika harga susu 1 Liter = Rp 20.000, maka harga per ml = 20.</p>
                    @error('cost_per_unit')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-200">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Bahan
                    </button>
                    <a href="{{ route('admin.ingredients.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
