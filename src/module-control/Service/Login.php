<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Service;

use Swarming\KountControl\Api\ServiceInterface;

class Login extends AbstractService implements ServiceInterface
{
    private const ENPOINT_URI = '/login';

    public function getLoginDecision(array $payload)
    {
        $response = $this->postData($payload);
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::ENPOINT_URI;
    }
}