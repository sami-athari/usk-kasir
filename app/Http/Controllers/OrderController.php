<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('is_available', true)->get();
        $categories = Category::orderBy('sort_order')->orderBy('name')->get();
        return view('order.index', compact('products', 'categories'));
    }

    // POS: pembayaran tunai (cash) saja
    public function store(Request $request)
    {
        $request->validate([
            'cart'           => 'required|array',
            'cart.*.id'      => 'exists:products,id',
            'cart.*.qty'     => 'integer|min:1',
            'cash_received'  => 'required|numeric|min:0',
        ]);

        try {
            $order = DB::transaction(function () use ($request) {

                $user = Auth::user(); // Ambil user yang sedang login
                $totalPrice = 0;
                $cartItems = $request->cart;
                $cashReceived = (int) $request->input('cash_received', 0);

                // 1. Cek Stok & Hitung Total
                foreach ($cartItems as $item) {
                    $product = Product::find($item['id']);

                    // Cek apakah produk masih tersedia
                    if (!$product || !$product->is_available) {
                        $productName = $product ? $product->name : 'tidak ditemukan';
                        throw new \Exception("Produk " . $productName . " sudah tidak tersedia!");
                    }

                    // Cek stok produk
                    if ($product->stock < $item['qty']) {
                        $shortage = $item['qty'] - $product->stock;
                        throw new \Exception("Stok " . $product->name . " tidak cukup. Kurang " . $shortage . " pcs.");
                    }
                    $totalPrice += $product->price * $item['qty'];
                }

                if ($cashReceived < $totalPrice) {
                    $short = $totalPrice - $cashReceived;
                    throw new \Exception('Uang yang diberikan kurang. Kurang Rp ' . number_format($short, 0, ',', '.') . '.');
                }

                $changeAmount = $cashReceived - $totalPrice;

                // 2. Generate Antrean
                $today = Carbon::today();
                $lastOrder = Order::whereDate('created_at', $today)->orderBy('id', 'desc')->first();
                $number = $lastOrder ? ((int)substr($lastOrder->queue_number, 2)) + 1 : 1;
                $queueCode = 'A-' . str_pad($number, 3, '0', STR_PAD_LEFT);

                // 3. Simpan Order (PENTING: Pakai user_id)
                $newOrder = Order::create([
                    'user_id'       => $user->id,          // ID User Login
                    'customer_name' => $user->name,        // Nama User Login
                    'queue_number'  => $queueCode,
                    'total_price'   => $totalPrice,
                    'cash_received' => $cashReceived,
                    'change_amount' => $changeAmount,
                    'payment_method' => 'cash', // POS cash only
                    'status'        => 'paid',
                ]);

                // 4. Simpan Item & Kurangi Stok
                foreach ($cartItems as $item) {
                    $product = Product::find($item['id']);
                    $newOrder->items()->create([
                        'product_id' => $product->id,
                        'qty'        => $item['qty'],
                        'price'      => $product->price
                    ]);

                    // Kurangi stok produk
                    $product->decrement('stock', $item['qty']);
                }

                return $newOrder;
            });

            return response()->json([
                'status' => 'success',
                'redirect_url' => route('order.show', $order->id),
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        // Pastikan user cuma bisa lihat order miliknya sendiri (Keamanan)
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('order.success', compact('order'));
    }

    // BARU: Halaman Riwayat Pesanan
    public function history()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.history', compact('orders'));
    }

    public function checkout()
    {
        return redirect()->route('order.index');
    }
}
