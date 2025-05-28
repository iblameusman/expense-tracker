@extends('layouts.app')

@section('header')
  <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Add Category</h2>
@endsection

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 border border-gray-200 dark:border-gray-700 max-w-md mx-auto">
    @if(session('success'))
      <x-toast :message="session('success')" />
    @endif

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input type="text" name="name" value="{{ old('name') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm
                      focus:ring-sky-500 focus:border-sky-500">
        @error('name')
          <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
              class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-3 rounded-lg transition">
        Save Category
      </button>
    </form>
  </div>
@endsection
