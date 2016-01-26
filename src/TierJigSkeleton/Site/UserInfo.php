<?php

namespace TierJigSkeleton\Site;

use ASM\Session;

class UserInfo
{
    private $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    public function render()
    {
        $data = $this->session->getData();
        
        if (array_key_exists('username', $data) == true) {
            $output = "username is ".$data['username'];
        }
        else {
            $output = "username is not set";
        }
        
        return $output;
    }
}
