<?php
// app/Policies/ExpensePolicy.php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;  // you can list your own expenses
    }

    public function view(User $user, Expense $expense): bool
    {
        return $user->id === $expense->user_id;
    }

    public function create(User $user): bool
    {
        return true;  // any authenticated user can add
    }

    public function update(User $user, Expense $expense): bool
    {
        return $user->id === $expense->user_id;
    }

    public function delete(User $user, Expense $expense): bool
    {
        return $user->id === $expense->user_id;
    }
}
