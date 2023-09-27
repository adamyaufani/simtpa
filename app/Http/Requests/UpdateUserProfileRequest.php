<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            #Identitas Lembaga
            'institution_name' => ['required', 'string'],
            'nspq_number' => ['required', 'string'],
            'supervisory_institution_name' => ['required', 'string'],
            'years_of_establishment' => ['required', 'string'],

            #Lokasi Lembaga
            'address' => ['required', 'string'],
            'rt' => ['required', 'string'],
            'rw' => ['required', 'string'],
            'district' => ['required', 'string'],
            'subdistrict' => ['required', 'string'],
            'regency' => ['required', 'string'],
            'province' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'social_media' => ['nullable', 'string'],
            'gmap_address' => ['nullable', 'string'],

            #Dokumen Izin
            'sk_number' => ['required', 'string'],
            'sk_number_starting_date' => ['required', 'string'],
            'sk_number_ending_date' => ['required', 'string'],
            'sk_file' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }
}
