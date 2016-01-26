<?php

namespace TierJigSkeleton\Repository;

interface UserRepo
{
    public function authenticateUserByPassword($username, $password);
}
