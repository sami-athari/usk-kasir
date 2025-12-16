<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
// ==========================================
// 1. ZONA PUBLIK (Bisa diakses tanpa login)
// ==========================================

// Aplikasi POS: saat web dibuka, langsung ke login.
// Jika sudah login, redirect sesuai role.
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $role = Auth::user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('order.index');
})->name('home');

// Breeze-compatible dashboard route (used by auth scaffolding/tests).
Route::middleware('auth')->get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('order.index');
})->name('dashboard');


// ==========================================
// 2. ZONA MEMBER / USER (Harus Login & Role = user)
// ==========================================
Route::middleware(['auth', 'role:user'])->group(function () {
    // Halaman POS (Kasir)
    Route::get('/pos', [OrderController::class, 'index'])->name('order.index');

    // Halaman Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    // Proses Order
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // Halaman Struk
    Route::get('/struk/{id}', [OrderController::class, 'show'])->name('order.show');

    // Riwayat Pesanan
    Route::get('/riwayat', [OrderController::class, 'history'])->name('order.history');
});

// Profile (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// 3. ZONA ADMIN (Harus Login & Role = admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin: http://127.0.0.1:8000/admin/dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Transaksi (Orders)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');

    // Produk
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Kategori
    Route::resource('categories', CategoryController::class);

    // Pengeluaran
    Route::resource('expenses', ExpenseController::class);

    // Bahan Baku (Ingredients)
    Route::resource('ingredients', IngredientController::class);

    // Laporan Keuangan
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('/finance/export', [FinanceController::class, 'export'])->name('finance.export');
});


// Route bawaan Breeze (Login/Register/Logout)
require __DIR__ . '/auth.php';
