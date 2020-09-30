<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Model;

use Swarming\Kount\Model\Config\Account;

class Config extends Account
{
    /**
     * @return bool
     */
    public function isLoginServiceEnabled()
    {
        return $this->scopeConfig->isSetFlag('swarming_kount_control/general/login_enabled');
    }

    /**
     * @return bool
     */
    public function isTrustedDeviceEnabled()
    {
        return $this->scopeConfig->isSetFlag('swarming_kount_control/general/trusted_device_enabled');
    }

    /**
     * @return bool
     */
    public function isSignupEnabled()
    {
        return $this->scopeConfig->isSetFlag('swarming_kount_control/general/sign_up_enabled');
    }

}