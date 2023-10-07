<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use App\Enums\StudentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreNewStudentRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'gender' => ['required', new Enum(GenderEnum::class)],
            'birth_place' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'father_name' => ['required', 'string'],
            'mother_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'school' => ['required', 'string'],
            'join_date' => ['required', 'date'],
            'status' => ['required', new Enum(StudentStatusEnum::class)],
            'ability_level_upon_entry' => ['required', 'string'],
            'birth_certificate' => ['required', 'image', 'mimes:jpg,png'],
        ];
    }
}
