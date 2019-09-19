<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 *
 * @package App\Models
 */
class Note extends Model
{
    /**
     * Guarded fields for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = [];

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
