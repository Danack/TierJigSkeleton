<?php

namespace TierJigSkeleton\Repository\Stub;

use TierJigSkeleton\Repository\UserRepo;
use TierJigSkeleton\Model\User;

class UserStubRepo implements UserRepo
{
    public function authenticateUserByPassword($username, $password)
    {
        if (strcmp($username, "demo") !== 0) {
            return null;
        }

        //hash of 12345
        $validHash = '$2y$12$MoflUfhQCuHdcexlEicD7uqFUIt5p0XSj71X62BbJfavkKf/6gUA6';
     
        $valid = password_verify($password, $validHash);
        if (!$valid) {
            return null;
        }
        
        return User::create("Demo");
    }
}
