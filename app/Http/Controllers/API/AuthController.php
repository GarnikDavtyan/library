<?php

namespace App\Http\Controllers\API;

use App\Helpers\UserTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => UserTypes::VISITOR
        ]);

        $token = $user->createToken('LibraryAppToken')->plainTextToken;
        Auth::login($user);

        return $this->successResponse($token, 'Registered successfully', 201);
    }
    
    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LibraryAppToken')->plainTextToken;

            return $this->successResponse($token, 'Logged in successfully');
        }

        return $this->errorResponse('Invalid login credentials.', 401);
    }

    public function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, 'Logged out');
    }
}
