<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        // Hapus token pengguna jika menggunakan Sanctum atau Passport
        if (Auth::check()) {
            $user = Auth::user();
            $user->tokens()->delete(); // Hapus semua token yang terkait dengan pengguna (untuk Sanctum)
            // Jika menggunakan Passport, Anda bisa menambahkan: $user->token()->revoke();
        }

        // Logout pengguna
        Auth::logout();

        // Invalidasi sesi
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Hapus cookie token yang mungkin tersisa
        $cookie = \Cookie::forget('token_name'); // Ganti 'token_name' jika perlu

        // Redirect ke halaman login dengan header anti-cache
        return redirect('/login')
            ->withCookie($cookie) // Menghapus cookie
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate', // Pastikan tidak ada cache yang disimpan
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
    }
}
