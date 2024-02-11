<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        $token = $user->createToken('API_ACCESS_TOKEN')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Action completed successfully',
            'data' => [
                'api_access_token' => $token
            ]
        ], 200);
    }
}
