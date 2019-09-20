<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Person
 *
 * @package App\Models
 */
class Person extends Model
{
    /**
     * Protected fields for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Method for getting the full name of the person.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return "{$this->voornaam} {$this->achternaam}";
    }

    /**
     * Get all the notes for the overview page.
     *
     * @return HasMany
     */
    public function getOverviewNotes(): HasMany
    {
        return $this->notes()->where('is_public', false)->whereCreatorId(auth()->user()->id);
    }

    /**
     * Data relation for the internal notes for the person in the application.
     * ----
     * WARNING: Notes should never be shared with the person. <- For later development.
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Data relation for all the support requests from the user.
     *
     * @return HasMany
     */
    public function supportRequests(): HasMany
    {
        return $this->hasMany(SupportRequest::class);
    }
}
