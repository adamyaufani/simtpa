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
            'address' => ['nullable', 'string'],
            'father_name' => ['nullable', 'string'],
            'mother_name' => ['nullable', 'string'],
            'phone' => ['nullable', 'string','min:11','regex:/^628\d{8,}$/'],
            // 'school' => ['required', 'string'],
            // 'join_date' => ['required', 'date'],
            // 'status' => ['required', new Enum(StudentStatusEnum::class)],
            // 'ability_level_upon_entry' => ['required', 'string'],
            'birth_certificate' => ['required', 'image', 'mimes:jpg,jpeg,png, max:1028'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png, max:1028'],       
            
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
            'birth_place.required' => 'Tempat Lahir wajib diisi',            
            'birth_date.required' => 'Tanggal Lahir wajib diisi',            
            'father_name.required' => 'Nama Ayah wajib diisi',            
            'mother_name.required' => 'Nama Ibu wajib diisi',            
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format penulisan email salah',
            'address.required' => 'Alamat wajib diisi',
            'phone.required' => 'Telepon wajib diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'phone.min' => 'Nomor telepon terlalu pendek',
            'phone.regex' => 'Format nomor telepon tidak sesuai contoh, yang benar: 6285625674567',
            'birth_certificate.required' => 'Akta wajib diisi',           
            'birth_certificate.image' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'birth_certificate.mimes' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'birth_certificate.max' => 'Ukuran foto tidak boleh lebih dari 1 MB',           
            'photo.image' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'photo.mimes' => 'Akta harus berupa gambar dengan ekstensi .jpg, jpeg atau .png',           
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 1 MB',           
        ];
    }
}
