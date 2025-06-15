<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function login(array $credentials)
    {
        $user = $this->userRepo->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages(['email' => ['Invalid credentials.']]);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user_name' => $user->name,
        ];
    }
}
