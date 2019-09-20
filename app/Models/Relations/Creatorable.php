<?php

namespace App\Models\Relations;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait Creatorable
 *
 * @package App\Models\Relations
 */
trait Creatorable
{
    /**
     * Data relation from the creator entity.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Method for attaching an creator to the database entity.
     *
     * @param  User $user The database entity from the given user.
     * @return self
     */
    public function setCreator(User $user): self
    {
        $this->creator()->associate($user)->save();
        return $this;
    }
}
