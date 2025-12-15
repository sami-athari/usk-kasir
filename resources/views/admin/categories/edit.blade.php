@extends('layouts.admin')
@section('content')
<div>
    <!-- Header -->
    <div class="mb-10">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Kategori
        </a>
        <h1 class="text-4xl font-light text-slate-800 tracking-tight">Edit <span class="font-bold">Kategori</span></h1>
        <p class="text-slate-500 mt-2">Ubah data kategori {{ $category->name }}</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Icon -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Icon (Emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="Misal: ☕ 🧊 🍕"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('icon')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Urutan Tampil -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none">
                    @error('sort_order')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-6 border-t border-dashed border-slate-200">
                    <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:shadow-emerald-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
