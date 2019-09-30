<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ItemFormRequest
 *
 * @package App\Http\Requests\Inventory
 */
class ItemFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'opslag_locatie' => ['required', 'string', 'max:255'],
            'categorie'      => ['required', 'integer'],
            'naam'           => ['required', 'string', 'max:255', 'items:unique'],
            'aantal'         => ['required', 'integer']
        ];
    }
}
