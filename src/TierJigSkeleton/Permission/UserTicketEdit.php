<?php

namespace TierJigSkeleton\Permission;

class UserTicketEdit
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