<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login using specified resource.
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The email or password are incorrect.'],
            ]);
        }

        $response = [
            'user'      => $user,
            'token'     => $user->createToken($request->email)->plainTextToken
        ];

        return $response;
    }

    /**
     * Logout using specified resource.
     */
    public function logout()
    {
        return false;
    }

}