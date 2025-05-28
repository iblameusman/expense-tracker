{{-- resources/views/categories/edit.blade.php --}}
@extends('layouts.app')

@section('header')
  <div class="flex items-center justify-between">
    <h2 class="text-3xl font-bold text-gray-900">
      Edit Category
    </h2>
    <a
      href="{{ route('categories.index') }}"
      class="inline-flex items-center px-4 py-2 bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 text-white rounded-lg shadow transition"
    >
      ← Back to All
    </a>
  </div>
@endsection

@section('content')
  {{-- full-screen wrapper with soft gray background and vertical padding --}}
  <div class="min-h-screen bg-gray-50 py-12">

    {{-- center the card and add horizontal padding --}}
    <div class="max-w-3xl mx-auto px-4 space-y-6">

      {{-- Card container --}}
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

        {{-- Card header --}}
        <div class="px-8 py-4 bg-sky-50 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-sky-700">
            Updating “{{ $category->name }}”
          </h3>
        </div>

        {{-- Form body --}}
        <div class="px-8 py-6 space-y-6">
          <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            {{-- Name field --}}
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">
                Category Name
              </label>
              <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $category->name) }}"
                required
                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500 transition"
              />
              @error('name')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Submit / Cancel --}}
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
              <a
                href="{{ route('categories.index') }}"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition"
              >
                Cancel
              </a>
              <button
                type="submit"
                class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition shadow"
              >
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
