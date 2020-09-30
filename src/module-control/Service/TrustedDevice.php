<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Service;

use Swarming\KountControl\Api\ServiceInterface;

class TrustedDevice extends AbstractService implements ServiceInterface
{
    private const ENDPOINT_URI = '/trusted-device';

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return self::ENDPOINT_URI;
    }
}