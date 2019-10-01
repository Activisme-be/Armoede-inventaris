<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PersonPolicy
 *
 * @package App\Policies
 */
class PersonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the persn.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }
}
