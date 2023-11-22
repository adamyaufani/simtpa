<?php

namespace App\Http\Requests;

use App\Enums\EmploymentStatusEnum;
use App\Enums\LastFormalEducationEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateStaffRequest extends FormRequest
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
            'gender' => ['required', 'string'],
            'employment_status' => ['required', new Enum(EmploymentStatusEnum::class)],
            'civil_registration_number' => ['required', 'string'],
            'last_formal_education' => ['required', new Enum(LastFormalEducationEnum::class)],
            'length_of_islamic_education' => ['required', 'string'],
            'core_competency' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,png'],
        ];
    }
}
