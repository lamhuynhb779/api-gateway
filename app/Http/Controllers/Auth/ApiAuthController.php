<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    use ApiResponse;

    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->errorMessage(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return $this->successResponse(['token' => $token]);
    }

    public function login (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->errorMessage(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->errorMessage('User does not exist', 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->errorMessage('Password mismatch', 422);
        }

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return $this->successResponse(['token' => $token]);
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return $this->successResponse(['message' => 'You have been successfully logged out!']);
    }
}
