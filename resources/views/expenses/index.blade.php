@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
    {{-- Page Header --}}
    <header class="space-y-1">
      <h2 class="text-3xl font-extrabold text-gray-900">Your Expenses</h2>
      <p class="text-gray-600">Manage and review all your spending here.</p>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
      <div class="rounded-lg bg-green-50 border border-green-200 p-4">
        <p class="text-green-700">{{ session('success') }}</p>
      </div>
    @elseif(session('warning'))
      <div class="rounded-lg bg-yellow-50 border border-yellow-200 p-4">
        <p class="text-yellow-700">{{ session('warning') }}</p>
      </div>
    @endif

    {{-- Filter & Add --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4">
      <form method="GET"
            action="{{ route('expenses.index') }}"
            class="bg-white shadow rounded-lg p-6 flex-1 md:flex-none">
        <h3 class="text-lg font-medium text-gray-700 mb-4">Filter by Date</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label for="from" class="block text-sm font-medium text-gray-600">From</label>
            <input type="date" name="from" id="from"
                   value="{{ request('from', now()->startOfMonth()->toDateString()) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500">
          </div>
          <div>
            <label for="to" class="block text-sm font-medium text-gray-600">To</label>
            <input type="date" name="to" id="to"
                   value="{{ request('to', now()->endOfMonth()->toDateString()) }}"
                   class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500">
          </div>
          <div class="flex items-end">
            <button type="submit"
                    class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 rounded-lg transition">
              Apply Filter
            </button>
          </div>
        </div>
      </form>

      <a href="{{ route('expenses.create') }}"
         class="inline-block bg-sky-600 hover:bg-sky-700 text-white text-center font-medium py-2 px-6 rounded-lg shadow transition">
        + Add Expense
      </a>
    </div>

    {{-- No Data --}}
    @if($expenses->isEmpty())
      <div class="rounded-lg bg-blue-50 border border-blue-200 p-6 text-center">
        <p class="text-blue-700">No expenses found for the selected date range.</p>
      </div>
    @else
      {{-- Expenses Table --}}
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Category
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Note
              </th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Amount
              </th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($expenses as $expense)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ \Carbon\Carbon::parse($expense->spent_at)->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ $expense->category->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ $expense->note }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-right text-gray-900">
                  ${{ number_format($expense->amount, 2) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
                  <a href="{{ route('expenses.edit', $expense) }}"
                     class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md transition">
                    Edit
                  </a>
                  <form method="POST"
                        action="{{ route('expenses.destroy', $expense) }}"
                        class="inline-block"
                        onsubmit="return confirm('Delete this expense?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md transition">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    @endif
  </div>
</div>
@endsection
