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

class AccountCreatePost
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    public function __construct(
        Session $session
    ) {
        $this->customerSession = $session;
    }

    /**
     * @param \Magento\Framework\App\Action\HttpPostActionInterface $httpPostAction
     * @param \Magento\Framework\Controller\Result\Redirect $result
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function afterExecute(HttpPostActionInterface $httpPostAction, Redirect $result): Redirect
    {
        if ($this->customerSession->isLoggedIn()) {

            return $result;
        }
        return $result;
    }
}
