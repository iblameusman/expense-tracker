<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Map your models to their policies here.
     */
    protected $policies = [
        Expense::class  => ExpensePolicy::class,
        Budget::class   => BudgetPolicy::class,
        Category::class => CategoryPolicy::class,    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
