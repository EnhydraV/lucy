<?php

namespace Lucy\Reader;

use Jenssegers\Agent\Agent;
use Lucy\Contracts\UserAgentInterface;

class UserAgent implements UserAgentInterface
{
    protected $userAgent;

    protected $agent;

    public function __construct($userAgentString)
    {
        $this->userAgent = $userAgentString;

        $this->agent = new Agent;
        $this->agent->setUserAgent($this->userAgent);
    }

    public function agent()
    {
        return $this->agent;
    }

    public function getUserAgentString()
    {
        return $this->userAgent;
    }

    public function getDeviceType()
    {
        if ($this->agent()->isDesktop()) {
            return 'desktop';
        }

        if ($this->agent()->isTablet()) {
            return 'tablet';
        }

        if ($this->agent()->isMobile()) {
            return 'mobile';
        }

        if ($this->agent()->isRobot()) {
            return 'robot';
        }

        return;
    }

    public function getDevice()
    {
        return $this->agent()->device();
    }

    public function getOperatingSystem()
    {
        return $this->agent()->platform();
    }

    public function getBrowser()
    {
        return $this->agent()->browser();
    }
}
