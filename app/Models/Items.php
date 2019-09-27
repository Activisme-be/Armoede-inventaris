<?php

namespace App\Models;

use App\Models\Relations\Creatorable;
use Illuminate\Database\Eloquent\Model;

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
}
