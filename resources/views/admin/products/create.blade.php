@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="mb-10">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Menu
        </a>
        <h1 class="text-4xl font-light text-slate-800 tracking-tight">Tambah <span class="font-bold">Menu Baru</span></h1>
        <p class="text-slate-500 mt-2">Isi data menu yang akan dijual di cafe Anda.</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nama Menu -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Menu</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Misal: Kopi Susu Gula Aren" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium">Rp</span>
                            <input type="number" name="price" value="{{ old('price') }}" placeholder="25000" required
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" placeholder="100"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    </div>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Produk</label>
                    <div class="relative">
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-200">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Menu
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
