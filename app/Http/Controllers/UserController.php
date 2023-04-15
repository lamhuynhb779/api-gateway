<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return mixed
     */
    public function show()
    {
        $loginUser = Auth::user();
        return User::firstWhere('email', $loginUser->email);
    }
}