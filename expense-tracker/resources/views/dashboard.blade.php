@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- Hero Header --}}
    <header class="mb-12">
      <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Hello, {{ Auth::user()->name }}!</h1>
      <p class="text-lg text-gray-700">Welcome back—here’s the latest on your spending.</p>
    </header>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
      <div class="bg-white rounded-2xl shadow p-8 border border-gray-200">
        <span class="text-sm font-medium text-gray-500 uppercase">Total Spent</span>
        <p class="mt-4 text-3xl font-bold text-gray-900">${{ number_format($totalSpent,2) }}</p>
      </div>
      <div class="bg-white rounded-2xl shadow p-8 border border-gray-200">
        <span class="text-sm font-medium text-gray-500 uppercase">Total Budget</span>
        <p class="mt-4 text-3xl font-bold text-gray-900">${{ number_format($budgetLimit,2) }}</p>
      </div>
      <div class="bg-white rounded-2xl shadow p-8 border border-gray-200">
        <span class="text-sm font-medium text-gray-500 uppercase">Remaining</span>
        <p class="mt-4 text-3xl font-bold {{ $remaining < 0 ? 'text-rose-500' : 'text-emerald-500' }}">
          ${{ number_format($remaining,2) }}
        </p>
      </div>
    </div>

    {{-- Date Filter --}}
    <section class="bg-white rounded-2xl shadow border border-gray-200 p-8 mb-12">
      <h2 class="text-xl font-semibold text-gray-800 mb-6">Filter by Date</h2>
      <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">From</label>
          <input type="date" name="from" value="{{ $from }}"
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                        focus:ring-sky-500 focus:border-sky-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">To</label>
          <input type="date" name="to" value="{{ $to }}"
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                        focus:ring-sky-500 focus:border-sky-500">
        </div>
        <div class="flex items-end">
          <button type="submit"
                  class="w-full bg-sky-500 text-white font-medium py-3 rounded-lg 
                         hover:bg-sky-600 transition">
            Apply Filter
          </button>
        </div>
      </form>
    </section>

    {{-- Chart & Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-white rounded-2xl shadow border border-gray-200 p-8">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Expenses by Category</h3>
        <canvas id="expenseChart" class="w-full h-64"></canvas>
      </div>
      <div class="flex flex-col space-y-4">
        <a href="{{ route('expenses.create') }}"
           class="block bg-sky-500 text-white font-medium py-3 rounded-lg text-center 
                  hover:bg-sky-600 transition">
          + Add Expense
        </a>
        <a href="{{ route('reports.pdf', ['from'=>$from,'to'=>$to]) }}"
           class="block bg-rose-500 text-white font-medium py-3 rounded-lg text-center 
                  hover:bg-rose-600 transition">
          Export PDF
        </a>
        <a href="{{ route('reports.excel', ['from'=>$from,'to'=>$to]) }}"
           class="block bg-emerald-500 text-white font-medium py-3 rounded-lg text-center 
                  hover:bg-emerald-600 transition">
          Export Excel
        </a>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  const ctx = document.getElementById('expenseChart');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: @json($labels),
      datasets: [{
        data: @json($data),
        backgroundColor: [
          '#38BDF8', // sky-400
          '#34D399', // emerald-400
          '#FCD34D', // amber-300
          '#F87171', // rose-400
          '#A78BFA'  // violet-400
        ],
        borderColor: '#ffffff',
        borderWidth: 2
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
            color: '#374151' // gray-700
          }
        }
      }
    }
  });
</script>
@endpush
