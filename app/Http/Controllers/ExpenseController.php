<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\Budget;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ExpenseController extends Controller
{
        use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Applies your CategoryPolicy to all resource methods
        $this->middleware('auth');
        $this->authorizeResource(Category::class, 'expense');
    }
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to',   now()->endOfMonth()->toDateString());

        $expenses = Expense::with('category')
            ->where('user_id', auth()->id())
            ->whereBetween('spent_at', [$from, $to])
            ->orderByDesc('spent_at')
            ->paginate(10);

        return view('expenses.index', compact('expenses', 'from', 'to'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0.01',
            'note'        => 'nullable|string',
            'spent_at'    => 'required|date',
        ]);

        Expense::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'note'        => $request->note,
            'spent_at'    => $request->spent_at,
        ]);

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense added successfully!');
    }

    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return view('expenses.show', compact('expense'));
    }

 public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        $categories = Category::where('user_id', auth()->id())->get();
        return view('expenses.edit', compact('expense','categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0.01',
            'note'        => 'nullable|string',
            'spent_at'    => 'required|date',
        ]);

        $expense->update($request->only(['category_id','amount','note','spent_at']));

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense updated!');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();
        return redirect()->route('expenses.index')
                         ->with('success', 'Expense deleted!');
    }
}
