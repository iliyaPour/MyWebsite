<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Authenticate admin via password.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required|string',
            'email' => 'nullable|email',
        ]);

        $email = $request->input('email', 'admin@iliya.dev');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (! $user && ! $request->has('email')) {
            $user = User::first();
        }

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['رمز عبور وارد شده صحیح نمی‌باشد.'],
            ]);
        }

        Auth::login($user, $request->boolean('remember', true));
        $request->session()->regenerate();

        return response()->json([
            'message' => 'ورود با موفقیت انجام شد.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Check current authentication status.
     */
    public function check(): JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
        }

        return response()->json([
            'authenticated' => false,
        ]);
    }

    /**
     * Update admin password.
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (! Hash::check($request->input('current_password'), $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['رمز عبور فعلی صحیح نمی‌باشد.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return response()->json([
            'message' => 'رمز عبور با موفقیت تغییر یافت.',
        ]);
    }

    /**
     * Log out admin user.
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'خروج با موفقیت انجام شد.',
        ]);
    }
}
