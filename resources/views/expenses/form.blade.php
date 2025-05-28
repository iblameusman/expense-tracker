<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ isset($expense) && $expense->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Amount</label>
    <input type="number" step="0.01" name="amount" class="form-control" 
        value="{{ old('amount', $expense->amount ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Note</label>
    <input type="text" name="note" class="form-control" 
        value="{{ old('note', $expense->note ?? '') }}">
</div>

<div class="mb-3">
    <label>Date</label>
    <input type="date" name="spent_at" class="form-control" 
        value="{{ old('spent_at', isset($expense) ? $expense->spent_at->format('Y-m-d') : '') }}" required>
</div>
