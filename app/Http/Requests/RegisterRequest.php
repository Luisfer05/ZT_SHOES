<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'El campo nombre es obligatorio.',
            'name.string'        => 'El nombre debe ser una cadena de texto.',
            'name.max'           => 'El nombre no puede tener más de 255 caracteres.',

            'email.required'     => 'El campo correo electrónico es obligatorio.',
            'email.email'        => 'Debe ingresar un correo electrónico válido.',
            'email.unique'       => 'Este correo electrónico ya está registrado.',

            'password.required'  => 'El campo contraseña es obligatorio.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}