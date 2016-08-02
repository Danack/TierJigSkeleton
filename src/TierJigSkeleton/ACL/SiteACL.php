<?php

namespace TierJigSkeleton\ACL;

use TierJigSkeleton\Permission\ResourceNotAllowed;
use TierJigSkeleton\Permission\UserTicketEdit;
use TierJigSkeleton\Permission\UserTicketView;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource;

class SiteACL extends Acl
{
    const ROLE_ANON = 'anon';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    
    public function __construct()
    {
        // Create all the roles
        $this->addRole(new Role(SiteACL::ROLE_ANON));
        $this->addRole(new Role(SiteACL::ROLE_USER));
        $this->addRole(new Role(SiteACL::ROLE_ADMIN));

        $this->addResource(new GenericResource(Resource::USER_TICKET));

        $this->deny(SiteACL::ROLE_ANON, Resource::USER_TICKET);
        $this->allow(SiteACL::ROLE_USER, Resource::USER_TICKET, Privilege::VIEW);

        $this->allow(SiteACL::ROLE_ADMIN, Resource::USER_TICKET, Privilege::VIEW);
        $this->allow(SiteACL::ROLE_ADMIN, Resource::USER_TICKET, Privilege::EDIT);
    }
            
    public function createUserTicketView(AuthRole $userAuth)
    {
        $role = $userAuth->getRole();
        // check that the user is logged in by reading who they are from
        // the session and then asking an ACL if they have permission to ConversationRead
        if ($this->isAllowed($role, Resource::USER_TICKET, Privilege::VIEW)) {
            return UserTicketView::create();
        }

        throw new ResourceNotAllowed(Resource::USER_TICKET, Privilege::VIEW);
    }

    public function createUserTicketEdit(AuthRole $userAuth)
    {
        $role = $userAuth->getRole();
        // check that the user is logged in by reading who they are from
        // the session and then asking an ACL if they have permission to ConversationRead
        if ($this->isAllowed($role, Resource::USER_TICKET, Privilege::EDIT)) {
            return UserTicketEdit::create();
        }

        throw new ResourceNotAllowed(Resource::USER_TICKET, Privilege::EDIT);
    }
}
