<?php

namespace App\Models;

use App\Models\Relations\Creatorable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Items
 *
 * @package App\Models
 */
class Items extends Model
{
    use Creatorable;

    /**
     * Protected columns for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Function for generating a unique product code for the item.
     *
     * @return int
     */
    public static function generateProductCode(): int
    {
        do {
            $newProductCode = rand(1000, 9999);
        } // Already in the DB? Fail. Try again
        while (self::productCodeExists($newProductCode));

        return $newProductCode;
    }

    /**
     * Checks whether a key exists in the database or not
     *
     * @param  int $productCode THe generated product code that we cant to check for existance.
     * @return bool
     */
    private static function productCodeExists(int $productCode): bool
    {
        $apiKeyCount = self::where('product_code', '=', $productCode)->limit(1)->count();

        if ($apiKeyCount > 0)  {
            return true;
        }

        return false;
    }

    /**
     * Category relation.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }

    /**
     * Determine is the item is low amount on items.
     *
     * @return bool
     */
    public function isLow(): bool
    {
        return $this->aantal < 10;
    }

    /**
     * Determine if the item is normal amount on items.
     *
     * @return bool
     */
    public function isNormal(): bool
    {
        return $this->aantal >= 10 && $this->aantal <= 20;
    }

    /**
     * Determine if the is high amount on items.
     *
     * @return bool
     */
    public function isHigh(): bool
    {
        return $this->aantal > 20;
    }
}
