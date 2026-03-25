<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegistroForm()
    {
        return view('autenticacion.registro');
    }

    public function registrar(RegisterRequest $request)
    {
        $usuario = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'activo'   => 1,
        ]);

        $clienteRol = Role::where('name', 'cliente')->first();
        if ($clienteRol) {
            $usuario->assignRole($clienteRol);
        }

        Auth::login($usuario);

        return redirect()->route('web.home')->with('mensaje', '¡Bienvenido a ZT|SHOES! Tu cuenta ha sido creada.');
    }
}