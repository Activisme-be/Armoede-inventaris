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
     * Data relation for all the support requests from the user.
     *
     * @return HasMany
     */
    public function supportRequests(): HasMany
    {
        return $this->hasMany(SupportRequest::class);
    }
}
