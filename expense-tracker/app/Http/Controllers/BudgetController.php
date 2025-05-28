<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Category;

class BudgetController extends Controller
{
    
    public function __construct()
    {
        // Applies your CategoryPolicy to all resource methods
        $this->middleware('auth');
        $this->authorizeResource(Category::class, 'budget');
    }  
    /**
     * Display a listing of budgets.
     */
    public function index()
    {
        $budgets = Budget::with('category')
            ->where('user_id', auth()->id())
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('budgets.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new budget.
     */
    public function create()
    {
        $userId = auth()->id();

        // Get the categories for the dropdown
        $categories = Category::where('user_id', $userId)->get();

        // Paginate existing budgets (for chart / stats)
        $budgets = Budget::with('category')
            ->where('user_id', $userId)
            ->orderByDesc('start_date')
            ->paginate(10);

        // Compute spent amounts for each budget on the current page
        $spentAmounts = collect($budgets->items())->map(function($budget) use ($userId) {
            return Expense::where('user_id', $userId)
                ->where('category_id', $budget->category_id)
                ->whereBetween('spent_at', [$budget->start_date, $budget->end_date])
                ->sum('amount');
        });

        return view('budgets.create', compact('categories','budgets','spentAmounts'));
    }

    /**
     * Store a newly created budget in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'amount'      => 'required|numeric|min:0.01',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'period'      => 'required|in:weekly,monthly,custom',
    ]);

    Budget::create([
        'user_id'     => auth()->id(),
        'category_id' => $request->category_id,
        'amount'      => $request->amount,
        'start_date'  => $request->start_date,
        'end_date'    => $request->end_date,
        'period'      => $request->period,
    ]);

    return redirect()
        ->route('budgets.index')
        ->with('success', 'Budget created successfully!');
}


    /**
     * Display the specified budget.
     */
    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        return view('budgets.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified budget.
     */
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);

        $categories = Category::where('user_id', auth()->id())->get();

        return view('budgets.edit', compact('budget', 'categories'));
    }

    /**
     * Update the specified budget in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0.01',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $budget->update($request->only([
            'category_id',
            'amount',
            'start_date',
            'end_date',
        ]));

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget updated successfully!');
    }

    /**
     * Remove the specified budget from storage.
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->delete();

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Budget deleted successfully!');
    }
}
