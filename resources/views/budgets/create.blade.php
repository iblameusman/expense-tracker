{{-- resources/views/budgets/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 white:bg-gray-900">
  <div class="max-w-3xl mx-auto px-4 py-12 space-y-8">
    {{-- Header --}}
    <header class="space-y-1">
      <h1 class="text-3xl font-extrabold text-gray-900 white:text-white">Add New Budget</h1>
      <p class="text-gray-600 white:text-gray-400">Define your budget period, category, and amount.</p>
    </header>

    {{-- Validation Errors --}}
    @if($errors->any())
      <div class="rounded-lg bg-red-50 border border-red-200 p-4">
        <ul class="list-disc pl-5 text-red-700 space-y-1">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Card --}}
    <div class="bg-white white:bg-gray-800 rounded-2xl shadow p-8">
      <form method="POST" action="{{ route('budgets.store') }}" class="grid grid-cols-1 gap-6">
        @csrf

        {{-- 1. Period --}}
        <div>
          <label for="period" class="block text-sm font-medium text-gray-700 white:text-gray-300">Select a period</label>
          <select name="period" id="period" required
                  class="mt-1 block w-full rounded-lg border-gray-300 white:border-gray-600 white:bg-gray-700 white:text-white focus:ring-sky-500 focus:border-sky-500">
            <option value="">Choose…</option>
            <option value="weekly"   {{ old('period')=='weekly'   ? 'selected':'' }}>Weekly</option>
            <option value="monthly"  {{ old('period')=='monthly'  ? 'selected':'' }}>Monthly</option>
            <option value="quarterly"{{ old('period')=='quarterly'? 'selected':'' }}>Quarterly</option>
            <option value="yearly"   {{ old('period')=='yearly'   ? 'selected':'' }}>Yearly</option>
            <option value="custom"   {{ old('period')=='custom'   ? 'selected':'' }}>Custom</option>
          </select>
          <p class="mt-1 text-sm text-gray-500 white:text-gray-400">
            Choose a time frame (e.g. Monthly, Quarterly, Yearly, or Custom).
          </p>
        </div>

        {{-- 2. Category --}}
        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700 white:text-gray-300">Pick a category</label>
          <select name="category_id" id="category_id" required
                  class="mt-1 block w-full rounded-lg border-gray-300 white:border-gray-600 white:bg-gray-700 white:text-white focus:ring-sky-500 focus:border-sky-500">
            <option value="">Select…</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected':'' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          <p class="mt-1 text-sm text-gray-500 white:text-gray-400">
            Select the budget category you’re planning for.
          </p>
        </div>

        {{-- 3. Amount --}}
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700 white:text-gray-300">Enter the amount</label>
          <input type="number" name="amount" id="amount" step="0.01" required
                 class="mt-1 block w-full rounded-lg border-gray-300 white:border-gray-600 white:bg-gray-700 white:text-white focus:ring-sky-500 focus:border-sky-500"
                 value="{{ old('amount') }}">
          <p class="mt-1 text-sm text-gray-500 white:text-gray-400">
            Type in the amount you need for that period.
          </p>
        </div>

        {{-- 4. From / To --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 white:text-gray-300">From</label>
            <input type="date" name="start_date" id="start_date" required
                   class="mt-1 block w-full rounded-lg border-gray-300 white:border-gray-600 white:bg-gray-700 white:text-white focus:ring-sky-500 focus:border-sky-500"
                   value="{{ old('start_date') }}">
          </div>
          <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 white:text-gray-300">To</label>
            <input type="date" name="end_date" id="end_date" required
                   class="mt-1 block w-full rounded-lg border-gray-300 white:border-gray-600 white:bg-gray-700 white:text-white focus:ring-sky-500 focus:border-sky-500"
                   value="{{ old('end_date') }}">
          </div>
        </div>

        {{-- 5. Save --}}
        <div class="text-right">
          <button type="submit"
                  class="inline-flex items-center bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-6 rounded-lg shadow transition">
            Save Budget
          </button>
          <p class="mt-2 text-sm text-gray-500 white:text-gray-400">
            Click “Save Budget” to store your entry.
          </p>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
