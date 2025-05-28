{{-- resources/views/reports/index.blade.php --}}
@extends('layouts.app')

@section('header')
  <div class="flex items-center justify-between">
    <h2 class="text-3xl font-bold text-gray-900">
      All Reports
    </h2>
    <a
      href="{{ route('reports.create') }}"
      class="inline-flex items-center px-4 py-2 bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 text-white rounded-lg shadow transition"
    >
      + New Report
    </a>
  </div>
@endsection

@section('content')
  <div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 space-y-6">

      {{-- Card container --}}
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        {{-- Table header --}}
        <div class="px-8 py-4 bg-sky-50 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-sky-700">
            Reports List
          </h3>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-sky-50">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Generated On</th>
                <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
              @forelse($reports as $report)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">
                    {{ $report->title }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ $report->created_at->format('M d, Y') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                    <a href="{{ route('reports.show', $report) }}" class="text-sky-600 hover:underline">View</a>
                    <a href="{{ route('reports.edit', $report) }}" class="text-amber-500 hover:underline">Edit</a>
                    <form
                      action="{{ route('reports.destroy', $report) }}"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this report?');"
                    >
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-rose-600 hover:underline">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                    No reports found.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
@endsection
