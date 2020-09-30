<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Api;

interface ServiceInterface
{
    public const BASE_PRODUCTION_URI = 'https://api.kount.com';

    public const BASE_SANDBOX_URI = 'https://api-sandbox.kount.com';
}