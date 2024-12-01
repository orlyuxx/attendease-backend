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
     * Login for User
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
     
        if ( !$user || !Hash::check($request->password, $user->password) ) {
            throw ValidationException::withMessages([
                'email' => ['The email or password is incorrect.'],
            ]);
        }

        $response = [
            'user'      => $user,
            'token'     => $user->createToken($request->email)->plainTextToken
        ];

        return $response;
    }

    /**
     * Login for Admin
     */
    public function admin(UserRequest $request)
    {
        // Find the user by the provided email
        $user = User::where('email', $request->email)->first();
    
        // Check if the user exists, the password is correct, and the user is the admin
        if (!$user || !Hash::check($request->password, $user->password) || $user->role !== 'admin') {
            throw ValidationException::withMessages([
                'admin' => ['The email or password is incorrect.'],
            ]);
        }
    
        // Generate a response for the admin
        $response = [
            'user'  => $user,
            'token' => $user->createToken($request->email)->plainTextToken,
        ];
    
        return $response;
    }

    /**
     * Logout using specified resource.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        
        $response = [
            'message' => 'Logged Out Successfully'
        ];

        return $response;
    }
    

}
