<?php

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;
use src\Models\DataProviderConfig;

class DecoratorManager extends DataProvider
{
    public function __construct(
        protected DataProviderConfig  $config,
        public CacheItemPoolInterface $cache,
        public LoggerInterface        $logger
    )
    {
    }

    /**
     * Get response
     *
     * @param array $input
     * @return array
     */
    public function getResponse(array $input): array
    {
        try {
            $cacheKey = $this->getCacheKey($input);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = $this->getFromExternalService($input);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

        } catch (Exception $e) {
            $this->logger->critical('Error');
        }

        return $result ?? [];
    }

    /**
     * Get cache key
     *
     * @param array $input
     * @return false|string
     */
    public function getCacheKey(array $input): false|string
    {
        return json_encode($input);
    }
}
