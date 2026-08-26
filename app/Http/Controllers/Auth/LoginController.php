<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if ($request->session()->get('arjunatrans_admin_authenticated', false)) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $validUsername = 'arjunatrans';
        $validPassword = 'admin123';

        if (
            hash_equals($validUsername, $credentials['username']) &&
            hash_equals($validPassword, $credentials['password'])
        ) {
            $request->session()->regenerate();
            $request->session()->put('arjunatrans_admin_authenticated', true);
            $request->session()->put('arjunatrans_admin_username', $validUsername);

            return redirect()->route('dashboard')
                ->with('status', 'Login berhasil.');
        }

        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'arjunatrans_admin_authenticated',
            'arjunatrans_admin_username',
        ]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Anda berhasil logout.');
    }
}
