<?php

namespace Intahwebz\Controller;

use Tier\JigBridge\TierJig;

class Index
{
    public function renderIndexPage(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/index');
    }
}
