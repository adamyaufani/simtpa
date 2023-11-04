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
            'nspq_number' => ['nullable', 'string'],
            // 'supervisory_institution_name' => ['required', 'string'],
            'years_of_establishment' => ['required', 'string'],

            #Lokasi Lembaga
            'address' => ['required', 'string'],
            // 'rt' => ['required', 'string'],
            // 'rw' => ['required', 'string'],
            'village' => ['required', 'numeric', 'exists:villages,id'],
            // 'subdistrict' => ['required', 'string'],
            // 'regency' => ['required', 'string'],
            // 'province' => ['required', 'string'],
            'postal_code' => ['nullable', 'string'],
            'phone_number' => ['required', 'string','min:11','regex:/^628\d{8,}$/'],
            'social_media' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
            'tiktok' => ['nullable', 'string'],
            'website' => ['nullable', 'string'],
            'gmap_address' => ['nullable', 'string'],

            #Dokumen Izin
            // 'sk_number' => ['required', 'string'],
            // 'sk_number_starting_date' => ['required', 'string'],
            // 'sk_number_ending_date' => ['required', 'string'],
            // 'sk_file' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Format penulisan email salah',
            'address.required' => 'Alamat wajib diisi',
            'phone.required' => 'Telepon wajib diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'phone.min' => 'Nomor telepon terlalu pendek',
            'phone.regex' => 'Format nomor telepon tidak sesuai contoh, yang benar: 6285625674567',
            'institution_name.required' => 'Nama TPA wajib diisi',
            'village.required' => 'Kalurahan wajib diisi',            
        ];
    }
}
