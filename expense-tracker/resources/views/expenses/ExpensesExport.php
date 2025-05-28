namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Expense::with('category')
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($item) {
                return [
                    'Date' => $item->spent_at,
                    'Category' => $item->category->name,
                    'Note' => $item->note,
                    'Amount' => $item->amount,
                ];
            });
    }

    public function headings(): array
    {
        return ['Date', 'Category', 'Note', 'Amount'];
    }
}
