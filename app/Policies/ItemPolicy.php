<?php

namespace App\Policies;

use App\Models\Items;
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
     * @param  User  $user      The entity from the authenticated user.
     * @param  Items $items     The entity from the given inventory item.
     * @return bool
     */
    public function edit(User $user, Items $items): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }
}
