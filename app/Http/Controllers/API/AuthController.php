<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Menghasilkan token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Login user.
     */
    public function login(Request $request)
    {
        // Validasi input request
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            // Tangani validasi gagal dengan response error
            return ResponseFormatter::error(
                'Validation Error',
                $e->errors(),
                422
            );
        }

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Memeriksa apakah user ditemukan dan password benar
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ResponseFormatter::error(
                'The provided credentials are incorrect.',
                null,
                401
            );
        }

        // Jika login berhasil, buat token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return ResponseFormatter::success([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Login successful');
    }

    /**
     * Logout user (revoke token).
     */
    public function logout(Request $request)
    {
        try {
            // Hapus semua token saat logout
            $request->user()->tokens()->delete();
        } catch (\Exception $e) {
            // Tangani error pada saat logout
            return ResponseFormatter::error(
                'Logout failed',
                $e->getMessage(),
                500
            );
        }

        return ResponseFormatter::success(null, 'Logout successful');
    }
}
