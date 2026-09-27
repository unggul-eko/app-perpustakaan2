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
        $memberId = $this->route('member');

        return [
            'nama'=>'required',
            'nim'=>'required|unique:members,nim,' . $memberId,
            'email'=>'required|email|unique:members,email,' . $memberId,
            'nomor_telepon'=>'required',
            'alamat'=>'required',
            'status'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'         => 'Nama wajib diisi.',
            'nim.required'          => 'NIM wajib diisi.',
            'nim.unique'            => 'NIM sudah terdaftar.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'nomor_telepon.required'=> 'Nomor Telepon wajib diisi.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'status.required'       => 'Status wajib diisi.',
        ];
    }
}
