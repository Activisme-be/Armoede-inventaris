<?php

namespace App\Models;

use App\Models\Relations\Creatorable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package App\Models
 */
class Category extends Model
{
    use Creatorable;

    /**
     * The protected fields for the internal mass-assignment system.
     *
     * @return array
     */
    protected $guarded = [];

    /**
     * Data relation for the inventory items that are attached to the category.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Items::class, 'category_id');
    }
}
