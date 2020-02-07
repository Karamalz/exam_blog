<?php

namespace App\repositories;

use App\User;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    public function register($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'normal',
        ]);
    }
}