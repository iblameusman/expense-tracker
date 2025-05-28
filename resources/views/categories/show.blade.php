{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.app')

@section('header')
  <h2 class="text-3xl font-bold text-gray-900">Category Details</h2>
@endsection

@section('content')
  {{-- page wrapper with soft gray background and vertical padding --}}
  <div class="min-h-screen bg-gray-50 py-12">

    {{-- center card --}}
    <div class="max-w-md mx-auto px-4">
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        
        {{-- optional card header --}}
        <div class="px-8 py-4 bg-sky-50 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-sky-700">
            Details for “{{ $category->name }}”
          </h3>
        </div>

        {{-- card body --}}
        <div class="px-8 py-6 space-y-6">
          <dl class="space-y-4">
            <div>
              <dt class="text-sm font-medium text-gray-500">Name</dt>
              <dd class="mt-1 text-lg text-gray-900">{{ $category->name }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Created At</dt>
              <dd class="mt-1 text-lg text-gray-900">
                {{ $category->created_at->format('M d, Y \a\t h:i A') }}
              </dd>
            </div>
          </dl>

          <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a
              href="{{ route('categories.edit', $category) }}"
              class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg shadow transition"
            >
              Edit
            </a>
            <form
              action="{{ route('categories.destroy', $category) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this category?');"
            >
              @csrf @method('DELETE')
              <button
                type="submit"
                class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-lg shadow transition"
              >
                Delete
              </button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
