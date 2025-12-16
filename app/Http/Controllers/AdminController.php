<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // ====== STATISTIK KEUANGAN ======
        // Harian
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todayOmset = Order::whereDate('created_at', today())->sum('total_price');

        // Bulanan
        $monthOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $monthOmset = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // Tahunan
        $yearOrders = Order::whereYear('created_at', now()->year)->count();
        $yearOmset = Order::whereYear('created_at', now()->year)->sum('total_price');

        // ====== QUICK LIST MENU & KATEGORI ======
        $latestProducts = Product::with('category')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(3)
            ->get();

        // ====== HISTORY PESANAN ======
        // Ambil semua pesanan terbaru (untuk history)
        $orders = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->take(20) // Ambil 20 pesanan terakhir
            ->get();

        return view('admin.dashboard', compact(
            'todayOrders',
            'todayOmset',
            'monthOrders',
            'monthOmset',
            'yearOrders',
            'yearOmset',
            'orders',
            'latestProducts',
            'topCategories'
        ));
    }
}
