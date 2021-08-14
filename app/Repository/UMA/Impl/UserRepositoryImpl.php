<?php

namespace App\Repository\UMA\Impl;

use App\Model\UMA\User;

use App\Repository\UMA\UserRepository;

class UserRepositoryImpl implements UserRepository {
    
    public function findUserByPhone($phone): User | null {
        return User::where('phone', $phone)->get()->first();
    }

}