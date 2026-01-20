<?php

namespace App\Services\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRegistrationService
{
    public function register(array $data): array
    {
        $user = null;

        $user = DB::transaction(function () use ($data) {
            return User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        });

        // Side effects AFTER commit
        $token = $user->createToken('auth_token')->plainTextToken;

        event(new UserRegistered($user));

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
