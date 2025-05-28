{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('header')
  <h2 class="text-3xl font-extrabold text-gray-900">Your Categories</h2>
  <p class="mt-1 text-gray-600">Manage your spending categories below.</p>
@endsection

@section('content')
<div class="min-h-screen bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    {{-- Top Bar --}}
    <div class="flex items-center justify-between">
      <h3 class="text-2xl font-semibold text-gray-800">All Categories</h3>
      <a href="{{ route('categories.create') }}"
         class="inline-flex items-center bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-4 rounded-lg shadow transition">
        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Category
      </a>
    </div>

    {{-- Card Container --}}
    <div class="bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
      <table class="w-full table-auto">
        <thead class="bg-gray-50">
          <tr class="text-gray-500 uppercase text-xs">
            <th class="px-6 py-3 text-left">Name</th>
            <th class="px-6 py-3 text-left">Created</th>
            <th class="px-6 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @foreach($categories as $cat)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">{{ $cat->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $cat->created_at->format('M d, Y') }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right space-x-4">
                <a href="{{ route('categories.show', $cat) }}"
                   class="text-sky-600 hover:text-sky-800 transition">View</a>
                <a href="{{ route('categories.edit', $cat) }}"
                   class="text-yellow-500 hover:text-yellow-700 transition">Edit</a>
                <form action="{{ route('categories.destroy', $cat) }}"
                      method="POST" onsubmit="return confirm('Delete this category?')"
                      class="inline-block">
                  @csrf @method('DELETE')
                  <button type="submit"
                          class="text-rose-600 hover:text-rose-800 transition">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="px-6 py-4 bg-white flex justify-end">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
