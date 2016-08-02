<?php


namespace TierJigSkeleton\ACL;

use ASM\Session;

class SessionBasedAuthRole implements AuthRole
{
    private $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    public function getRole()
    {
        return $this->session->getSessionVariable('logged_in_role', SiteACL::ROLE_ANON);
    }
}
