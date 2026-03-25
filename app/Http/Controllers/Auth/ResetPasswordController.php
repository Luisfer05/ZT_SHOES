<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        Mail::send('emails.reset-password', ['token' => $token], function ($message) use ($request) {
<<<<<<< HEAD
            $message->to($request->email)->subject('Recuperación de contraseña – ZT|SHOES');
        });

        return back()->with('mensaje', 'Te hemos enviado un enlace de recuperación. Revisa tu bandeja de entrada.');
=======
            $message->to($request->email)->subject('Recuperación de contraseña - IncanatoApps');
        });

        return back()->with('mensaje', 'Te hemos enviado un enlace de recuperación.');
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
    }

    public function showResetForm($token)
    {
        return view('autenticacion.reset', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token'    => 'required',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();
=======
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921

        if (!$reset || $reset->email !== $request->email) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

<<<<<<< HEAD
        // Verificar expiración (60 minutos)
        if (now()->diffInMinutes($reset->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace ha expirado. Solicita uno nuevo.']);
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('mensaje', 'Tu contraseña ha sido restablecida. Ya puedes iniciar sesión.');
    }
}
=======
        User::where('email', $request->email)->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('mensaje', 'Tu contraseña ha sido restablecida.');
    }

}
>>>>>>> b066d58b056846fdea27ccd1051ac3b9f0e73921
