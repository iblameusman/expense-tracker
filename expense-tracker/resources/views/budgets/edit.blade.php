{{-- resources/views/budgets/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
  <div class="max-w-4xl mx-auto px-4 py-8 space-y-8">

    {{-- Header --}}
    <header class="space-y-1">
      <h2 class="text-3xl font-extrabold text-gray-900">Edit Budget</h2>
      <p class="text-gray-600">Update the details of your budget below.</p>
    </header>

    {{-- Validation Errors --}}
    @if ($errors->any())
      <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4">
        <ul class="list-disc pl-5 text-red-700">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Edit Form --}}
    <div class="bg-white shadow rounded-lg border border-gray-200 p-6">
      <form method="POST" action="{{ route('budgets.update', $budget) }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        {{-- Period --}}
        <div>
          <label for="period" class="block text-sm font-medium text-gray-700">Period</label>
          <select name="period" id="period" required
                  class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500">
            <option value="">Choose…</option>
            <option value="weekly"  {{ old('period', $budget->period) == 'weekly'  ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ old('period', $budget->period) == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="custom"  {{ old('period', $budget->period) == 'custom'  ? 'selected' : '' }}>Custom</option>
          </select>
          @error('period')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Category --}}
        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id" id="category_id" required
                  class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500">
            <option value="">Select…</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                      {{ old('category_id', $budget->category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Amount --}}
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" name="amount" id="amount" step="0.01" required
                 class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500"
                 value="{{ old('amount', $budget->amount) }}">
          @error('amount')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Start Date --}}
        <div>
          <label for="start_date" class="block text-sm font-medium text-gray-700">From</label>
          <input type="date" name="start_date" id="start_date" required
                 class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500"
                 value="{{ old('start_date', \Carbon\Carbon::parse($budget->start_date)->toDateString()) }}">
          @error('start_date')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- End Date --}}
        <div>
          <label for="end_date" class="block text-sm font-medium text-gray-700">To</label>
          <input type="date" name="end_date" id="end_date" required
                 class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500"
                 value="{{ old('end_date', \Carbon\Carbon::parse($budget->end_date)->toDateString()) }}">
          @error('end_date')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Buttons --}}
        <div class="sm:col-span-2 flex justify-between items-center mt-4">
          <a href="{{ route('budgets.index') }}"
             class="inline-block text-gray-700 hover:underline">
            ← Cancel
          </a>
          <button type="submit"
                  class="bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-6 rounded-lg transition">
            Save Changes
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
