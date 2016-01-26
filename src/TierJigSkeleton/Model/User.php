<?php


namespace TierJigSkeleton\Model;

class User
{
    private $username;
    
    //Prevent accidental contsruction
    private function __construct()
    {
    }

    public static function create($username)
    {
        $instance = new static;
        $instance->username = $username;

        return $instance;
    }

    public function getUsername()
    {
        return $this->username;
    }
}
