<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Учетные данные неверны.'],
            ]);
        }

        $device    = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(intval(config('session.lifetime')));
//        , expiresAt: $expiresAt

        return response()->json(['user' => $user, 'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
        ], Response::HTTP_CREATED);
    }
}
