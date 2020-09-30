<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: Purple Fēte
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Plugin\Controller;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Swarming\KountControl\Model\Config;
use Swarming\KountControl\Service\Event;
use Swarming\KountControl\Service\Login;
use Swarming\KountControl\Service\TrustedDevice;

class AccountCreatePost
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Swarming\KountControl\Service\Login
     */
    private $loginService;

    /**
     * @var \Swarming\KountControl\Service\Event
     */
    private $eventService;

    /**
     * @var \Swarming\KountControl\Service\TrustedDevice
     */
    private $trustedDeviceService;

    /**
     * @var \Swarming\KountControl\Model\Config
     */
    private $config;

    /**
     * @param \Magento\Customer\Model\Session $session
     * @param \Swarming\KountControl\Service\Login $loginService
     * @param \Swarming\KountControl\Service\Event $eventService
     * @param \Swarming\KountControl\Service\TrustedDevice $trustedDeviceService
     */
    public function __construct(
        Session $session,
        Login $loginService,
        Event $eventService,
        TrustedDevice $trustedDeviceService,
        Config $config

    ) {
        $this->customerSession = $session;
        $this->loginService = $loginService;
        $this->eventService = $eventService;
        $this->trustedDeviceService = $trustedDeviceService;
        $this->config = $config;
    }

    /**
     * @param \Magento\Framework\App\Action\HttpPostActionInterface $httpPostAction
     * @param \Magento\Framework\Controller\Result\Redirect $result
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function afterExecute(HttpPostActionInterface $httpPostAction, Redirect $result): Redirect
    {
        if (!$this->customerSession->isLoggedIn()) {
            $this->eventService->provideLoginData(
                [
                    'failedAttempt' => [
                        'clientId' => '900900',
                        'sessionId' => 'd121ea2210434ffc8a90daff9cc97e76',
                        'userId' => 'meoyyd8za8jdmwfm',
                        'username' => 'meoyyd8za8jdmwfm',
                        'userPassword' => '38401eb46f8fbb74c1846a5f47f68d83a9bef126b1d4143f886cd464323cdaab',
                        'userIp' => '208.75.113.3',
                        'loginUrl' => 'http://www.example.com/login'
                    ]
                ]
            );

            return $result;
        }

        if (!$this->config->isLoginServiceEnabled()) {
            return $result;
        }

        return $result;
    }
}
