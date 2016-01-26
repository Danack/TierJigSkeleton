<?php

namespace TierJigSkeleton\Site\AuthBox;

use TierJigSkeleton\Site\AuthBox;

class LogoutBox extends AuthBox
{
    private $username;
    
    // Prevent accidental construction
    private function __construct()
    {
    }

    public static function createFromUsername($username)
    {
        $instance = new static;
        $instance->username = $username;
        
        return $instance;
    }
    
    public function render()
    {
        $output = <<< HTML

<div class="omb_login">
        <h3 class="omb_authTitle">You are logged in as $this->username</h3>
        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Logout</button>
                </form>
            </div>
        </div>

    </div>
HTML;

        return $output;
    }
}
