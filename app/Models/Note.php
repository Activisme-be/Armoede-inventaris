<?php

namespace App\Models;

use App\Models\Relations\Creatorable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Note
 *
 * @package App\Models
 */
class Note extends Model
{
    use Creatorable;

    /**
     * Guarded fields for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Data relation for the person attached to the note.
     *
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Data relation for the person from the note.
     *
     * @param  Person $person The given resource entity from the given person.
     * @return Note
     */
    public function setPerson(Person $person): self
    {
        $this->person()->associate($person)->save();
        return $this;
    }
}
