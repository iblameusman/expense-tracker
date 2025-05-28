<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * These attributes may be mass‐assigned.
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'note',
        'spent_at',
    ];
protected $casts = [
        'spent_at' => 'date',  // now $expense->spent_at is a Carbon instance
    ];
    /**
     * Expense belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
