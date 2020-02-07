<?php

namespace App\services;

use App\repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register($request)
    {
        return $this->userRepo->register($request);
    }
}