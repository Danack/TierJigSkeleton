<?php


namespace TierJigSkeleton\Controller;

use TierJigSkeleton\ACL\SiteACL;
use TierJigSkeleton\ACL\AuthRole;
use TierJigSkeleton\ACL\Resource;
use TierJigSkeleton\ACL\Privilege;
use Tier\Bridge\TierJig;

class Tickets
{
    public function showTickets(TierJig $tierJig, SiteACL $siteACL, AuthRole $userAuth)
    {
//        if ($siteACL->isAllowed($userAuth->getRole(), Resource::USER_TICKET, Privilege::VIEW)) {
//            //todo wat
//        }
//        else if ($siteACL->isAllowed($userAuth->getRole(), Resource::USER_TICKET, Privilege::VIEW)) {
//
//        }

        return $tierJig->createJigExecutable('pages/index');
    }
    
    public function showTicketsAdminView()
    {

    }
}
