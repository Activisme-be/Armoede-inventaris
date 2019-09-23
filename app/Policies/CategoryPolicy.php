<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CategoryPolicy
 *
 * @package App\Policies
 */
class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the category.
     *
     * @param  User      $user      The entity from the currently authenticated user.
     * @param  Category  $category  The entity from the given category.
     * @return bool
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) || $user->is($category->creator);
    }
}
