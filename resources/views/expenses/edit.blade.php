@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4">
  <div class="max-w-md w-full space-y-8">
    <div class="text-center">
      {{-- Hero image — drop your own SVG/PNG at public/images/edit_expense.svg --}}
      <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
        Edit Expense
      </h2>
      <p class="mt-2 text-sm text-gray-600">
        Make any changes below and save.
      </p>
    </div>

    <div class="bg-white py-8 px-6 shadow-lg rounded-lg sm:px-10">
      <form class="space-y-6" action="{{ route('expenses.update', $expense) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
          <select id="category_id" name="category_id"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                         focus:ring-sky-500 focus:border-sky-500">
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}"
                {{ $cat->id == old('category_id', $expense->category_id) ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input id="amount" name="amount" type="number" step="0.01"
                 value="{{ old('amount', $expense->amount) }}" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                        focus:ring-sky-500 focus:border-sky-500">
          @error('amount')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
          <input id="note" name="note" type="text"
                 value="{{ old('note', $expense->note) }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                        focus:ring-sky-500 focus:border-sky-500">
          @error('note')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="spent_at" class="block text-sm font-medium text-gray-700">Date</label>
          <input id="spent_at" name="spent_at" type="date"
                 value="{{ old('spent_at', $expense->spent_at->format('Y-m-d')) }}" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                        focus:ring-sky-500 focus:border-sky-500">
          @error('spent_at')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex items-center justify-between">
          <a href="{{ route('expenses.index') }}"
             class="text-sm text-gray-600 hover:text-gray-900">
            Cancel
          </a>
          <button type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                         text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
            Update Expense
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
