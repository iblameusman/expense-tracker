<!DOCTYPE html>
<html>
<head>
    <title>Expense Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Expense Report</h2>
    <p>User: {{ auth()->user()->name }}</p>
    <p>Period: {{ $from }} to {{ $to }}</p>
    <p><strong>Total Expenses: ${{ number_format($total, 2) }}</strong></p>


    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Note</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->spent_at }}</td>
                    <td>{{ $expense->category->name }}</td>
                    <td>{{ $expense->note }}</td>
                    <td>{{ number_format($expense->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
