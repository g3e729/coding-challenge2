<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'     => 'required|max:55',
                'email'    => 'email|required|unique:users',
                'password' => 'required|confirmed'
            ]);

            $user         = (new UserService)->createUser($validatedData);
            $access_token = $user->createToken('authToken')->accessToken;
            $role = Role::where('name', Role::ROLE_VIEW)->first();
            
            if ($role) {
                $user->roles()->attach([$role->id]);
            }

            return response(compact('user', 'access_token'));
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
        }

        return response(['message' => 'Please check inputs and try again.'], 422);
    }

    public function login(Request $request)
    {
        try {
            $loginData = $request->validate([
                'email'    => 'email|required',
                'password' => 'required'
            ]);

            if (!auth()->attempt($loginData)) {
                return response(['message' => 'Invalid Credentials']);
            }
            
            $user         = auth()->user();
            $access_token = $user->createToken('authToken')->accessToken;

            return response(compact('user', 'access_token'));
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
        }

        return response(['message' => 'Invalid Credentials'], 422);
    }

    public function logout()
    {
        if (auth()->check()) {
           auth()->user()->AauthAcessToken()->delete();
        }

        return response(null);
    }
}
