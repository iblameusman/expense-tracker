<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Expense;
use App\Models\Budget;
use App\Models\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Wire up policy checks for all resource controllers.
     */
    public function __construct()
    {
        // these three lines must live inside the class—not after it!
        $this->authorizeResource(Expense::class,  'expense');
        $this->authorizeResource(Budget::class,   'budget');
        $this->authorizeResource(Category::class, 'category');
    }
}
