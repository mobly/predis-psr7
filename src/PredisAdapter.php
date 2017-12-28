<?php

namespace Mobly\Cache\Adapter\Predis;

use Mobly\Cache\AbstractCacheAdapter;
use Mobly\Cache\Adapter\Predis\Exception\PredisConnectionException;
use Mobly\Cache\CacheItem;
use Predis\Client;
use Psr\Cache\CacheItemInterface;

/**
 * Class PredisAdapter
 *
 * @package Mobly\Cache\Adapter\Predis
 */
class PredisAdapter extends AbstractCacheAdapter implements PredisAdapterInterface
{
    /**
     * @var self The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * @var PredisConfiguration
     */
    protected $configuration;

    /**
     * @var Client
     */
    protected $cache;

    /**
     * PredisAdapter constructor.
     *
     * @param PredisConfiguration $configuration
     */
    public function __construct(PredisConfiguration $configuration)
    {
        $this->configuration = $configuration;

        $this->cache = new Client($configuration->getParameters(), $configuration->getOptions());

        if (
            $this->configuration->shouldCheckConnection() &&
            $this->checkConnection()
        ) {
            throw new PredisConnectionException('Cant connect to Redis Server');
        }
    }

    /**
     * @return bool
     */
    public function checkConnection()
    {
        try {
            $this->cache->ping();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $key
     *
     * @return mixed|CacheItem
     */
    protected function fetchObjectFromCache($key)
    {
        $cacheItem = new CacheItem($key);

        $result = $this->cache->get($key);

        if (!$result) {
            return $cacheItem;
        }

        $cacheItem->set(unserialize($result));

        return $cacheItem;
    }

    /**
     * @param array $keys
     *
     * @return array|mixed
     */
    protected function fetchMultiObjectsFromCache(array $keys)
    {
        $response = [];

        $result = $this->cache->mget($keys);

        if (!count($result)) {
            return $response;
        }

        foreach ($result as $index => $value) {
            $key = $keys[$index];
            $cacheItem = new CacheItem($key);

            if ($value !== '') {
                $cacheItem->set(unserialize($value));
            }

            $response[$key] = $cacheItem;
        }

        return $response;
    }

    /**
     * @return bool
     */
    protected function clearAllObjectsFromCache()
    {
        return $this->cache->flushDB();
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function clearOneObjectFromCache($key)
    {
        $delResponse = $this->cache->del($key);

        return ($delResponse === PredisAdapter::DELETE_KEY_OK) ||
            ($delResponse === PredisAdapter::DELETE_KEY_NOT_FOUND);
    }

    /**
     * @param string $key
     * @param CacheItemInterface $item
     * @param int|null $ttl
     *
     * @return bool
     */
    protected function storeItemInCache($key, CacheItemInterface $item, $ttl)
    {
        if ($ttl === null) {
            $ttl = $this->configuration->getTimeToLive();
        }

        // Setting with timeout
        if ($ttl > 0) {
            return $this->cache->setex(
                $key,
                $ttl,
                serialize($item->get())
            );
        }

        // Setting without timeout
        return $this->cache->set(
            $key,
            serialize($item->get())
        );
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @param PredisConfiguration $configuration
     *
     * @return PredisAdapter
     */
    public static function getInstance(PredisConfiguration $configuration)
    {
        if (null === static::$instance) {
            static::$instance = new static($configuration);
        }
        return static::$instance;
    }
}