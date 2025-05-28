<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Budget;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpensesExport;

class ReportController extends Controller
{
    /**
     * Show the dashboard / report overview.
     */
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to',   now()->endOfMonth()->toDateString());

        // Summed expenses per category
        $expenses = Expense::where('user_id', auth()->id())
            ->whereBetween('spent_at', [$from, $to])
            ->selectRaw('SUM(amount) as total, category_id')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $labels     = $expenses->pluck('category.name');
        $data       = $expenses->pluck('total');
        $totalSpent = Expense::where('user_id', auth()->id())
            ->whereBetween('spent_at', [$from, $to])
            ->sum('amount');

        // Total budget in this period
        $budgetLimit = Budget::where('user_id', auth()->id())
            ->where('start_date','<=',$to)
            ->where('end_date','>=',$from)
            ->sum('amount');

        $remaining = $budgetLimit - $totalSpent;

        return view('dashboard', compact(
            'labels','data','from','to',
            'totalSpent','budgetLimit','remaining'
        ));
    }

    /**
     * Export the detailed report to PDF.
     */
    public function exportPdf(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to',   now()->endOfMonth()->toDateString());

        $expenses = Expense::where('user_id', auth()->id())
            ->whereBetween('spent_at', [$from, $to])
            ->with('category')
            ->get();

        $total = $expenses->sum('amount');

        return PDF::loadView('reports.pdf', compact('expenses','from','to','total'))
            ->download("expense-report-{$from}-to-{$to}.pdf");
    }

    /**
     * Export the detailed report to Excel.
     */
    public function exportExcel(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to',   now()->endOfMonth()->toDateString());

        return Excel::download(
            new ExpensesExport($from, $to),
            "expenses-{$from}-to-{$to}.xlsx"
        );
    }
}
