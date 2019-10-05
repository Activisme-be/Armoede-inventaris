<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ItemPolicy
 *
 * @package App\Policies
 */
class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the item.
     *
     * @param  User  $user The entity from the authenticated user.
     * @return bool
     */
    public function edit(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }

    /**
     * Determine whether the user is permitted to delete the inventory item.
     *
     * @param  User $user The entity from the authenticated user.
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'inventory']);
    }
}
