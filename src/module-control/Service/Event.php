<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Service;

use Swarming\KountControl\Api\ServiceInterface;

class Event extends AbstractService implements ServiceInterface
{
    public const ENDPOINT_URI = '/events';

    public function provideLoginData(array $payload)
    {
        $response = $this->postData($payload);
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::ENDPOINT_URI;
    }

}