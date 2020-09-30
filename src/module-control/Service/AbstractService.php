<?php
/**
 * Created by Swarming Technology, LLC.
 * Project: magento-23
 */
declare(strict_types = 1);

namespace Swarming\KountControl\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Swarming\Kount\Model\Logger;
use Swarming\KountControl\Api\ServiceInterface;
use Swarming\KountControl\Model\Config;

abstract class AbstractService
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var \Swarming\KountControl\Model\Config
     */
    private $config;

    /**
     * @var \Swarming\Kount\Model\Logger
     */
    private $logger;

    /**
     * @return string
     */
    abstract protected function getEndpoint(): string;

    /**
     * @param \GuzzleHttp\Client $client
     * @param \Swarming\KountControl\Model\Config $config
     * @param \Swarming\Kount\Model\Logger $logger
     */
    public function __construct(
        Client $client,
        Config $config,
        Logger $logger
    ) {
        $this->client = $client;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        $baseUri = $this->config->isTestMode()
            ? ServiceInterface::BASE_SANDBOX_URI
            : ServiceInterface::BASE_PRODUCTION_URI;
        return $baseUri . $this->getEndpoint();
    }

    /**
     * @param array $payload
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function postData(array $payload): ResponseInterface
    {
        $payload = array_merge(
            $payload,
            [
                'auth' => [
                    null,
                    $this->config->getApiKey()
                ]
            ]
        );
        return $this->client->request('post', $this->getUri(), $payload);
    }
}