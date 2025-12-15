<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    // 1. Tampilkan Daftar Bahan
    public function index()
    {
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        return view('admin.ingredients.index', compact('ingredients'));
    }

    // 2. Form Tambah Bahan
    public function create()
    {
        return view('admin.ingredients.create');
    }

    // 2b. Detail Bahan (opsional)
    public function show($id)
    {
        return redirect()->route('admin.ingredients.edit', $id);
    }

    // 3. Simpan Bahan Baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:10', // gr, ml, pcs
            'cost_per_unit' => 'required|integer|min:0', // Harga beli per gram/ml
        ]);

        Ingredient::create($validated);

        return redirect()->route('admin.ingredients.index')->with('success', 'Bahan baku berhasil ditambahkan!');
    }

    // 4. Form Edit Bahan (Update Stok/Harga)
    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    // 5. Simpan Perubahan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'stock' => 'required|integer',
            'unit' => 'required|string',
            'cost_per_unit' => 'required|integer',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($validated);

        return redirect()->route('admin.ingredients.index')->with('success', 'Data bahan baku diperbarui!');
    }

    // 6. Hapus Bahan
    public function destroy($id)
    {
        Ingredient::destroy($id);
        return redirect()->route('admin.ingredients.index')->with('success', 'Bahan baku dihapus!');
    }
}
