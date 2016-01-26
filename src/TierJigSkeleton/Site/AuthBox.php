<?php


namespace TierJigSkeleton\Site;

use TierJigSkeleton\Site\AuthBox\LoginBox;
use TierJigSkeleton\Site\AuthBox\LogoutBox;

use ASM\Session;

abstract class AuthBox
{
    abstract public function render();
    
    public static function createAuthBox(Session $session)
    {
        $data = $session->getData();
        if (array_key_exists('username', $data)) {
            return LogoutBox::createFromUsername($data['username']);
        }

        return new LoginBox();
    }
}
