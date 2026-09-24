<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\RateLimiter;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $throttleKey = 'login:' . $request->ip();
        $lockoutSeconds = 0;
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $lockoutSeconds = RateLimiter::availableIn($throttleKey);
        }

        return view('auth.login', compact('lockoutSeconds'));
    }

    public function register()
    {
        return view('auth.register');
    }

    public function submitRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create($validated);

        return redirect()->route('login')->with('success', 'Register berhasil, silahkan login');
    }

    public function submitLogin(Request $request)
    {
        $throttleKey = 'login:' . $request->ip();

        // Cek jika tombol/akun sedang dikunci sementara karena sudah gagal 3 kali
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Akun dinonaktifkan sementara. Silakan coba lagi dalam {$seconds} detik.",
            ])->with('lockout_seconds', $seconds)->withInput($request->only('email'));
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek jika email salah atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Tambahkan hit percobaan gagal
            RateLimiter::hit($throttleKey, 300);

            // Jika sudah mencapai 3 kali salah
            if (RateLimiter::attempts($throttleKey) >= 3) {
                //ngatur durasi
                $lockoutDuration = 30;
                RateLimiter::clear($throttleKey);
                RateLimiter::hit($throttleKey, $lockoutDuration);
                RateLimiter::hit($throttleKey, $lockoutDuration);
                RateLimiter::hit($throttleKey, $lockoutDuration);

                $seconds = RateLimiter::availableIn($throttleKey);

                return back()->withErrors([
                    'email' => "Anda telah salah memasukkan email atau password sebanyak 3 kali. Tombol login dinonaktifkan selama {$seconds} Detik.",
                ])->with('lockout_seconds', $seconds)->withInput($request->only('email'));
            }

            $remaining = 3 - RateLimiter::attempts($throttleKey);

            if (!$user) {
                return back()->withErrors([
                    'email' => "Email yang Anda masukkan salah. (Sisa percobaan: {$remaining})",
                ])->withInput($request->only('email'));
            }

            return back()->withErrors([
                'password' => "Password yang Anda masukkan salah. (Sisa percobaan: {$remaining})",
            ])->withInput($request->only('email'));
        }

        // Login berhasil, bersihkan riwayat limiter
        RateLimiter::clear($throttleKey);

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
