<?php

namespace TierJigSkeleton\Controller;

use Tier\JigBridge\TierJig;

use Room11\HTTP\VariableMap;
use ASM\Session;
use TierJigSkeleton\Repository\UserRepo;

class Basic
{
    public function index(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/index');
    }

    public function notepad(TierJig $tierJig, VariableMap $variableMap, Session $session)
    {
        $data = $session->getData();
        $value = $variableMap->getVariable('data', false);
        if ($value !== false && strlen(trim($value)) != 0) {
            $data[] = $value;
            $session->setData($data);
        }
        $value = $variableMap->getVariable('submit', false);
        if ($value !== false && strcmp($value, "Clear") === 0) {
            $session->setData([]);
        }
        $session->save();
        return $tierJig->createJigExecutable('pages/notepad');
    }
}
