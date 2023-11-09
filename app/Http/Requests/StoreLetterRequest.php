<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'letter_number' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'attachment' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ];
    }
}
