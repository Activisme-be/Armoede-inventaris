<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryFormRequest
 *
 * @package App\Http\Requests
 */
class CategoryFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return ['naam' => ['required', 'string', 'max:255', 'unique:categories']];
        }

        return ['naam' => ['required', 'string', 'max:255', 'unique:categories,naam,' . $this->category->id]];
    }
}
