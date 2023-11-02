<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'email' => ['required', 'email:filter', 'unique:users,email'],
            // 'fullname' => ['required', 'string'],
            // 'username' => ['required', 'string', 'unique:users,username', 'regex:/^[A-Za-z0-9_]+$/'],
            'phone' => ['required', 'string', 'unique:user_profiles,phone_number', 'min:11','regex:/^628\d{8,}$/'],
            'institution_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'village' => ['required'],
            'password' => ['required', 'string', 'confirmed', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
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
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.regex' => 'Gunakan kombinasi huruf dan angka, dan mengandung setidaknya 1 huruf besar atau huruf kecil.',
            'password.confirmed' => 'Password tidak sama',
        ];
    }
}
