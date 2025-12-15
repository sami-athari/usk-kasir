<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('user')->orderBy('expense_date', 'desc');

        // Filter by category
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Filter by date range
        if ($request->start_date) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }

        // Filter by month
        if ($request->month) {
            $query->whereMonth('expense_date', $request->month)
                ->whereYear('expense_date', $request->year ?? now()->year);
        }

        $expenses = $query->paginate(20);
        $categories = Expense::categories();

        // Summary
        $totalExpenses = $query->sum('amount');

        return view('admin.expenses.index', compact('expenses', 'categories', 'totalExpenses'));
    }

    public function create()
    {
        $categories = Expense::categories();
        return view('admin.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Expense::create([
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'notes' => $request->notes,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil dicatat! 💰');
    }

    public function edit(Expense $expense)
    {
        $categories = Expense::categories();
        return view('admin.expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $expense->update([
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil diupdate! ✨');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('admin.expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus! 🗑️');
    }
}
