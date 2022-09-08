<?php

use App\Models\Trail;

function loggerActivity($activity)
{

    $logModel = new Trail();
    $request = \Config\Services::request();
    $agent = $request->getUserAgent();

    if ($agent->isBrowser()) {
        $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
    } elseif ($agent->isRobot()) {
        $currentAgent = $agent->getRobot();
    } elseif ($agent->isMobile()) {
        $currentAgent = $agent->getMobile();
    } else {
        $currentAgent = 'Unidentified User Agent';
    }

    $ipAdrr = $request->getIPAddress();
    // $macAdrr = $this->request->getMac;

    $logModel->insert([
        'activity_code' => $activity, 'user_agent' => $currentAgent, 'ip_address' => $ipAdrr, 'user_id' => (string)session()->fnip, 'user_name' => (string)session()->fnama
    ]);
}
