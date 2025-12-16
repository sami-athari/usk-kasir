<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->orderByDesc('created_at');

        $preset = (string) $request->query('preset', '');
        $date = (string) $request->query('date', '');
        $startDate = (string) $request->query('start_date', '');
        $endDate = (string) $request->query('end_date', '');

        $start = null;
        $end = null;

        try {
            if ($startDate !== '' || $endDate !== '') {
                $start = $startDate !== ''
                    ? Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay()
                    : null;
                $end = $endDate !== ''
                    ? Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay()
                    : null;
            } elseif ($date !== '') {
                $start = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
                $end = Carbon::createFromFormat('Y-m-d', $date)->endOfDay();
            } elseif ($preset !== '') {
                $today = now();
                if ($preset === 'today') {
                    $start = $today->copy()->startOfDay();
                    $end = $today->copy()->endOfDay();
                } elseif ($preset === 'yesterday') {
                    $start = $today->copy()->subDay()->startOfDay();
                    $end = $today->copy()->subDay()->endOfDay();
                } elseif ($preset === 'last_7_days') {
                    $start = $today->copy()->subDays(6)->startOfDay();
                    $end = $today->copy()->endOfDay();
                } elseif ($preset === 'this_month') {
                    $start = $today->copy()->startOfMonth()->startOfDay();
                    $end = $today->copy()->endOfDay();
                }
            }
        } catch (\Throwable $e) {
            $start = null;
            $end = null;
        }

        if ($start && $end && $end->lessThan($start)) {
            [$start, $end] = [$end->copy()->startOfDay(), $start->copy()->endOfDay()];
        }

        if ($start) {
            $query->where('created_at', '>=', $start);
        }

        if ($end) {
            $query->where('created_at', '<=', $end);
        }

        $orders = $query->paginate(30)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }
}
