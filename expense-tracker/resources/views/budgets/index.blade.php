@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white ">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    {{-- Page Title --}}
    <header class="space-y-1">
      <h2 class="text-3xl font-extrabold text-gray-900 white:text-white">Budgets</h2>
      <p class="text-gray-600 dark:text-gray-400">Create, view, and manage your category budgets.</p>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
      <div class="rounded-lg bg-green-50 border border-green-200 p-4">
        <p class="text-green-700">{{ session('success') }}</p>
      </div>
    @endif

    {{-- Add Button --}}
    <div class="flex justify-end">
      <a href="{{ route('budgets.create') }}"
         class="inline-block bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-6 rounded-lg shadow transition">
        + Add Budget
      </a>
    </div>

    @if($budgets->isEmpty())
      <div class="rounded-lg bg-blue-50 border border-blue-200 p-6 text-center">
        <p class="text-blue-700">No budgets defined yet. Click “Add Budget” to get started.</p>
      </div>
    @else
      {{-- Budgets Table --}}
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($budgets as $budget)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ $budget->category->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right text-gray-900">
                  ${{ number_format($budget->amount, 2) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                  {{ \Carbon\Carbon::parse($budget->start_date)->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                  {{ \Carbon\Carbon::parse($budget->end_date)->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                  <a href="{{ route('budgets.edit', $budget) }}"
                     class="inline-block px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition">
                    Edit
                  </a>
                  <form method="POST"
                        action="{{ route('budgets.destroy', $budget) }}"
                        class="inline-block"
                        onsubmit="return confirm('Delete this budget?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md transition">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-4">
        {{ $budgets->links() }}
      </div>
    @endif
  </div>
</div>
@endsection
