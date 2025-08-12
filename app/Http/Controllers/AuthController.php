<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   public function showLogin()
{
    if (Auth::check()) {
        return redirect()->route(Auth::user()->role == 'admin' ? 'admin.dashboard' : 'user.dashboard');
    }
    return view('auth.login'); 
}



public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->remember)) {
        $user = Auth::user();

        return redirect()->route(
            $user->role == 'admin' ? 'admin.dashboard' : 'user.dashboard'
        );
    }

    return back()->with('error', 'Email atau password salah');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}



public function showRegisterForm()
{
    return view('auth.register');
}

// public function register(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:6|confirmed',
//         'role' => 'required|in:admin,user',
//     ]);

//     User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'role' => $request->role,
//     ]);

//     return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
// }


public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
        ],
        'password_confirmation' => 'required|same:password',
        'role' => 'required|in:admin,user',
    ], [
        'password.min' => 'Password minimal 8 karakter.',
        'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
        'password_confirmation.same' => 'Konfirmasi password tidak cocok.',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);
    return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
}

}
