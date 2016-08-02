<?php

namespace TierJigSkeleton\Permission;

class UserTicketView
{
    private static function __construct()
    {
        //prevent accidental construction.
    }
    public static function create()
    {
        return new self();
    }
}
