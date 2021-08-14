<?php

namespace App\Repository\UMA;

use App\Model\UMA\User;

interface UserRepository {

    public function findUserByPhone($phone): User | null;

}