<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'nim'=>'required',
            'email'=>'required',
            'nomor_telepon'=>'required',
            'alamat'=>'required',
            'status'=>'required',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Nama wajib diisi.',
            'nim.required'          => 'NIM wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'nomor_telepon.required'=> 'Nomor Telepon wajib diisi.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'status.required'       => 'Status wajib diisi.',
        ];
    }
}
