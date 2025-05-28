@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Expense Details</h2>

    <div class="card p-4 mb-3">
        <p><strong>Date:</strong> {{ $expense->spent_at }}</p>
        <p><strong>Category:</strong> {{ $expense->category->name }}</p>
        <p><strong>Note:</strong> {{ $expense->note }}</p>
        <p><strong>Amount:</strong> ${{ number_format($expense->amount, 2) }}</p>
    </div>

    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
