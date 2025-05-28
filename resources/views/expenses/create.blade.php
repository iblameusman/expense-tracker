@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
  <div class="max-w-md mx-auto px-4">
    {{-- Card Container --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
      
      {{-- Heading --}}
      <h2 class="text-2xl font-extrabold text-gray-900 mb-6">
        + Add New Expense
      </h2>

      {{-- Toast --}}
      @if(session('success'))
        <x-toast :message="session('success')" />
      @endif

      {{-- Form --}}
      <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
        @csrf

        {{-- Category --}}
        <div>
          <label class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id"
                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                         focus:ring-sky-500 focus:border-sky-500">
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Amount --}}
        <div>
          <label class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" name="amount" step="0.01" value="{{ old('amount') }}"
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                        focus:ring-sky-500 focus:border-sky-500">
          @error('amount')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Note --}}
        <div>
          <label class="block text-sm font-medium text-gray-700">Note</label>
          <input type="text" name="note" value="{{ old('note') }}"
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                        focus:ring-sky-500 focus:border-sky-500">
          @error('note')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Date --}}
        <div>
          <label class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" name="spent_at" value="{{ old('spent_at') }}"
                 class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                        focus:ring-sky-500 focus:border-sky-500">
          @error('spent_at')
            <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-3 rounded-lg transition">
          Save Expense
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
