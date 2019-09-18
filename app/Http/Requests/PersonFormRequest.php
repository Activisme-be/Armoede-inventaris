<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonFormRequest
 *
 * @package App\Http\Requests
 */
class PersonFormRequest extends FormRequest
{
    /**
     * Method specific validation rules.
     *
     * @return array
     */
    public function methodSpecificRules(): array
    {
        if ($this->isMethod('PATCH')) {
            return ['email' => ['required', 'string', 'email', 'max:191', 'unique:people,email,'.$this->person->id]];
        }

        return ['email' => ['required', 'string', 'email', 'max:191', 'unique:people']];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'voornaam' => ['required', 'string', 'max:255'],
            'achternaam' => ['required', 'string', 'max:255']
        ] + $this->methodSpecificRules());
    }
}
