<?php

namespace App\Http\Requests;

use App\Enums\EmploymentStatusEnum;
use App\Enums\LastFormalEducationEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreNewStaffRequest extends FormRequest
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
            // 'employment_status' => ['required', new Enum(EmploymentStatusEnum::class)],
            // 'civil_registration_number' => ['required', 'string'],
            'last_formal_education' => ['required', new Enum(LastFormalEducationEnum::class)],
            'length_of_islamic_education' => ['nullable', 'string'],
            'core_competency' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:11','regex:/^628\d{8,}$/'],
            'email' => ['required', 'string','email'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1028'],     
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
            'name.required' => 'Nama wajib diisi',
            'gender.required' => 'Jenis Kelamin wajib diisi',
            'last_formal_education.required' => 'Pendidikan Terakhir wajib diisi',
            'core_competency.required' => 'Kompetensi wajib diisi',
            'phone.required' => 'Telepon wajib diisi',
            'phone.min' => 'Nomor telepon terlalu pendek',
            'phone.regex' => 'Format nomor telepon tidak sesuai contoh, yang benar: 6285625674567',
            'email.required' => 'Email wajib diisi',  
            'photo.image' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'photo.mimes' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 1 MB',            
        ];
    }
}
