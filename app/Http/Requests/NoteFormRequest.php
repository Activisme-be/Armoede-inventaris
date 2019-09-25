<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NoteFormRequest
 *
 * @package App\Http\Requests
 */
class NoteFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'titel'     => ['required', 'string', 'max:255'],
            'is_public' => ['required', 'boolean'],
            'notitie'   => ['required', 'string'],
        ];
    }
}
