<?php
declare(strict_types=1);

namespace Core\Cache\Adapters;

use Core\Cache\Redis\Redis;

class RedisCacherAdapter extends AbstractCacherAdapter
{
    /**
     * RedisCacherAdapter constructor.
     */
    public function __construct()
    {
        $this->cacher = new Redis(REDIS_CONFIG['host'], REDIS_CONFIG['port']);
    }

    /**
     * @param string $key
     * @param $value
     * @param int|null $expire
     */
    public function putIntoCache(string $key, $value, int $expire = null)
    {
        $this->cacher->set($key, json_encode($value));
        if ($expire) {
            $this->cacher->expire($key, $expire);
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getFromCache(string $key)
    {
        return json_decode($this->cacher->get($key));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function deleteFromCache(string $key)
    {
        return $this->cacher->delete($key);
    }

    /**
     * @return mixed
     */
    public function clearAllCache()
    {
        // TODO: Implement clearAllCache() method.
    }
}