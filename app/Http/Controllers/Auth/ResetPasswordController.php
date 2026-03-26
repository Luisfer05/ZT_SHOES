<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('autenticacion.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        try {
            Mail::send('emails.reset-password', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email)->subject('Recuperación de contraseña – ZT|SHOES');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'No se pudo enviar el correo. Verifica que el email sea correcto e intenta de nuevo.']);
        }

        return back()->with('mensaje', 'Te hemos enviado un enlace de recuperación. Revisa tu bandeja de entrada.');
    }

    public function showResetForm($token)
    {
        return view('autenticacion.reset', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token'    => 'required',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$reset || $reset->email !== $request->email) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

        // Verificar expiración (60 minutos)
        if (Carbon::parse($reset->created_at)->diffInMinutes(now()) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace ha expirado. Solicita uno nuevo.']);
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('mensaje', 'Tu contraseña ha sido restablecida. Ya puedes iniciar sesión.');
    }
}